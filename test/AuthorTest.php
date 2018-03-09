<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 22.02.18
 * Time: 22:10
 */

namespace Tests;

require __DIR__ . "/../src/Entities/Author.php";

use Entities\Author;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{

    public function testEmailCanBeSetFromValidEmailAddress()
    {
        $author = new Author();
        $author->setEmail('validemail@test.de');
        $this->expectOutputString('validemail@test.de');
        print $author->getEmail();
    }

    public function testEmailCannotBeSetFromInvalidEmailAddress()
    {
        $author = new Author();
        $this->expectException(\InvalidArgumentException::class);
        $author->setEmail('invalid@email@test.de');
    }
}
