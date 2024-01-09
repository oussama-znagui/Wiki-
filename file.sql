CREATE DATABASE wikis CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE users
(
   id_user INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    fullName VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255),
    role int
)
CREATE TABLE categories
(
   id_cat INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    categorie VARCHAR(100),
    description TEXT
)
CREATE TABLE wikis
(
   id_wiki INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titre VARCHAR(100),
    content TEXT,
    image VARCHAR(255),
    creationDate DATE,
    id_user int,
    id_cat int,
    FOREIGN KEY (id_user) REFERENCES users (id_user)
    FOREIGN KEY (id_cat) REFERENCES categories (id_cat)
)
CREATE TABLE tags
(
   id_tag INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    tag VARCHAR(100),
)
CREATE TABLE wikisTags
(
   id_wikisTags INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
   id_wiki int,
   id_tag int,
   FOREIGN KEY (id_wiki) REFERENCES wikis (id_wiki)
    FOREIGN KEY (id_tag) REFERENCES tags (id_tag)
   
)



