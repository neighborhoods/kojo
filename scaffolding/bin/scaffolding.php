<?php
declare(strict_types=1);

use Neighborhoods\Scaffolding\Bootstrap;

if (PHP_SAPI !== 'cli') {
    echo 'bin/kojo must be run as a CLI application';
    exit(1);
}
try{
    foreach ([
                 __DIR__ . '/../../../autoload.php',
                 __DIR__ . '/../vendor/autoload.php',
             ] as $autoLoaderFilePathCandidate) {
        if (file_exists($autoLoaderFilePathCandidate)) {
            require_once $autoLoaderFilePathCandidate;
            break;
        }
    }
}catch(\Exception $exception){
    echo 'Autoload error: ' . $exception->getMessage();
    exit(1);
}

Bootstrap::setUp();

return;