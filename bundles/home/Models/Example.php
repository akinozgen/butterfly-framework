<?php

namespace Butterfly\Bundles\Home\Models;

use Butterfly\System\ActiveClass;

class Example extends ActiveClass
{
    private $id;
    private $key;
    private $content;
    private $image;

    /**
     * Example constructor.
     * @param object $data form database fetch::obj
     */
    function __construct($data)
    {
        $this->id = $data->id;
        $this->key = $data->key;
        $this->content = $data->content;
        $this->image = $data->image;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}