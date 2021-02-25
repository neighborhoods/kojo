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

A guide/reference for common usage patterns can be found [here](docs/Usage%20Patterns.md).

## Debugging Kōjō
XDebug version greater than `xdebug-2.7.0alpha1` is required when trying to debug Kōjō. This version of XDebug resolves issues (https://bugs.xdebug.org/938) caused by the way the Kōjō forks using `pcntl`.

If you are using PhpStorm and you have more concurrent Kōjō jobs running than the `Max. simultaneous connections` defined for your XDebug listener, Kōjō will appear to hang. To avoid this, increase your `Max. simultaneous connections` to the max value of `20` in PhpStorm's preferences under `Languages & Frameworks` > `PHP` > `Debug`, `External connections` section.
