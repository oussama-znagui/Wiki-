<?php
// include "../config/connexion.php";
class Categorie
{
    private $id_cat;
    private $titre;
    private $description;

    public function __construct($idC, $t, $desc)
    {
        $this->id_cat = $idC;
        $this->titre = $t;
        $this->description = $desc;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }
    public function __set($prop, $value)
    {
        return $this->$prop = $value;
    }

    public static function getCategories()
    {
        $sql = DB::connexion()->query("SELECT * from categories");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $Categories = array();
        foreach ($result as $row) {
            $Categorie = new Categorie($row['id_cat'], $row['categorie'], $row['description']);
            array_push($Categories, $Categorie);
        }
        return $Categories;
    }
    public function addCategorie()
    {
        $id  = null;
        $titre = $this->titre;
        $desc = $this->description;
        $sql = DB::connexion()->prepare("INSERT into categories values(:id, :titre, :desc)");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':titre', $titre);
        $sql->bindParam(':desc', $desc);
        $sql->execute();
    }

    public  function getCat()
    {
        $idCat = $this->id_cat;
        $sql = DB::connexion()->query("SELECT * FROM categories WHERE categories.id_cat = $idCat ;");
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);


        $cat = new Categorie($row[0]['id_cat'], $row[0]['categorie'], $row[0]['description']);



        return $cat;
    }
}

// print_r(Categorie::getCategories());
