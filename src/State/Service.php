<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\State;

use Neighborhoods\Kojo\Job;
use Neighborhoods\Kojo\Time;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Service implements ServiceInterface
{
    use Job\AwareTrait;
    use Time\AwareTrait;
    use Job\Type\Repository\AwareTrait;
    protected $nextStateRequestUpdate;
    protected $assignedStateUpdate;
    protected $updateExpression;
    protected $retryDateTime;

    public function requestNew(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_WORKING;
        $this->assignedStateUpdate = ServiceInterface::STATE_NEW;

        return $this;
    }

    public function requestWork(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->assignedStateUpdate = ServiceInterface::STATE_WORKING;
        $this->updateExpression = 'job.setTimesWorked(job.getTimesWorked()+1)';

        return $this;
    }

    public function requestWaitForWork(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_WORKING;
        $this->assignedStateUpdate = ServiceInterface::STATE_WAITING;

        return $this;
    }

    public function requestScheduleLimitCheck(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_SCHEDULE_LIMIT_CHECK;
        $this->assignedStateUpdate = ServiceInterface::STATE_WAITING;

        return $this;
    }

    public function requestCompleteFailedScheduleLimitCheck(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->assignedStateUpdate = ServiceInterface::STATE_COMPLETE_FAILED_SCHEDULE_LIMIT_CHECK;
        $this->updateExpression = 'job.setCompletedAtDateTime(referenceDateTime) 
            && job.setDeleteAfterDateTime(referenceDateTime.add(autoDeleteDateInterval))';

        return $this;
    }

    public function requestCompleteSuccess(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->assignedStateUpdate = ServiceInterface::STATE_COMPLETE_SUCCESS;
        $this->updateExpression = 'job.setCompletedAtDateTime(referenceDateTime) 
            && job.setDeleteAfterDateTime(referenceDateTime.add(autoDeleteDateInterval))';

        return $this;
    }

    public function requestCompleteTerminated(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->assignedStateUpdate = ServiceInterface::STATE_COMPLETE_TERMINATED;
        $this->updateExpression = 'job.setCompletedAtDateTime(referenceDateTime) 
            && job.setDeleteAfterDateTime(referenceDateTime.add(autoDeleteDateInterval))';

        return $this;
    }

    public function requestCompleteFailed(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->assignedStateUpdate = ServiceInterface::STATE_COMPLETE_FAILED;
        $this->updateExpression = 'job.setCompletedAtDateTime(referenceDateTime) 
            && job.setDeleteAfterDateTime(referenceDateTime.add(autoDeleteDateInterval))';

        return $this;
    }

    public function requestCrashed(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_WORKING;
        $this->assignedStateUpdate = ServiceInterface::STATE_CRASHED;
        $this->updateExpression = 'job.setTimesCrashed(job.getTimesCrashed()+1) 
            && job.setPriority(job.getPriority()-1)';

        return $this;
    }

    public function requestPanicked(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->assignedStateUpdate = ServiceInterface::STATE_PANICKED;
        $this->updateExpression = 'job.setTimesPanicked(job.getTimesPanicked()+1) 
            && job.setPriority(job.getPriority()-1)';

        return $this;
    }

    public function requestHold(): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_NONE;
        $this->assignedStateUpdate = ServiceInterface::STATE_HOLD;
        $this->updateExpression = 'job.setTimesHeld(job.getTimesHeld()+1)';

        return $this;
    }

    public function requestRetry(\DateTime $retryDateTime): ServiceInterface
    {
        $this->nextStateRequestUpdate = ServiceInterface::STATE_WORKING;
        $this->assignedStateUpdate = ServiceInterface::STATE_WAITING;
        $this->updateExpression = 'job.setWorkAtDateTime(retryDateTime) 
            && job.setTimesRetried(job.getTimesRetried()+1)';
        $this->retryDateTime = $retryDateTime;

        return $this;
    }

    public function applyRequest(): ServiceInterface
    {
        $this->assertValidTransition();
        $referenceTime = $this->getTime()->getNow();
        $this->getJob()->setPreviousState($this->getJob()->getAssignedState());
        $jobType = $this->getJobTypeRepository()->get($this->getJob()->getTypeCode());
        if ($this->updateExpression !== null) {
            $expressionLanguage = new ExpressionLanguage();
            $expressionLanguage->evaluate(
                $this->updateExpression,
                [
                    'job' => $this->getJob(),
                    'retryDateTime' => $this->retryDateTime,
                    'referenceDateTime' => $referenceTime,
                    'autoDeleteDateInterval' => $jobType->getAutoDeleteIntervalDuration(),
                ]
            );
        }
        $this->getJob()->setAssignedState($this->getAssignedStateUpdate());
        $this->getJob()->setNextStateRequest($this->getNextStateRequestUpdate());
        $this->getJob()->setLastTransitionDatetime($referenceTime);

        return $this;
    }

    protected function getNextStateRequestUpdate(): string
    {
        if ($this->nextStateRequestUpdate === null) {
            throw new \LogicException('Next state request update is not set.');
        }

        return $this->nextStateRequestUpdate;
    }

    protected function getAssignedStateUpdate()
    {
        if ($this->assignedStateUpdate === null) {
            throw new \LogicException('Current state update is not set.');
        }

        return $this->assignedStateUpdate;
    }

    protected function assertValidTransition(): ServiceInterface
    {
        $nextStateRequestUpdate = $this->getNextStateRequestUpdate();
        $assignedStateUpdate = $this->getAssignedStateUpdate();
        $assignedState = $this->getJob()->getAssignedState();
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
        $nextStateRequestUpdate = $this->getNextStateRequestUpdate();
        $assignedStateUpdate = $this->getAssignedStateUpdate();
        $assignedState = $this->getJob()->getAssignedState();
        switch ($nextStateRequestUpdate . $assignedStateUpdate) {
            // Waiting for work.
            case ServiceInterface::STATE_WORKING . ServiceInterface::STATE_WAITING:
                switch ($assignedState) {
                    case ServiceInterface::STATE_WAITING:
                        switch ($this->getJob()->getNextStateRequest()) {
                            case Service::STATE_SCHEDULE_LIMIT_CHECK:
                                break;
                            default:
                                $isValidTransition = false;
                        }
                        break;
                    case ServiceInterface::STATE_WORKING:
                    case ServiceInterface::STATE_PANICKED:
                    case ServiceInterface::STATE_HOLD:
                    case ServiceInterface::STATE_CRASHED:
                    case ServiceInterface::STATE_NEW:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            // Hold, terminated, or complete failed schedule limit check.
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_HOLD:
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_COMPLETE_TERMINATED:
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_COMPLETE_FAILED_SCHEDULE_LIMIT_CHECK:
                switch ($assignedState) {
                    case ServiceInterface::STATE_WAITING:
                    case ServiceInterface::STATE_WORKING:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            // Complete success, complete failed, or crashed.
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
            // Schedule limit check.
            case ServiceInterface::STATE_SCHEDULE_LIMIT_CHECK . ServiceInterface::STATE_WAITING:
                switch ($assignedState) {
                    case ServiceInterface::STATE_NEW:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            // Working.
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_WORKING:
                switch ($assignedState) {
                    case ServiceInterface::STATE_WAITING:
                    case ServiceInterface::STATE_CRASHED:
                        break;
                    default:
                        $isValidTransition = false;
                }
                break;
            // Panicked.
            case ServiceInterface::STATE_NONE . ServiceInterface::STATE_PANICKED:
                break;
            default:
                $isValidTransition = false;
        }

        return $isValidTransition;
    }
}