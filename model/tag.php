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

    public  function addTag()
    {
        $tag = $this->tag;
        $sql = DB::connexion()->query("INSERT INTO tags VALUES(null,'$tag')");
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

    public  function getTag()
    {
        $idTag = $this->id_tag;
        $sql = DB::connexion()->query("SELECT * from tags where id_tag = $idTag");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        $tag = new Tag($row[0]["id_tag"], $row[0]["tag"]);

        return $tag;
    }

    public function DeleteTag()
    {
        $idTag = $this->id_tag;
        $sql = DB::connexion()->query("DELETE from tags where id_tag  = $idTag");
        $sql->execute();
    }


    public function updateTag()
    {
        $idt = $this->id_tag;
        $tag = $this->tag;

        $sql = DB::connexion()->prepare("UPDATE tags set tag = :tag  where id_tag = :idTag");
        $sql->bindParam(':tag', $tag);
        $sql->bindParam(':idTag', $idt);


        $sql->execute();
    }

    public static function countTags()
    {
        $sql = DB::connexion()->query("SELECT count(*) as count from tags");

        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['count'];
    }
}

// print_r(Tag::getTags());
