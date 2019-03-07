# Improve Event Visibility

## Goals
Make it easy to monitor events across multiple instances of Kōjō deployments
1. Provide automatic logging of events as job's `assgined_state` is changed
1. Provide consistent context about `kojo_job`, and `process` details in log events emitted from user space
1. Provide visibility when any execution environment resource limit is being reached which is preventing more processes to be created
 
## High Level Requirements
* All jobs should emit an `info` log message when the `assigned_state` is modified in the `kojo_job` table.
* All log messages from a configured worker should contain top-level keys of *relevant* `kojo_job`, and `process` tree information in a machine readable format
* When a execution environment cannot tolerate any more processes due to `load average`, `memory limits`, or `max_child_processes` then a log message should be emitted

## Not Doing Right Now
* Notification API for exceptions, and other complex structures
* Rewriting the logger to use Monolog
* Cleaning up `critical` log messages when an execution environment is cleanly terminated

## Level of Effort


## Risks

## KPIs and Metrics

## Related Documents
