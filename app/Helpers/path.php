<?php

function DS()
{
    return DIRECTORY_SEPARATOR;
}

function getModulePath($moduleName)
{
    return app_path('Modules' . DS() . $moduleName . DS());
}

function loadConfigFile($fileName, $moduleName)
{
    return getModulePath($moduleName) . 'config' . DS() . $fileName . '.php';
}

function loadRoute($fileName, $moduleName)
{
    return getModulePath($moduleName) . 'routes' . DS() . $fileName . '.php';
}

function loadMigrations($moduleName)
{
    return getModulePath($moduleName) . 'database' . DS() . 'migrations';
}

