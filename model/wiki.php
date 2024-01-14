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
    private $statut;

    public function __construct($idW, $t, $c, $img, $cDate, $idUser, $idC, $cat, $catDesc, $statut)
    {
        $this->id_wiki = $idW;
        $this->titre = $t;
        $this->content = $c;
        $this->image = $img;
        $this->crationDate = $cDate;
        $this->user = new User();
        $this->categorie = new Categorie($idC, $cat, $catDesc);
        $this->user->__set("id_user", $idUser);
        $this->statut = $statut;
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

        $sql = DB::connexion()->prepare("INSERT into wikis values(:id, :titre, :content, :image, :creationDate, :id_user, :id_cat, :statut)");
        $idUser = $this->user->__get("id_user");
        $idCategorie = $this->categorie->__get("id_cat");
        $id = NULL;
        $statut = 1;
        $sql->bindParam(":id", $id);
        $sql->bindParam(":titre", $this->titre);
        $sql->bindParam(":content", $this->content);
        $sql->bindParam(":image", $this->image);
        $sql->bindParam(":creationDate", $this->crationDate);
        $sql->bindParam(":id_user", $idUser);
        $sql->bindParam(":id_cat", $idCategorie);
        $sql->bindParam(":statut", $statut);

        $sql->execute();
    }

    public static function getWikis()
    {
        $sql = DB::connexion()->query("SELECT * FROM wikis JOIN categories JOIN users WHERE wikis.id_cat = categories.id_cat AND wikis.id_user = users.id_user ORDER by wikis.id_wiki DESC ;");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $wikis = array();
        foreach ($result as $row) {
            $wiki = new Wiki($row['id_wiki'], $row['titre'], $row['content'], $row['image'], $row['creationDate'], $row['id_user'], $row['id_cat'], $row['categorie'], $row['description'], $row['statut']);
            $wiki->user->__set("fullName", $row['fullName']);
            array_push($wikis, $wiki);
        }
        return $wikis;
    }


    public  function getWiki()
    {
        $idWiki = $this->id_wiki;
        $sql = DB::connexion()->query("SELECT * FROM wikis JOIN categories JOIN users WHERE wikis.id_cat = categories.id_cat AND wikis.id_user = users.id_user AND wikis.id_wiki = $idWiki ;");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);


        $wiki = new Wiki($row[0]['id_wiki'], $row[0]['titre'], $row[0]['content'], $row[0]['image'], $row[0]['creationDate'], $row[0]['id_user'], $row[0]['id_cat'], $row[0]['categorie'], $row[0]['description'], $row['status']);
        $wiki->user->__set("fullName", $row[0]['fullName']);


        return $wiki;
    }

    public function deleteWiki()
    {
        $idWiki = $this->id_wiki;
        $sql = DB::connexion()->query("DELETE from wikis where id_wiki = $idWiki");
        $sql->execute();
    }
    public function updateWiki()
    {
        $idWiki = $this->id_wiki;
        $title = "$this->titre";
        $content = $this->content;
        $image = $this->image;
        $cat = $this->categorie->__get('id_cat');
        echo $idWiki . "   ->";
        echo $title . "   ->";
        echo $content . "   ->";
        echo $image . "   ->";
        echo $cat . "   ->";
        $sql = DB::connexion()->prepare("UPDATE wikis set titre = :title, content = :content, image = :image, id_cat = :cat where id_wiki = :idWiki");
        $sql->bindParam(':idWiki', $idWiki);
        $sql->bindParam(':title', $title);
        $sql->bindParam(':content', $content);
        $sql->bindParam(':image', $image);
        $sql->bindParam(':cat', $cat);


        $sql->execute();
    }

    public function archiverWiki(){
        $idw = $this->id_wiki;
        $sql = DB::connexion()->query("UPDATE wikis set statut where id_wiki = $idw");
        $sql->execute();
        
    }
}


$date = date("Y-m-d");
$wiki = new Wiki(null, 'first wiki', 'no content', '../media/home.jpg', $date, 1, 2, null, "ssg", 1);
// print_r($wiki);


// $wiki->addWiki();
// print_r(Wiki::getWikis());
