<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 01.02.2018
 * Time: 21:17
 */

namespace Vendor;

use PDO;

class RepositoryManager
{
    public static function getRepository(string $entityName)
    {
        $pdo = self::getPdo();
        $entityName = '\Repositories\\'.$entityName.'Repository';
        return new $entityName($pdo);
    }

    /**
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        return new PDO('mysql:host=localhost;dbname=blog', 'blog', 'blog');
    }
}
