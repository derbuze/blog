<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 01.02.2018
 * Time: 21:24
 */

namespace Repositories;


use Entities\Author;
use Entities\BlogItem;
use PDO;
use Vendor\IRepository;

class BlogItemRepository implements IRepository
{

    /** @var PDO $pdo */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string|null $id
     * @return BlogItem|null
     */
    public function findOne(string $id = null)
    {
        try {
            $sql = "SELECT 
                    blogitem.id as blogitem_id, 
                    blogitem.subject as blogitem_subject, 
                    blogitem.content as blogitem_content,
                    author.id as author_id,
                    author.lastname as author_lastname,
                    author.firstname as author_firstname,
                    author.email as author_email
                  FROM blogitem
                  JOIN author ON blogitem.author_id = author.id
                  WHERE blogitem.id = :id
                  LIMIT 1;";

            $statement = $this->pdo->prepare($sql);
            $statement->execute(array('id' => $id));
            $result = $statement->fetch();

            $author = new Author();
            $author->setId($result['author.id']);
            $author->setLastName(($result['author.lastname']));
            $author->setFirstName(($result['author.firstname']));
            $author->setEmail($result['author.email']);

            $blogItem = new BlogItem();
            $blogItem->setId($result['blogitem.id']);
            $blogItem->setSubject($result['blogitem.subject']);
            $blogItem->setContent($result['blogitem.content']);
            $blogItem->setAuthor($author);

            return $blogItem;

        } catch (\Exception $e) {
            // @TODO LOG
            echo $e->getMessage();
            return null;
        }


    }

    /**
     * @param array $ids
     * @return array
     */
    public function find(array $ids = []): array
    {
        $blogItems = [];

        try {
            $sql = "SELECT 
                    blogitem.id as blogitem_id, 
                    blogitem.subject as blogitem_subject, 
                    blogitem.content as blogitem_content,
                    author.id as author_id,
                    author.lastname as author_lastname,
                    author.firstname as author_firstname,
                    author.email as author_email
                  FROM blogitem
                  JOIN author ON blogitem.author_id = author.id;";

            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            while($result = $statement->fetch()) {
                $author = new Author();
                $author->setId($result['author_id']);
                $author->setLastName(($result['author_lastname']));
                $author->setFirstName(($result['author_firstname']));
                $author->setEmail($result['author_email']);

                $blogItem = new BlogItem();
                $blogItem->setId($result['blogitem_id']);
                $blogItem->setSubject($result['blogitem_subject']);
                $blogItem->setContent($result['blogitem_content']);
                $blogItem->setAuthor($author);

                $blogItems[] = $blogItem;
            }

            return $blogItems;

        } catch (\Exception $e) {
            // @TODO LOG
            echo $e->getMessage();
            return [];
        }


    }
}