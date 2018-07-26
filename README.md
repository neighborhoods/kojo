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

### Install Kōjō
```bash
$ cd example
$ vendor/bin/kojo db:setup:install $PWD/src/V1/Environment
```

### Setting up a Worker.
```bash
$ cd example
$ php bin/setup-worker.php
```

### Example usage
Change `https://sqs.us-east-1.amazonaws.com/272157948465/local-bwilson` in `example/src` and `example/bin/create-messages.php` to your favorite SQS queue.

```bash
$ cd example
$ php bin/create-messages.php
$ vendor/bin/kojo process:pool:server:start $PWD/src/V1/Environment
```

### Uninstall Kōjō
```bash
$ cd example
$ vendor/bin/kojo db:tear_down:uninstall $PWD/src/V1/Environment
```