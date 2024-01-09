<?php
class Tag{
    private $id_tag;
    private $tag;

    public function __construct($idT,$tag) {
        $this->id_tag = $idT;
        $this->tag = $tag;
    }
    public function __get($prop)
    {
        return $this->$prop;
    }
    public function __set($prop, $value)
    {
        return $this->$prop = $value;
    }

}