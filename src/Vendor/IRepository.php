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

    public function __construct(PDO $pdo);

    public function findOne(string $id = null);

    public function find(array $ids = []);

}