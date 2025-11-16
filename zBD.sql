create database camping_mvc_auth;
 use camping_mvc_auth;
 
 CREATE TABLE privilege (
    id INT AUTO_INCREMENT PRIMARY KEY,
    privilege VARCHAR(50) NOT NULL
);
 
  CREATE TABLE collaborateur(
 id INT NOT NULL AUTO_INCREMENT,
 nom VARCHAR(45) NOT NULL,
 prenom VARCHAR(45) NOT NULL,
 adresse VARCHAR(45) NOT NULL,
 codePostal VARCHAR(10) NOT NULL,
 telephone VARCHAR(20),
 courriel VARCHAR(45) NOT NULL,
 motDePasse VARCHAR(255) NOT NULL,
 matricule VARCHAR(50) NOT NULL,
 privilegeId INT NOT NULL,
 CONSTRAINT pk_id PRIMARY KEY (id),
 CONSTRAINT fk_privilege_id FOREIGN KEY (privilegeId) REFERENCES privilege(id),
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 
 CREATE TABLE client(
 id INT NOT NULL AUTO_INCREMENT,
 nom VARCHAR(45) NOT NULL,
 prenom VARCHAR(45) NOT NULL,
 adresse VARCHAR(45) NOT NULL,
 codePostal VARCHAR(10) NOT NULL,
 telephone VARCHAR(20),
 courriel VARCHAR(45) NOT NULL,
 motDePasse VARCHAR(255) NOT NULL,
 CONSTRAINT pk_id PRIMARY KEY (id)
);
 
 CREATE TABLE categorie(
 id INT NOT NULL AUTO_INCREMENT,
 categorieNom VARCHAR (45) NOT NULL,
 CONSTRAINT pk_id PRIMARY KEY (id)
 );
 
CREATE TABLE site(
 id INT NOT NULL AUTO_INCREMENT,
 siteNom text,
 siteDescription text,
 capacite INT,
 prix double NOT NULL,
 urlImage text,
 categorieId int NOT NULL,
 collaborateurId int NOT NULL,
 dateCreation DATE NOT NULL DEFAULT (CURRENT_DATE), 
 CONSTRAINT pk_id PRIMARY KEY (id),
 CONSTRAINT fk_categorieId FOREIGN KEY (categorieId) REFERENCES 
 categorie (id),
 CONSTRAINT fk_collaborateurId FOREIGN KEY (collaborateurId) REFERENCES 
 collaborateur (id)
 );
  
CREATE TABLE statut(
 id INT NOT NULL AUTO_INCREMENT,
 statutDescription VARCHAR (45) NOT NULL,
 CONSTRAINT pk_id PRIMARY KEY (id)
 );

CREATE TABLE reservation(
 id INT NOT NULL AUTO_INCREMENT,
 dateReservation DATE NOT NULL DEFAULT (CURRENT_DATE), 
 dateArrivee DATE NOT NULL,
 dateDepart DATE NOT NULL,
 nbrDePersonnes INT NOT NULL,
 clientId INT NOT NULL,
 siteId INT NOT NULL,
 statutId INT NOT NULL DEFAULT 1,
 CONSTRAINT pk_id PRIMARY KEY (id),
 CONSTRAINT fk_clientId FOREIGN KEY (clientId) REFERENCES 
 client (id),
 CONSTRAINT fk_siteId FOREIGN KEY (siteId) REFERENCES 
 site (id),
  CONSTRAINT fk_statutId FOREIGN KEY (statutId) REFERENCES 
 statut (id)
);

INSERT INTO privilege (privilege) VALUES ('Admin');
INSERT INTO privilege (privilege) VALUES ('Manager');
INSERT INTO privilege (privilege) VALUES('Employee');

INSERT INTO statut (statutDescription)
VALUES 
("Confirmée"),
("En attente"),
("En cours"),
("Annulée"),
("Terminée");

INSERT INTO categorie (categorieNom)
VALUES 
("Chalet"),
("Yourte"),
("Emplacement de camping"),
("Prêt-à-camper");


INSERT INTO collaborateur
(nom, prenom, adresse, codePostal, telephone, courriel, motDePasse, matricule, privilegeId)
VALUES
('Dupont', 'Jean', '123 Rue Principale', 'H2X1A4', '5141234567', 'admin@admin.com', '$2b$10$YbTk5MC5.sqmNosPMPz/F.jMhx/iVKkv2hhGJkEtpryPO7gEo3cUK', '123', 1),
('Leroy', 'Sophie', '45 Avenue des Fleurs', 'H3Z2B7', '4389876543', 'manager@manager.com', '$2b$10$YbTk5MC5.sqmNosPMPz/F.jMhx/iVKkv2hhGJkEtpryPO7gEo3cUK', '123', 2),
('Martin', 'Karim', '87 Boulevard Saint-Laurent', 'H1C3D2', '5147451289', 'employe@employe.com', '$2b$10$YbTk5MC5.sqmNosPMPz/F.jMhx/iVKkv2hhGJkEtpryPO7gEo3cUK!', '123', 3);

INSERT INTO site (siteNom, siteDescription, capacite, prix, urlImage, categorieId, collaborateurId) VALUES
('Chalet du Lac', 'Chalet rustique au bord du lac, idéal pour les familles.', 6, 180.00, 'img/chalets/chalet1.jpeg', 1, 1),
('Chalet Montagne', 'Chalet chaleureux avec vue sur la montagne.', 5, 160.00, 'img/chalets/chalet2.jpeg', 1, 1),
('Chalet Érable', 'Chalet moderne entouré d’érables, parfait pour un séjour tranquille.', 4, 150.00, 'img/chalets/chalet3.jpeg', 1, 1),
('Chalet Nordik', 'Chalet scandinave avec spa privé.', 8, 220.00, 'img/chalets/chalet4.jpeg', 1, 1),
('Yourte Sauvage', 'Yourte traditionnelle dans un cadre naturel.', 4, 120.00, 'img/yourtes/yourte1.jpg', 2, 1),
('Yourte du Soleil', 'Yourte lumineuse et confortable pour deux personnes.', 2, 100.00, 'img/yourtes/yourte2.jpg', 2, 1),
('Yourte des Pins', 'Yourte spacieuse entourée de pins.', 5, 130.00, 'img/yourtes/yourte3.jpg', 2, 1),
('Yourte Familiale', 'Yourte avec coin cuisine et chauffage au bois.', 6, 140.00, 'img/yourtes/yourte4.jpg', 2, 1),
('Emplacement Rivière', 'Terrain plat près de la rivière.', 6, 45.00, 'img/camping/camp1.jpg', 3, 1),
('Emplacement Forêt', 'Emplacement ombragé dans la forêt.', 4, 40.00, 'img/camping/camp2.jpg', 3, 1),
('Emplacement Vue Montagne', 'Emplacement dégagé avec vue sur la montagne.', 6, 50.00, 'img/camping/camp3.jpg', 3, 1),
('Emplacement Prairie', 'Emplacement vaste et ensoleillé.', 8, 55.00, 'img/camping/camp4.jpg', 3, 1),
('Tente Safari', 'Grande tente prête à camper avec lits et terrasse.', 4, 90.00, 'img/pret-a-camper/pac1.jpg', 4, 1),
('Cabane du Bois', 'Petite cabane confortable, idéale pour deux.', 2, 85.00, 'img/pret-a-camper/pac2.jpg', 4, 1),
('Mini-Chalet Zen', 'Petit chalet minimaliste tout équipé.', 3, 95.00, 'img/pret-a-camper/pac3.jpeg', 4, 1),
('Pod Nature', 'Pod écologique au cœur de la nature.', 2, 100.00, 'img/pret-a-camper/pac4.jpeg', 4, 1);

INSERT INTO client (nom, prenom, adresse, codePostal, telephone, courriel, motDePasse)
VALUES
('Charpentier', 'Julien', '12 rue du Lac Bleu Montreal', 'G1A 2B3', '5141234567', 'julien@gmail.com', '123'),
('Robert', 'Yanis', '45 avenue des Pins Laval', 'H3A 1K2', '4382345678', 'yanis@gmail.com', '123'),
('Antoine', 'Marc', '78 chemin du Bois Laval', 'J2K 3L4', '4183456789', 'marc@gmail.com', '123'),
('Gagnon', 'Dominique', '23 boulevard des Laurentides Montreal', 'H4N 2P5', '5144567890', 'dominique@gmail.com', '123'),
('Dubois', 'Amélie', '9 rue de la Montagne Montreal', 'J1C 5M6', '4505678901', 'amelie@gmail.com', '123');

INSERT INTO reservation (dateArrivee, dateDepart, nbrDePersonnes, clientId, siteId, statutId)
VALUES
('2025-06-10','2025-06-15',4,1,1,1),
('2025-07-01','2025-07-05',2,1,5,2),
('2025-08-12','2025-08-18',6,1,9,1),
('2025-06-20','2025-06-25',3,2,2,1),
('2025-07-10','2025-07-15',2,2,6,3),
('2025-08-05','2025-08-10',4,2,10,2),
('2025-06-15','2025-06-20',5,3,3,1),
('2025-07-20','2025-07-25',2,3,7,1),
('2025-08-15','2025-08-20',3,3,11,3),
('2025-06-12','2025-06-16',2,4,4,2),
('2025-07-05','2025-07-09',3,4,8,1),
('2025-08-18','2025-08-23',6,4,12,1),
('2025-06-18','2025-06-22',4,5,13,1),
('2025-07-08','2025-07-12',2,5,14,2),
('2025-08-10','2025-08-15',3,5,15,3);

-- select * from site where id not in (select siteId from reservation)
select * from reservation order by siteId
select * from site


