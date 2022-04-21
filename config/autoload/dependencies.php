<?php
declare(strict_types=1);

use Hyperf\Di\ReflectionManager;

if (!function_exists('loadDaoInterface')) {
    function loadDaoInterface(): array
    {
        $dir = [
            BASE_PATH . '/app/Repository/Dao/MySQL',
        ];
        if (empty($dir)) {
            return [];
        }
        $result = ReflectionManager::getAllClasses($dir);
        $output = [];
        foreach ($result as $class) {
            /** @var ReflectionClass $class */
            $output[$class->getInterfaceNames()[0]] = $class->getName();
        }
        return $output;
    }
}

$daoInterface = loadDaoInterface();

return array_merge($daoInterface, [

]);
