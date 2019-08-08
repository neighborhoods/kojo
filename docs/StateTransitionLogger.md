# Kōjō State Transition Logger
* Start Date: 2019-08-08
* Author: Przemyslaw Mucha (przemyslaw.mucha@55places.com)

## Summary
This document proposes a design for Kōjō logic that will emit log messages for every state transition of a job (e.g. from `waiting` to `working`)

## Problem
* Why are we doing this?
    * To gain visibility into the lifecycle of any given job
* What use cases does it support?
    * Forensic analysis of a job that didn't behave as expected
    * Monitoring how much work is being done (more accurately than polling `kojo_job`)
    * Monitoring how much time is spent in each state

## Proposed Solution
Job state transitions are persisted to RDBMS in `Neighborhoods\Kojo\State\Service::applyRequest()`.
To that logic we will add another `INSERT` into a new table: `kojo_job_state_transitions` (working title).
The schema of that table will include all job information (ID, type, etc.) as well as process information (execution environment, PID, etc.).
Those two statements will be wrapped in a database transaction to ensure that nothing is written to `kojo_job_state_transitions` unless the actual transition succeeds.

We will add another first-class process type to the Kōjō complement (e.g. `Server`, `Root`) called the `StateTransitionLogger` (working title).
The `StateTransitionLogger` will be a child of the `Root`, and will be most like `Worker` processes.
There will only be one `StateTransitionLogger` per Kōjō cluster, in the same way that there is only one `Worker` acting as the `Maintainer`.
`Root`s will be responsible for babysitting the status of the `StateTransitionLogger` (by inserting `command.addProcess('state_transition_logger')` messages into the "publication" redis list if nothing is holding the mutex).
Once the `StateTransitionLogger` is instantiated, it will poll the `kojo_job_state_transitions` table continuously.
For each transition event the `StateTransitionLogger` pulls into memory, it will emit a message and then delete that row.
This guarantees at-least-once delivery of transition messages.

## Backward Incompatible Changes
If there are any assumptions within Kōjō about the process hierarchy, they could be violated by the addition of a new process type, but this is unlikely.
Otherwise it's a purely additive modification to Kōjō.

## Example 1
1. There exists a dynamically scheduled job with `previous_state: 'new'`, `assigned_state: 'waiting'`, `next_state_request: 'working'`, and `work_at_datetime > NOW()`
1. A recently spawned `Worker` process selects that job to work
1. That `Worker` process reaches `Neighborhoods\Kojo\Foreman::_updateJobAsWorking()` and invokes `Neighborhoods\Kojo\State\Service::applyRequest()` to transition the job from `waiting` to `working`
1. The job, process, and transition information are inserted into `kojo_job_state_transitions`
1. The `Worker` process continues execution and hands over control to userspace
1. Concurrently, the `StateTransitionLogger` process for that cluster (not necessarily in the same execution environment) queries `kojo_job_state_transitions` and pulls that transition information into memory.
1. The `StateTransitionLogger` emits a message, deletes the row, and moves on to the next transition event
1. Concurrently, our logging infrastructure consumes the emitted messages

## Future Scope
Part of the design for the `StateTransitionLogger` is to delegate more one-per-cluster responsibilities to first-class processes.
This is in contrast to the typical Kōjō pattern of requiring every newly spawned `Worker` process to attempt to perform these responsibilities.
If this implementation of the `StateTransitionLogger` is successful, it would be desireable to refactor out `Maintainer`, `Scheduler`, etc. responsibilities in the same way.

## Drawbacks
There are multiple unknowns with this design which could cause it to become infeasible to implement, in which case we'd have to go with the approach outlined in Alternative 3.

## Unresolved Questions
* Should we log when a job is created (i.e. scheduled)?

## Alternatives
1. `Neighborhoods\Kojo\State\Service::applyRequest()` emits the message itself when the transition happens
    1. There exists a dynamically scheduled job with `previous_state: 'new'`, `assigned_state: 'waiting'`, `next_state_request: 'working'`, and `work_at_datetime > NOW()`
    1. A recently spawned `Worker` process selects that job to work
    1. That `Worker` process reaches `Neighborhoods\Kojo\Foreman::_updateJobAsWorking()` and invokes `Neighborhoods\Kojo\State\Service::applyRequest()` to transition the job from `waiting` to `working`
    1. `Neighborhoods\Kojo\State\Service::applyRequest()` emits the transition message itself
    1. The `Worker` process continues execution and hands over control to userspace
    1. Userspace overrides this process's `\PDO` connection using `Neighborhoods\Kojo\Api\V1\RDBMS\Connection\Service::usePDO()`
    1. Userspace begins a transaction and issues a `complete_success` request via the Kōjō API (which causes a message to be emitted)
    1. Userspace rolls back the transaction, and issues a `complete_failed` request (which causes a contradictory message to be emitted)
1. `kojo_job_state_transitions` is populated via triggers on `kojo_job`
    1. There exists a dynamically scheduled job with `previous_state: 'new'`, `assigned_state: 'waiting'`, `next_state_request: 'working'`, and `work_at_datetime > NOW()`
    1. A recently spawned `Worker` process selects that job to work
    1. That `Worker` process reaches `Neighborhoods\Kojo\Foreman::_updateJobAsWorking()` and invokes `Neighborhoods\Kojo\State\Service::applyRequest()` to transition the job from `waiting` to `working`
    1. Once `Neighborhoods\Kojo\State\Service::applyRequest()` updates `kojo_job`, a trigger writes the old and new row information to `kojo_job_state_transitions`
    1. The `Worker` process continues execution and hands over control to userspace
    1. Concurrently, the `StateTransitionLogger` process for that cluster (not necessarily in the same execution environment) queries `kojo_job_state_transitions` and pulls that transition information into memory.
    1. The `StateTransitionLogger` emits a message, deletes the row, and moves on to the next transition event
    1. Unfortunately, in this scenario, there's no process information available, so only job information is emitted
    1. Without process information, we can't determine whether there's a systemic issue on a particular execution environment
    1. Concurrently, our logging infrastructure consumes the emitted messages
1. Make the `StateTransitionLogger` another responsibility of each process when it starts up (vs a first-class process type)
    1. There are no flaws with this approach per-se, but we are of the opinion that continuing to add responsibilities to newly-spawned `Worker` processes is unsustainable and results in less deterministic behavior than first-class, single-responsibility processes

## Rejected Features
As mentioned above, refactoring all `Worker` process responsibilities is outside the scope of implementing this "prototype" process type.

## References
* [LDR Google calendar](https://calendar.google.com/calendar?cid=NTVwbGFjZXMuY29tX3JrNG12NzFnYzEwNDhwZ3EwcWptMDZidGdjQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20)
