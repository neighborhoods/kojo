# nhds/jobs
A Distributed Task Manager

* Including `NHDS\Jobs` with your project with composer
```bash
$ composer require nhds/jobs
```

* Running the `NHDS\Jobs` service
```bash
$ vendor/bin/jobs process:pool:server:start $PWD/PATH/TO/services.yaml
```

* Running an exmaple
```bash
$ vendor/bin/phpunit --filter Foreman
$ vendor/bin/jobs process:pool:server:start $PWD/example/config/root.yaml
```
