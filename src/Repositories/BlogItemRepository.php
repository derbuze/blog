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
use Exception;
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
                    blogitem.id AS blogitem_id, 
                    blogitem.subject AS blogitem_subject, 
                    blogitem.content AS blogitem_content,
                    author.id AS author_id,
                    author.lastname AS author_lastname,
                    author.firstname AS author_firstname,
                    author.email AS author_email
                  FROM blogitem
                  JOIN author ON blogitem.author_id = author.id
                  WHERE blogitem.id = :id
                  LIMIT 1;";

            $statement = $this->pdo->prepare($sql);
            $statement->execute(array('id' => $id));
            $result = $statement->fetch();

            $author = new Author();
            $author->setId((int) $result['author_id']);
            $author->setLastName(($result['author_lastname']));
            $author->setFirstName(($result['author_firstname']));
            $author->setEmail($result['author_email']);

            $blogItem = new BlogItem();
            $blogItem->setId((int) $result['blogitem_id']);
            $blogItem->setSubject($result['blogitem_subject']);
            $blogItem->setContent($result['blogitem_content']);
            $blogItem->setAuthor($author);

            return $blogItem;

        } catch (Exception $e) {
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
                    blogitem.id AS blogitem_id, 
                    blogitem.subject AS blogitem_subject, 
                    blogitem.content AS blogitem_content,
                    author.id AS author_id,
                    author.lastname AS author_lastname,
                    author.firstname AS author_firstname,
                    author.email AS author_email
                  FROM blogitem
                  JOIN author ON blogitem.author_id = author.id;";

            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            while ($result = $statement->fetch()) {
                $author = new Author();
                $author->setId((int) $result['author_id']);
                $author->setLastName(($result['author_lastname']));
                $author->setFirstName(($result['author_firstname']));
                $author->setEmail($result['author_email']);

                $blogItem = new BlogItem();
                $blogItem->setId((int) $result['blogitem_id']);
                $blogItem->setSubject($result['blogitem_subject']);
                $blogItem->setContent($result['blogitem_content']);
                $blogItem->setAuthor($author);

                $blogItems[] = $blogItem;
            }

            return $blogItems;

        } catch (Exception $e) {
            // @TODO LOG
            echo $e->getMessage();
            return [];
        }
    }

    /**
     * @param BlogItem $blogItem
     */
    public function save(BlogItem $blogItem)
    {
        try {

            if ($blogItem->getId() != null) {
                $sql = "UPDATE 
                    blogitem SET
                    subject = :subject,
                    content = :content,
                    author_id = :author_id
                    WHERE id = :id;";

                $statement = $this->pdo->prepare($sql);
                $statement->execute(
                    array(
                        'subject' => $blogItem->getSubject(),
                        'content' => $blogItem->getContent(),
                        'author_id' => $blogItem->getAuthor()->getId(),
                        'id' => $blogItem->getId()
                    )
                );
            } else {
                $sql = "INSERT INTO blogitem 
                    (subject, content, author_id) VALUES (:subject, :content, _author_id);";

                // TODO hier wird ncihts gespeichert
                $statement = $this->pdo->prepare($sql);
                $statement->bindParam(':subject', $blogItem->getSubject());
                $statement->bindParam(':content', $blogItem->getContent());
                $statement->bindParam(':author_id', $blogItem->getAuthor()->getId());
                $statement->execute();
            }
        } catch (Exception $e) {
            // @TODO LOG
            echo $e->getMessage();
        }
    }
}
