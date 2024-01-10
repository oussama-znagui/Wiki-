<?php
// include '../config/connexion.php';
include '../model/categorie.php';
include '../model/user.php';
class Wiki
{
    private $id_wiki;
    private $titre;
    private $content;
    private $image;
    private $crationDate;
    private User $user;
    private Categorie $categorie;

    public function __construct($idW, $t, $c, $img, $cDate, $idUser, $idC, $cat, $catDesc)
    {
        $this->id_wiki = $idW;
        $this->titre = $t;
        $this->content = $c;
        $this->image = $img;
        $this->crationDate = $cDate;
        $this->user = new User();
        $this->categorie = new Categorie($idC, $cat, $catDesc);
        $this->user->__set("id_user", $idUser);
    }




    public function __get($prop)
    {
        return $this->$prop;
    }
    public function __set($prop, $value)
    {
        return $this->$prop = $value;
    }

    public function addWiki()
    {

        $sql = DB::connexion()->prepare("INSERT into wikis values(:id, :titre, :content, :image, :creationDate, :id_user, :id_cat)");
        $idUser = $this->user->__get("id_user");
        $idCategorie = $this->categorie->__get("id_cat");
        $id = NULL;
        $sql->bindParam(":id", $id);
        $sql->bindParam(":titre", $this->titre);
        $sql->bindParam(":content", $this->content);
        $sql->bindParam(":image", $this->image);
        $sql->bindParam(":creationDate", $this->crationDate);
        $sql->bindParam(":id_user", $idUser);
        $sql->bindParam(":id_cat", $idCategorie);
        // echo "----> " . $this->titre;
        // echo "----> " . $this->content;
        // echo "----> " . $this->crationDate;
        // echo "----> " . $this->user->__get("id_user");
        // echo "----> " . $this->categorie->__get("id_cat");
        // echo "----> " . $this->image;
        $sql->execute();
    }
}
$date = date("Y-m-d");
$wiki = new Wiki(null, 'first wiki', 'no content', '../media/home.jpg', $date, 1, 2, null, "ssg");
// print_r($wiki);


// $wiki->addWiki();