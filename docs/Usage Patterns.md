# Kojo usage patterns

Kojo makes as few assumptions as possible about your workload, and is thus flexible enough to support many different patterns of usage.
"Using" a given "pattern" is a combination of a) configuring your `kojo_job_type` values correctly, and b) interacting with Kojo's runtime API a certain way.
This document will enumerate various patterns and provide guidance on when and how to use them.

As a simple example, imagine a workload where we need to perform an action, say, every day at midnight (UTC).
When creating the job type, we'd use the [Job Type Service and Registrar](https://github.com/neighborhoods/kojo/tree/5.x/src/Api/V1/Job/Type), and the most important piece of configuration here would be to `->setCronExpression('0 0 * * *')`, resulting in Kojo adding a row to `kojo_job` at midnight UTC every day.
Though not strictly necessary, it's also good practice to `->setCanWorkInParallel(false)` and `->setScheduleLimit(1)` (if not to guard against situations where there are multiple instances of this job (e.g. if a user dynamically schedules them), then at least to signal to posterity how this job type is intended to work).
At runtime, the only interaction with Kojo's API necessary is to signal state changes of the job with the [Worker Service](https://github.com/neighborhoods/kojo/blob/5.x/src/Api/V1/Worker/ServiceInterface.php) (e.g. `->requestCompleteSuccess()->applyRequest()`).

### Continuous Singleton

This pattern is for situations where you need to do some work continuously, and having a single process is sufficient compute for keeping up with the work (e.g. polling something for changes and then processing those changes).

#### Kojo Job Type Configuration

Field | Value | Notes
--- | --- | ---
can_work_in_parallel |  |
cron_expression |  |
schedule_limit |  |

#### Kojo Runtime API Interactions

None.

#### Variations

* Guaranteeing that at most one will be running
    * Set `can_work_in_parallel: true` and `schedule_limit: 1`
* Guaranteeing that at least one will be running
    * Set `cron_expression: '* * * * *'`
        * (or similar, depending on the maximum time between runs you're comfortable with)
* Being a good citizen
    * You can get away with just having one instance of this job running forever, but Kojo relies on [cooperative multitasking](https://en.wikipedia.org/wiki/Cooperative_multitasking), so it's a good idea to have your worker gracefully "bow out" and return control to kojo
    * Changes required for this are using the Kojo Runtime API to
        * [Schedule a copy of yourself](https://github.com/neighborhoods/kojo/blob/5.x/src/Api/V1/Worker/ServiceInterface.php#L31)
        * requestCompleteSuccess()

#### Examples

https://github.com/neighborhoods/KojoFitness/blob/master/UseCase45/src/V1/Worker.php


TODO:
* other patterns
* extract common stuff like "being a good citizen" out of individual sections
* create a decision flowchart for which pattern to use
