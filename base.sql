CREATE DATABASE 4159_4274_operateurs
USE 4159_4274_operateurs

CREATE TABLE prefixe (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefixe TEXT NOT NULL UNIQUE
);

CREATE TABLE client (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    numero TEXT NOT NULL UNIQUE,
    solde INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE type_operation (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE
);

CREATE TABLE bareme_frais (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type_operation_id INTEGER NOT NULL,
    montant_min INTEGER NOT NULL,
    montant_max INTEGER NOT NULL,
    frais INTEGER NOT NULL,

    FOREIGN KEY (type_operation_id) REFERENCES type_operation(id)
);

CREATE TABLE historique (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER NOT NULL,
    type_operation_id INTEGER NOT NULL,
    destinataire_id INTEGER,
    montant INTEGER NOT NULL,
    frais INTEGER NOT NULL DEFAULT 0,
    date_operation DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (client_id) REFERENCES client(id),
    FOREIGN KEY (type_operation_id) REFERENCES type_operation(id),
    FOREIGN KEY (destinataire_id) REFERENCES client(id)
);


INSERT INTO prefixe (prefixe) VALUES
('034'),
('038');

INSERT INTO type_operation (nom) VALUES
('DEPOT'),
('RETRAIT'),
('TRANSFERT');


INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais)
VALUES
(2,100,1000,50),
(2,1001,5000,100),
(2,5001,10000,200),
(2,10001,25000,400),
(2,25001,50000,800),
(2,50001,250000,1500),
(2,250001,500000,2500),
(2,500001,1000000,1500),
(2,1000001,2000000,3000);


INSERT INTO bareme_frais
(type_operation_id, montant_min, montant_max, frais)
VALUES
(3,100,1000,50),
(3,1001,5000,100),
(3,5001,10000,200),
(3,10001,25000,400),
(3,25001,50000,800),
(3,50001,250000,1500),
(3,250001,500000,2500),
(3,500001,1000000,1500),
(3,1000001,2000000,3000);