<?php

namespace NHDS\Jobs\Data\Job\State;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Toolkit\Time;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Service implements ServiceInterface
{
    use Crud\AwareTrait;
    use Job\AwareTrait;
    use Time\AwareTrait;
    protected $_nextStateRequestUpdate;
    protected $_assignedStateUpdate;
    protected $_updateExpression;
    protected $_retryDateTime;

    public function requestNew(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_WORKING;
        $this->_assignedStateUpdate = ServiceInterface::STATE_NEW;

        return $this;
    }

    public function requestPendingLimitCheck(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_WORKING;
        $this->_assignedStateUpdate = ServiceInterface::STATE_PENDING_LIMIT_CHECK;

        return $this;
    }

    public function requestCancelledFailedLimitCheck(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->_assignedStateUpdate = ServiceInterface::STATE_CANCELLED_FAILED_LIMIT_CHECK;

        return $this;
    }

    public function requestWork(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->_assignedStateUpdate = ServiceInterface::STATE_WORKING;
        $this->_updateExpression = 'job.setTimesWorked(job.getTimesWorked()+1)';

        return $this;
    }

    public function requestWaitForWork(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_WORKING;
        $this->_assignedStateUpdate = ServiceInterface::STATE_WAITING;

        return $this;
    }

    public function requestCompleteSuccess(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->_assignedStateUpdate = ServiceInterface::STATE_COMPLETE_SUCCESS;

        return $this;
    }

    public function requestCompleteTerminated(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->_assignedStateUpdate = ServiceInterface::STATE_COMPLETE_TERMINATED;

        return $this;
    }

    public function requestCompleteFailed(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->_assignedStateUpdate = ServiceInterface::STATE_COMPLETE_FAILED;

        return $this;
    }

    public function requestCrashed(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_WORKING;
        $this->_assignedStateUpdate = ServiceInterface::STATE_CRASHED;
        $this->_updateExpression = 'job.setTimesCrashed(job.getTimesCrashed()+1) 
            && job.setPriority(job.getPriority()-1)';

        return $this;
    }

    public function requestPanicked(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->_assignedStateUpdate = ServiceInterface::STATE_PANICKED;
        $this->_updateExpression = 'job.setTimesPanicked(job.getTimesPanicked()+1) 
            && job.setPriority(job.getPriority()-1)';

        return $this;
    }

    public function requestHold(): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->_assignedStateUpdate = ServiceInterface::STATE_HOLD;
        $this->_updateExpression = 'job.setTimesHeld(job.getTimesHeld()+1)';

        return $this;
    }

    public function requestRetry(\DateTime $retryDateTime): ServiceInterface
    {
        $this->_nextStateRequestUpdate = ServiceInterface::STATE_WORKING;
        $this->_assignedStateUpdate = ServiceInterface::STATE_WAITING;
        $this->_updateExpression = 'job.setWorkAtDateTime(retryDateTime) 
            && job.setTimesRetried(job.getTimesRetried()+1)';
        $this->_retryDateTime = $retryDateTime;

        return $this;
    }

    public function applyRequest(): ServiceInterface
    {
        $this->_assertValidTransition();
        $referenceTime = $this->_getTime()->getNow();
        $this->_getJob()->setPreviousState($this->_getJob()->getAssignedState());
        if ($this->_updateExpression !== null) {
            $expressionLanguage = new ExpressionLanguage();
            $expressionLanguage->evaluate(
                $this->_updateExpression,
                [
                    'job'           => $this->_getJob(),
                    'retryDateTime' => $this->_retryDateTime,
                ]
            );
        }
        $this->_getJob()->setAssignedState($this->_getAssignedStateUpdate());
        $this->_getJob()->setNextStateRequest($this->_getNextStateRequestUpdate());
        $this->_getJob()->setLastTransitionInDatetime($referenceTime);

        return $this;
    }

    protected function _getNextStateRequestUpdate(): string
    {
        if ($this->_nextStateRequestUpdate === null) {
            throw new \LogicException('Next state request update is not set.');
        }

        return $this->_nextStateRequestUpdate;
    }

    protected function _getAssignedStateUpdate()
    {
        if ($this->_assignedStateUpdate === null) {
            throw new \LogicException('Current state update is not set.');
        }

        return $this->_assignedStateUpdate;
    }

    protected function _assertValidTransition(): ServiceInterface
    {
        $nextStateRequestUpdate = $this->_getNextStateRequestUpdate();
        $assignedStateUpdate = $this->_getAssignedStateUpdate();
        $assignedState = $this->_getJob()->getAssignedState();
        $isValidTransition = $this->isValidTransition();
        if (!$isValidTransition) {
            $invalidTransitionMessage = 'Invalid state transition [' . $nextStateRequestUpdate . ']';
            $invalidTransitionMessage .= '[' . $assignedStateUpdate . '][' . $assignedState . '].';
            throw new \LogicException($invalidTransitionMessage);
        }

        return $this;
    }

    public function isValidTransition(): bool
    {
        $isValidTransition = true;
        $nextStateRequestUpdate = $this->_getNextStateRequestUpdate();
        $assignedStateUpdate = $this->_getAssignedStateUpdate();
        $assignedState = $this->_getJob()->getAssignedState();
        switch ($nextStateRequestUpdate . $assignedStateUpdate) {
            case ServiceInterface::STATE_WORKING . ServiceInterface::STATE_WAITING:
                switch ($assignedState) {
                    case ServiceInterface::STATE_WORKING:
                    case ServiceInterface::STATE_PANICKED:
                    case ServiceInterface::STATE_HOLD:
                    case ServiceInterface::STATE_CRASHED:
                    case ServiceInterface::STATE_NEW:
                    case ServiceInterface::STATE_PENDING_LIMIT_CHECK:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            case ServiceInterface::STATE_WORKING . ServiceInterface::STATE_PENDING_LIMIT_CHECK:
                switch ($assignedState) {
                    case ServiceInterface::STATE_NEW:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_HOLD:
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_COMPLETE_TERMINATED:
                switch ($assignedState) {
                    case ServiceInterface::STATE_WAITING:
                    case ServiceInterface::STATE_WORKING:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_COMPLETE_SUCCESS:
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_COMPLETE_FAILED:
            case ServiceInterface::STATE_WORKING . ServiceInterface::STATE_CRASHED:
                switch ($assignedState) {
                    case ServiceInterface::STATE_WORKING:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_CANCELLED_FAILED_LIMIT_CHECK:
                switch ($assignedState) {
                    case ServiceInterface::STATE_PENDING_LIMIT_CHECK:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_WORKING:
                switch ($assignedState) {
                    case ServiceInterface::STATE_WAITING:
                    case ServiceInterface::STATE_CRASHED:
                    case ServiceInterface::STATE_PENDING_LIMIT_CHECK:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_PANICKED:
                break;
            default:
                $isValidTransition = false;
        }

        return $isValidTransition;
    }
}