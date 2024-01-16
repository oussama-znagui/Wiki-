<?php

class WikiTAgs
{
    private $id_wikisTags;
    private Wiki $wiki;
    private Tag $tag;

    public function __construct($id, $wiki, $tag)
    {
        $this->id_wikisTags = $id;
        $this->wiki = $wiki;
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

    public function addWikiTags()
    {
        $idw = $this->wiki->__get("id_wiki");
        $idt = $this->tag->__get("id_tag");
        $sql = DB::connexion()->query("INSERT into wikistags values(null,$idw,$idt)");
        // $sql->execute();
    }

    public function getWikiTags(){
        $idW = $this->wiki->__get("id_wiki");
        $sql = DB::connexion()->query("SELECT * FROM wikistags JOIN tags WHERE wikistags.id_tag = tags.id_tag AND wikistags.id_wiki = $idW");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $tags = array();
        foreach ($result as $row) {
            $tag = new Tag($row["id_tag"], $row["tag"]);
            array_push($tags, $tag);
        }
        return $tags;
    }

    public function deleteTags(){
        $idW = $this->wiki->__get("id_wiki");
        $sql = DB::connexion()->query("DELETE FROM wikistags where id_wiki = $idW");
        
    }

}
