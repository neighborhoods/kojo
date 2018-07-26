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


### Setting up a Worker.
`example/bin/setup-worker.php`

### Example usage
```bash
$ cd example
$ vendor/bin/kojo process:pool:server:start $PWD/src/V1/Environment
```