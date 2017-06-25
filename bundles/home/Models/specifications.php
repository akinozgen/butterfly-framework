<?php
/**
 * Created by PhpStorm.
 * User: akinozgen
 * Date: 6/25/17
 * Time: 2:00 PM
 */

namespace Butterfly\Bundles\Home\Models;

use Butterfly\System\ActiveClass;
use Butterfly\System\Database;

class SpecificationsFactory extends ActiveClass
{

    function __construct()
    {

    }

    /**
     * @param $id
     * @return Specification|null
     */
    public function get($id) {
        if ($id) {
            $data = $this->getDatabase()->clean()
                ->select('specifications', '*')
                ->where([
                    'id' => $id
                ])
                ->exec(Database::FETCH_OBJ);
            if (isset($data) && $data->rowCount() > 0) {
                return new Specification($data->fetch());
            } else {
                return null;
            }
        }
    }

    public function getAll() {
        $data = $this->getDatabase()->clean()
            ->select('specifications', '*')
            ->order('created', 'desc')
            ->exec(Database::FETCH_OBJ);

        if (isset($data) && $data->rowCount() > 0) {
            foreach ($data->fetchAll() as $spec) {
                return yield new Specification($spec);
            }
        } else {
            return null;
        }
    }

}

class Specification
{
    private $id;
    private $title;
    private $description;
    private $created;

    function __construct($data)
    {
        /**@var Specification $data*/
        $this->id = $data->id;
        $this->title = $data->title;
        $this->description = $data->description;
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
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}