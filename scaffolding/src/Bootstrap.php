<?php
declare(strict_types=1);

namespace Neighborhoods\Scaffolding;

use Neighborhoods\Pylon\DependencyInjection\ContainerBuilder\Facade;
use Symfony\Component\Finder\Finder;

class Bootstrap implements BootstrapInterface
{
    protected static $_containerBuilderFacade;
    protected static $_scaffoldingRootDirectoryFinder;
    protected static $_testRootDirectoryFinder;
    protected static $_applicationRootDirectoryFinder;
    protected static $_testApplicationRootDirectoryFinder;

    public static function setUp(): void
    {
        self::getContainerBuilderFacade()->addFinder(self::_getApplicationRootDirectoryFinder());
        self::getContainerBuilderFacade()->addFinder(self::_getScaffoldingRootDirectoryFinder());
        self::getContainerBuilderFacade()->addFinder(self::_getTestApplicationRootDirectoryFinder());

        return;
    }

    protected static function _getScaffoldingRootDirectoryFinder(): Finder
    {
        if (self::$_scaffoldingRootDirectoryFinder === null) {
            $scaffoldingRootDirectoryFinder = new Finder();
            $scaffoldingRootDirectoryFinder->files()->in(self::_getScaffoldingRootDirectoryPath());
            $scaffoldingRootDirectoryFinder->name('*.yml');
            self::$_scaffoldingRootDirectoryFinder = $scaffoldingRootDirectoryFinder;
        }

        return self::$_scaffoldingRootDirectoryFinder;
    }

    protected static function _getApplicationRootDirectoryFinder(): Finder
    {
        if (self::$_applicationRootDirectoryFinder === null) {
            $applicationRootDirectoryFinder = new Finder();
            $applicationRootDirectoryFinder->files()->in(self::_getScaffoldingRootDirectoryPath() . '/../../../../src');
            $applicationRootDirectoryFinder->name('*.yml');
            self::$_applicationRootDirectoryFinder = $applicationRootDirectoryFinder;
        }

        return self::$_applicationRootDirectoryFinder;
    }

    protected static function _getTestApplicationRootDirectoryFinder(): Finder
    {
        if (self::$_testApplicationRootDirectoryFinder === null) {
            $testApplicationRootDirectoryFinder = new Finder();
            $testApplicationRootDirectoryFinder->files()->in(self::_getScaffoldingRootDirectoryPath() . '/../../../../tests/Application');
            $testApplicationRootDirectoryFinder->name('*.yml');
            self::$_testApplicationRootDirectoryFinder = $testApplicationRootDirectoryFinder;
        }

        return self::$_testApplicationRootDirectoryFinder;
    }

    protected static function _getScaffoldingRootDirectoryPath(): string
    {
        $scaffoldingRootDirectoryPath = dirname(__FILE__);

        return $scaffoldingRootDirectoryPath;
    }

    public static function getContainerBuilderFacade(): Facade
    {
        if (self::$_containerBuilderFacade === null) {
            self::$_containerBuilderFacade = new Facade();
        }

        return self::$_containerBuilderFacade;
    }
}