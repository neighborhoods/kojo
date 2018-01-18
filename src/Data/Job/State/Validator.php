<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\State;

class Validator
{
    public function isValidTransition(): bool
    {
        $isValidTransition = true;
        $nextStateRequestUpdate = $this->_getNextStateRequestUpdate();
        $assignedStateUpdate = $this->_getAssignedStateUpdate();
        $assignedState = $this->_getJob()->getAssignedState();
        switch ($nextStateRequestUpdate . $assignedStateUpdate) {
            // Waiting for work.
            case ServiceInterface::STATE_WORKING . ServiceInterface::STATE_WAITING:
                switch ($assignedState) {
                    case ServiceInterface::STATE_WAITING:
                        switch ($this->_getJob()->getNextStateRequest()) {
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