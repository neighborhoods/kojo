# ⚡ Neighborhoods Kōjō ⚡
# 工場
A distributed task manager.

### `Kōjō` is a collection of the following components:
* Distributed task management.
* Distributed, cooperative, process-aware semaphores and mutexes.
* Static cron scheduling.
* Multi-process model.
* Distributed IPC.

## Trying out Kōjō

Real-world use cases for Kōjō and instructions for getting Kōjō up and running in your project can be found at [KojoFitness](https://github.com/neighborhoods/KojoFitness).

## Configuring Kōjō
The `kojo_job_table` database table and the `\Neighborhoods\Kojo\Api\V1\Job\Type\ServiceInterface::getNewJobTypeRegistrar` Kōjō API client provide ways to control the scheduling behavior of Kōjō workers.  

Each column in the `kojo_job_table` has a specific purpose
`type_code`: machine_readable_name used to select and schedule jobs. Typical convention is to use all lowercase with underscores snake_case.
`name`: Human-readable name which can be used for display purposes
`worker_uri`: Class which will be created for the job
`worker_method`: Method of `worker_uri` class that is called when a job is run
`can_work_in_parallel`: Defines if multiple instances of job can be worked at the same time across all execution environments
`default_importance`:  Defines the priority of the job. Jobs with a higher importance will get scheduled first when resources are constrained
`cron_expression`: [crontab](https://crontab.guru/) formatted expression of how often the job will be added to the schedule, or null if the job is supposed to be dynamically scheduled
`schedule_limit`:  Number of concurrent jobs allowed to be in a `working` state at the same time.
`schedule_limit_allowance`: Number of jobs allowed to be in a `waiting` state at the same time.
`is_enabled`: Turn the job on and off.
`auto_complete_success`: Once the job is no longer running, assume it completed successfully, even if the worker didn't `requestCompleteSucess`
`auto_delete_interval_duration`: Defines how long `complete_success` and `complete_failed` jobs should remain in the `kojo_job` table using [ISO 8601 Duration String format](https://en.wikipedia.org/wiki/ISO_8601#Durations)

### Example job configurations
#### Parallel workers
If you had a Kōjō job designed to read messages from a queue, and wanted to have multiple workers grabbing a message and start doing work to increase throughput you would use the following settings:
`can_work_in_parallel`: true - allow multiple jobs to be in `working` state
`cron_expression`: '* * * * *' - every 1 minute create new workers to watch the queue
`schedule_limit`: 5 - allow up to 5 workers to be in the `working` state
`schedule_limit_allowance`: 5 - have 5 workers on standby in `waiting` state to replace the other jobs as they complete

#### Singleton worker
If you needed a worker that had exclusive access to a table or resource, you can use the following setting to ensure that only one worker of this type will be created:
`can_work_in_parallel`: false - only 1 worker is allowed in the `working` state
`cron_expression`: '0 22 * * 1-5' - create a worker Mon-Fri at 22:00
`schedule_limit`: 1 - allow up to 1 workers to be in the `working` state
`schedule_limit_allowance`: 1 - have 1 workers on standby in `waiting` state to replace the other job as it completes or fails

#### Dynamically scheduled worker
If you have worker that is dynamically creating Kōjō workers based on events by using the `\Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface::getNewJobScheduler` API then it needs the have the following settings defined:
`cron_expression`: `null` - A `null` value tells Kōjō to never schedule the job based on the current time
`schedule_limit`: 0 - this removes the schedule limit and gives that control to the service that is calling the `getNewJobScheduler` method.
`schedule_limit_allowance`: 0 - this removes the schedule limit and gives that control to the service that is calling the `getNewJobScheduler` method.

## Debugging Kōjō
XDebug version greater than `xdebug-2.7.0alpha1` is required when trying to debug Kōjō. This version of XDebug resolves issues (https://bugs.xdebug.org/938) caused by the way the Kōjō forks using `pcntl`.

If you are using PhpStorm and you have more concurrent Kōjō jobs running than the `Max. simultaneous connections` defined for your XDebug listener, Kōjō will appear to hang. To avoid this, increase your `Max. simultaneous connections` to the max value of `20` in PhpStorm's preferences under `Languages & Frameworks` > `PHP` > `Debug`, `External connections` section.

## Kōjō appears to be hanging during local development?

* Stop all local containers and rebuild them
* Run `ps -auxf` to see if any processes are still running Kōjō with a title like `neighborhoods-kojo: /server[8]/root[22]/job[30]`
    - If yes run `pkill -9 -f kojo` to SIG_KILL all the processes containing the word `kojo`
* Run `docker-compose exec redis redis-cli monitor` to see if Kōjō is creating any activity in redis.
  * If nothing is streaming by like `"GET" "/neighborhoods/kojo/area_manager/job_state_changelog_processor.lock"` messages then something else is blocking the execution of Kōjō internals. This is typically due to a debugger.
* Turn off the debugger. Sometimes this will mess with Kojo
* Check your version of XDebug (version before `2.7.0` won't work and `2.8.2` has seen some odd behavior. Recommend `2.9.2`)
* Checkout the debugging logs [Troubleshooting common PHP debugging issues - Help | PhpStorm](https://www.jetbrains.com/help/phpstorm/troubleshooting-php-debugging.html#)
