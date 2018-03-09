<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 01.02.2018
 * Time: 21:20
 */

namespace Vendor;

use PDO;

interface IRepository
{

    /**
     * IRepository constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo);

    /**
     * @param string|null $id
     * @return mixed
     */
    public function findOne(string $id = null);

    /**
     * @param array $ids
     * @return mixed
     */
    public function find(array $ids = []);

}
