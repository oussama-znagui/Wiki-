<?php
// include "../config/connexion.php";
class Tag
{
    private $id_tag;
    private $tag;

    public function __construct($idT, $tag)
    {
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


    public static function getTags()
    {
        $sql = DB::connexion()->query("SELECT * from tags");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $tags = array();
        foreach ($result as $row) {
            $tag = new Tag($row["id_tag"], $row["tag"]);
            array_push($tags, $tag);
        }
        return $tags;
    }
}

// print_r(Tag::getTags());
