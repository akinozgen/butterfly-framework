<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/25/17
 * Time: 7:06 PM
 */

namespace Butterfly\Bundles\Icerik\Models;

use Butterfly\Bundles\Home\Models\User;
use Butterfly\Bundles\Home\Models\UserFactory;
use Butterfly\System\ActiveClass;
use Butterfly\System\Database;

class BlogFactory extends ActiveClass
{

    function __construct()
    {
        parent::__construct();
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\User');
    }

    /**
     * @param $id
     * @return Blog
     */
    public function get($id) {
        $data = $this->getDatabase()->clean()
            ->select('blogs', '*')
            ->where([
                'id' => $id
            ])
            ->exec(Database::FETCH_OBJ);

        if ($data) {
            return new Blog($data->fetch());
        }
    }

    /**
     * @return Blog[]
     */
    public function getAll($where = null) {
        $blogs = [];
        $data = $this->getDatabase()->clean()
            ->select('blogs', '*')
            ->where($where)
            ->order('created', 'desc')
            ->exec(Database::FETCH_OBJ);

        if ($data) {
            foreach ($data->fetchAll() as $blog) {
                $blogs[] = $blog;
            }
        }

        return $blogs;
    }

    /**
     * @param Blog $blog
     * @return \PDOStatement
     */
    public function set(Blog $blog) {
        $result = $this->getDatabase()->clean()
            ->insert('blogs', [
                'title' => $blog->getTitle(),
                'content' => $blog->getContent(),
                'image' => $blog->getImage(),
                'tags' => $blog->getTags(),
                'author' => $blog->getAuthor()->getId()
            ])
            ->exec();

        return $result;
    }

    public function save(Blog $blog) {
        $result = $this->getDatabase()->clean()
            ->update('blogs', [
                'title' => $blog->getTitle(),
                'content' => $blog->getContent(),
                'image' => $blog->getImage(),
                'tags' => $blog->getTags(),
                'author' => $blog->getAuthor()->getId()
            ])
            ->where([ 'id' => $blog->getId() ])
            ->exec();

        return $result;
    }

    /**
     * @param $id
     * @return \PDOStatement
     */
    public function remove($id) {
        $result = $this->getDatabase()->clean()
            ->delete('blogs')
            ->where([ 'id' => $id ])
            ->exec();

        return $result;
    }

}

/**
 * @var int $id
 * @var string $title
 * @var string $content
 * @var string $image
 * @var array  $tags
 * @var User   $author
 * @var string $created
 */
class Blog {
    private $id;
    private $title;
    private $content;
    private $image;
    private $tags;
    private $author;
    private $created;

    function __construct($data)
    {
        /**@var Blog $data*/
        $userFactory = new UserFactory();

        $this->id = $data->id;
        $this->title = $data->title;
        $this->content = $data->content;
        $this->image = $data->image;
        $this->tags = explode(',', $data->tags);
        $this->author = $userFactory->get($data->author);
        $this->created = $data->created;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return User|null
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getTags()
    {
        return implode($this->tags, ', ');
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param User|null $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = [];

        foreach ($tags as $tag) {
            $this->tags[] = trim($tag);
        }
    }
}