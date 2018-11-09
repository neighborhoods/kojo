# ⚡ Neighborhoods Kōjō ⚡
# 工場
A distributed task manager.

### `Kōjō` is a collection of the following components:
* Distributed task management.
* Distributed, cooperative, process-aware semaphores and mutex's.
* Static cron scheduling.
* Multi-process model.
* Status system.
* Distributed IPC.

## Trying out Kōjō

Real-world use cases for Kōjō and instructions for getting Kōjō up and running in your project can be found at [KojoFitness](https://github.com/neighborhoods/KojoFitness).

## Debuging Kōjō
XDebug version greater than `xdebug-2.7.0alpha1` is required when trying to debug Kōjō. This version of XDebug resolves issues (https://bugs.xdebug.org/938) caused by the way the Kōjō forks using `pcntl`.
