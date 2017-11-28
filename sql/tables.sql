#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: recette
#------------------------------------------------------------

CREATE TABLE recette(
        nomRecette    Varchar (23) NOT NULL ,
        descriptif    Varchar (200) ,
        difficulte    Int ,
        note          Int ,
        nbrPersonnes  Int ,
        Lipides       Float ,
        calories      Int ,
        Glucides      Float ,
        Proteines     Float ,
        Duree         Float ,
        autoIdRecette int (11) Auto_increment  NOT NULL ,
        illustration  Varchar (200) ,
        login         Varchar (25) NOT NULL ,
        PRIMARY KEY (autoIdRecette )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ingrédient
#------------------------------------------------------------

CREATE TABLE ingredient(
        nomIngredient Varchar (23) NOT NULL ,
        calories      Int ,
        Lipides       Float ,
        Glucides      Float ,
        Proteines     Float ,
        Popularite    Int ,
        isGrammes     Bool NOT NULL ,
        PRIMARY KEY (nomIngredient )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        login        Varchar (25) NOT NULL ,
        adresse      Varchar (25) NOT NULL ,
        mot_de_passe Varchar (256) NOT NULL ,
        nom          Varchar (25) NOT NULL ,
        prenom       Varchar (25) NOT NULL ,
        PRIMARY KEY (login )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: catégorie ingrédient
#------------------------------------------------------------

CREATE TABLE categorie_ingredient(
        nomCategorie Varchar (25) NOT NULL ,
        PRIMARY KEY (nomCategorie )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Etape
#------------------------------------------------------------

CREATE TABLE Etape(
        Ordre             Int NOT NULL ,
        temps             Float ,
        illustration      Varchar (200) ,
        description_etape Varchar (200) ,
        autoIdRecette     Int NOT NULL ,
        PRIMARY KEY (Ordre ,autoIdRecette )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: régime alimentaire
#------------------------------------------------------------

CREATE TABLE regime_alimentaire(
        nomRegime Varchar (25) NOT NULL ,
        PRIMARY KEY (nomRegime )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: archivePlanning
#------------------------------------------------------------

CREATE TABLE archivePlanning(
        login           Varchar (25) NOT NULL ,
        dateRealisation Date NOT NULL ,
        nomRecette      Varchar (25) NOT NULL ,
        PRIMARY KEY (login ,dateRealisation ,nomRecette )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: archiveListe
#------------------------------------------------------------

CREATE TABLE archiveListe(
        datePlanning  Date NOT NULL ,
        login         Varchar (25) NOT NULL ,
        quantite      Float ,
        grammes       Float ,
        nomIngredient Varchar (25) NOT NULL ,
        PRIMARY KEY (datePlanning ,login ,nomIngredient )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: a chez lui
#------------------------------------------------------------

CREATE TABLE a_chez_lui(
        quantite      Float ,
        grammes       Float ,
        login         Varchar (25) NOT NULL ,
        nomIngredient Varchar (23) NOT NULL ,
        PRIMARY KEY (login ,nomIngredient )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appartient
#------------------------------------------------------------

CREATE TABLE appartient(
        nomIngredient Varchar (23) NOT NULL ,
        nomCategorie  Varchar (25) NOT NULL ,
        PRIMARY KEY (nomIngredient ,nomCategorie )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: doit acheter
#------------------------------------------------------------

CREATE TABLE doit_acheter(
        quantite      Float ,
        datePlanning  Datetime ,
        grammes       Float ,
        login         Varchar (25) NOT NULL ,
        nomIngredient Varchar (23) NOT NULL ,
        PRIMARY KEY (login ,nomIngredient )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ne suit pas
#------------------------------------------------------------

CREATE TABLE ne_suit_pas(
        nomRegime    Varchar (25) NOT NULL ,
        nomCategorie Varchar (25) NOT NULL ,
        PRIMARY KEY (nomRegime ,nomCategorie )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contient
#------------------------------------------------------------

CREATE TABLE contient(
        quantite      Float ,
        grammes       Float ,
        autoIdRecette Int NOT NULL ,
        nomIngredient Varchar (23) NOT NULL ,
        PRIMARY KEY (autoIdRecette ,nomIngredient )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: planning
#------------------------------------------------------------

CREATE TABLE planning(
        dateRealisation Date NOT NULL ,
        autoIdRecette   Int NOT NULL ,
        login           Varchar (25) NOT NULL ,
        PRIMARY KEY (autoIdRecette ,login )
)ENGINE=InnoDB;

ALTER TABLE recette ADD CONSTRAINT FK_recette_login FOREIGN KEY (login) REFERENCES Utilisateur(login);
ALTER TABLE Etape ADD CONSTRAINT FK_Etape_autoIdRecette FOREIGN KEY (autoIdRecette) REFERENCES recette(autoIdRecette);
ALTER TABLE a_chez_lui ADD CONSTRAINT FK_a_chez_lui_login FOREIGN KEY (login) REFERENCES Utilisateur(login);
ALTER TABLE a_chez_lui ADD CONSTRAINT FK_a_chez_lui_nomIngredient FOREIGN KEY (nomIngredient) REFERENCES ingredient(nomIngredient);
ALTER TABLE appartient ADD CONSTRAINT FK_appartient_nomIngredient FOREIGN KEY (nomIngredient) REFERENCES ingredient(nomIngredient);
ALTER TABLE appartient ADD CONSTRAINT FK_appartient_nomCategorie FOREIGN KEY (nomCategorie) REFERENCES categorie_ingredient(nomCategorie);
ALTER TABLE doit_acheter ADD CONSTRAINT FK_doit_acheter_login FOREIGN KEY (login) REFERENCES Utilisateur(login);
ALTER TABLE doit_acheter ADD CONSTRAINT FK_doit_acheter_nomIngredient FOREIGN KEY (nomIngredient) REFERENCES ingredient(nomIngredient);
ALTER TABLE ne_suit_pas ADD CONSTRAINT FK_ne_suit_pas_nomRegime FOREIGN KEY (nomRegime) REFERENCES regime_alimentaire(nomRegime);
ALTER TABLE ne_suit_pas ADD CONSTRAINT FK_ne_suit_pas_nomCategorie FOREIGN KEY (nomCategorie) REFERENCES categorie_ingredient(nomCategorie);
ALTER TABLE contient ADD CONSTRAINT FK_contient_autoIdRecette FOREIGN KEY (autoIdRecette) REFERENCES recette(autoIdRecette);
ALTER TABLE contient ADD CONSTRAINT FK_contient_nomIngredient FOREIGN KEY (nomIngredient) REFERENCES ingredient(nomIngredient);
ALTER TABLE planning ADD CONSTRAINT FK_planning_autoIdRecette FOREIGN KEY (autoIdRecette) REFERENCES recette(autoIdRecette);
ALTER TABLE planning ADD CONSTRAINT FK_planning_login FOREIGN KEY (login) REFERENCES Utilisateur(login);
