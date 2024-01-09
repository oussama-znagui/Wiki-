<?php
include "../config/connexion.php";
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
}

// print_r(Categorie::getCategories());
