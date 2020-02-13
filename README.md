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
