<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Mutex;

use Neighborhoods\Kojo\Exception\Runtime;
use Neighborhoods\Kojo\Exception\Runtime\Filesystem\Exception;
use Neighborhoods\Kojo\Semaphore\MutexAbstract;
use Neighborhoods\Kojo\Semaphore\MutexInterface;
use Neighborhoods\Kojo\Logger;
use Neighborhoods\Kojo\Symfony;

class Flock extends MutexAbstract
{
    use Symfony\Component\Filesystem\Filesystem\AwareTrait;
    use Logger\AwareTrait;
    protected $fileName;
    protected $directoryPath;
    protected $filePointer;
    protected $filePath;
    protected $fileMode;
    protected $directoryMode;
    protected $hasLock = false;
    protected $directoryPathPrefix;

    public function testAndSetLock(): bool
    {
        if ($this->hasLock === false) {
            if (flock($this->getLockFilePointer(), $this->getFlockLockOperation()) === true) {
                $this->hasLock = true;
            }
        } else {
            throw new \LogicException('The mutex already has obtained a lock.');
        }

        return $this->hasLock;
    }

    public function releaseLock(): MutexInterface
    {
        if ($this->hasLock === true) {
            if (flock($this->getLockFilePointer(), LOCK_UN) === false) {
                throw new (new Exception())->setCode(Exception::CODE_UNLOCK_FAILED);
            }
            $this->hasLock = false;
            if (fclose($this->getLockFilePointer()) === false) {
                $this->filePointer = null;
                throw (new Exception())->setCode(Exception::CODE_FCLOSE_FAILED);
            }
        } else {
            throw new \LogicException('The mutex has not obtained a lock.');
        }

        return $this;
    }

    public function hasLock(): bool
    {
        return $this->hasLock;
    }

    protected function getLockFilePointer()
    {
        if ($this->filePointer === null) {
            if (!is_readable($this->getFilePath())) {
                $this->getSymfonyComponentFilesystemFilesystem()->mkdir(
                    $this->getDirectoryPath(), $this->getDirectoryMode()
                );
            }

            $filePointer = fopen($this->getFilePath(), $this->getFileMode());
            if (!is_resource($filePointer) || $filePointer === false) {
                throw (new Exception())->setCode(Exception::CODE_FOPEN_FAILED);
            }
            $this->filePointer = $filePointer;
        }

        return $this->filePointer;
    }

    protected function getFilePath()
    {
        if ($this->filePath === null) {
            $this->filePath = $this->getDirectoryPath() . DIRECTORY_SEPARATOR . $this->getFileName();
        }

        return $this->filePath;
    }

    public function setDirectoryPathPrefix(string $directoryPathPrefix): Flock
    {
        if (!$this->hasDirectoryPathPrefix()) {
            $this->directoryPathPrefix = $directoryPathPrefix;
        } else {
            throw new \LogicException('Directory path prefix is already set.');
        }

        return $this;
    }

    protected function getDirectoryPathPrefix(): string
    {
        if (!$this->hasDirectoryPathPrefix()) {
            throw new \LogicException('Directory path prefix is not set.');
        }

        return $this->directoryPathPrefix;
    }

    protected function hasDirectoryPathPrefix(): bool
    {
        return $this->directoryPathPrefix === null ? false : true;
    }

    public function setFileMode(string $fileMode)
    {
        if ($this->fileMode === null) {
            $this->fileMode = $fileMode;
        } else {
            throw new \LogicException('File mode is already set.');
        }

        return $this;
    }

    protected function getFileMode()
    {
        if ($this->fileMode === null) {
            throw new \LogicException('File mode is not set.');
        }

        return $this->fileMode;
    }

    protected function getDirectoryPath()
    {
        if ($this->directoryPath === null) {
            if ($this->hasDirectoryPathPrefix()) {
                $directoryPathPrefix = $this->getDirectoryPathPrefix();
            } else {
                $directoryPathPrefix = '';
            }
            $this->directoryPath = $directoryPathPrefix . $this->getResource()->getResourcePath();
        }

        return $this->directoryPath;
    }

    protected function getFileName()
    {
        if ($this->fileName === null) {
            $this->fileName = $this->getResource()->getResourceName();
        }

        return $this->fileName;
    }

    protected function getDirectoryMode()
    {
        if ($this->directoryMode === null) {
            throw new \LogicException('Directory mode is not set.');
        }

        return $this->directoryMode;
    }

    public function setDirectoryMode(int $directoryMode)
    {
        if ($this->directoryMode === null) {
            $this->directoryMode = $directoryMode;
        } else {
            throw new \LogicException('Directory mode is already set.');
        }

        return $this->directoryMode;
    }

    protected function getFlockLockOperation()
    {
        return $this->getIsBlocking() ? LOCK_EX : LOCK_EX | LOCK_NB;
    }
}