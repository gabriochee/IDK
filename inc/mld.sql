CREATE TABLE ban (
  PRIMARY KEY (id_ban),
  id_ban                INTEGER NOT NULL,
  definitif             BOOLEAN,
  date_ban              DATETIME,
  date_deban            DATETIME,
  raison                VARCHAR(100),
  id_user               INTEGER
);

CREATE TABLE captcha (
  PRIMARY KEY (id_captcha),
  id_captcha            INTEGER NOT NULL,
  question              VARCHAR(150)
);

CREATE TABLE administration_captcha (
  PRIMARY KEY (id_user, id_captcha),
  id_user               INTEGER NOT NULL,
  id_captcha            INTEGER NOT NULL
);

CREATE TABLE correspondance_captcha (
  PRIMARY KEY (id_captcha, id_reponse),
  id_captcha            INTEGER NOT NULL,
  id_reponse            INTEGER NOT NULL
);

CREATE TABLE contenu (
  PRIMARY KEY (id_bloc),
  id_bloc               INTEGER NOT NULL,
  page_appartenance     VARCHAR(100),
  titre                 VARCHAR(100),
  corps                 VARCHAR(1000),
  date_maj              DATETIME,
  last_titre            VARCHAR(100),
  last_corps            VARCHAR(1000),
  last_date_amj         DATETIME
);

CREATE TABLE administration_contenu (
  PRIMARY KEY (id_user, id_bloc),
  id_user               INTEGER NOT NULL,
  id_bloc               INTEGER NOT NULL,
  date_maj              DATETIME
);

CREATE TABLE demande_ami (
  PRIMARY KEY (id_user_1, id_user_2),
  id_user_1             INTEGER NOT NULL,
  id_user_2             INTEGER NOT NULL,
  statut_demande        VARCHAR(42),
  date_demande          DATETIME
);

CREATE TABLE messages (
  PRIMARY KEY (id_user_1, id_user_2),
  id_user_1             INTEGER NOT NULL,
  id_user_2             INTEGER NOT NULL,
  contenu_message       VARCHAR(1000),
  date_messsage         DATETIME
);

CREATE TABLE listes (
  PRIMARY KEY (id_liste),
  id_liste              INTEGER NOT NULL,
  date_creation         DATETIME,
  commentaire           VARCHAR(250),
  statut                VARCHAR(42),
  id_user               INTEGER NOT NULL
);

CREATE TABLE elements_listes (
  PRIMARY KEY (id_liste, id_work),
  id_liste              INTEGER NOT NULL,
  id_work               INTEGER UNSIGNED,
  date_ajout            DATETIME
);

CREATE TABLE logs (
  PRIMARY KEY (id_log),
  id_log                INTEGER NOT NULL,
  date_log              DATETIME,
  actions	              VARCHAR(42),
  adresse_ip            VARCHAR(42)
);

CREATE TABLE consultation_logs (
  PRIMARY KEY (id_user, id_log),
  id_user               INTEGER NOT NULL,
  id_log                INTEGER NOT NULL
);

CREATE TABLE recommandations (
  PRIMARY KEY (id_user, id_work),
  id_user               INTEGER NOT NULL,
  id_work               INTEGER UNSIGNED,
  type_action			      VARCHAR(50),
  genre_1               VARCHAR(100),
  genre_2               VARCHAR(100),
  genre_3               VARCHAR(100),
  annee                 INTEGER,
  origine               VARCHAR(3),
  actor_1               VARCHAR(100),
  actor_2               VARCHAR(100),
  actress_1             VARCHAR(100),
  actress_2             VARCHAR(100),
  director_1            VARCHAR(100),
  director_2            VARCHAR(100),
  writer_1              VARCHAR(100),
  writer_2              VARCHAR(100),
  composer              VARCHAR(100)
);

CREATE TABLE reponses_questionnaire (
  PRIMARY KEY (id_reponse),
  id_reponse            INTEGER NOT NULL,
  date_reponse          DATETIME,
  corps_question        VARCHAR(1000),
  corps_reponse         VARCHAR(1000),
  id_user               INTEGER NOT NULL
);

CREATE TABLE reponses_captcha (
  PRIMARY KEY (id_reponse),
  id_reponse            INTEGER NOT NULL,
  contenu               VARCHAR(150),
  bonne_reponse         BOOLEAN
);

CREATE TABLE utilisateur (
  PRIMARY KEY (id_user),
  id_user               INTEGER NOT NULL,
  role_user             VARCHAR(50),
  nom                   VARCHAR(100),
  prenom                VARCHAR(100),
  date_naissance        DATE,
  genre                 VARCHAR(50),
  pseudo                VARCHAR(100),
  mail                  VARCHAR(150),
  mdp                   CHAR(72),
  date_inscription      DATETIME,
  photo_utilisateur     VARCHAR(300),
  statut_newsletter     BOOLEAN,
  moyenne_age_ami       FLOAT,
  majorite_genre_ami    VARCHAR(50),
  supprime              BOOLEAN
);

CREATE TABLE avis (
  PRIMARY KEY (id_work, id_user),
  id_work               INTEGER UNSIGNED,
  id_user               INTEGER NOT NULL,
  statut                BOOLEAN,
  critique              VARCHAR(1000),
  note                  INTEGER,
  date_avis             DATETIME
);

ALTER TABLE ban ADD FOREIGN KEY (id_user) REFERENCES utilisateur (id_user);

ALTER TABLE administration_captcha ADD FOREIGN KEY (id_captcha) REFERENCES captcha (id_captcha);
ALTER TABLE administration_captcha ADD FOREIGN KEY (id_user) REFERENCES utilisateur (id_user);

ALTER TABLE correspondance_captcha ADD FOREIGN KEY (id_reponse) REFERENCES reponses_captcha (id_reponse);
ALTER TABLE correspondance_captcha ADD FOREIGN KEY (id_captcha) REFERENCES captcha (id_captcha);

ALTER TABLE demande_ami ADD FOREIGN KEY (id_user_2) REFERENCES utilisateur (id_user);
ALTER TABLE demande_ami ADD FOREIGN KEY (id_user_1) REFERENCES utilisateur (id_user);

ALTER TABLE elements_listes ADD FOREIGN KEY (id_work) REFERENCES work_basics (id_work);
ALTER TABLE elements_listes ADD FOREIGN KEY (id_liste) REFERENCES listes (id_liste);

ALTER TABLE messages ADD FOREIGN KEY (id_user_2) REFERENCES utilisateur (id_user);
ALTER TABLE messages ADD FOREIGN KEY (id_user_1) REFERENCES utilisateur (id_user);

ALTER TABLE listes ADD FOREIGN KEY (id_user) REFERENCES utilisateur (id_user);

ALTER TABLE consultation_logs ADD FOREIGN KEY (id_log) REFERENCES logs (id_log);
ALTER TABLE consultation_logs ADD FOREIGN KEY (id_user) REFERENCES utilisateur (id_user);

ALTER TABLE administration_contenu ADD FOREIGN KEY (id_bloc) REFERENCES contenu (id_bloc);
ALTER TABLE administration_contenu ADD FOREIGN KEY (id_user) REFERENCES utilisateur (id_user);

ALTER TABLE recommandations ADD FOREIGN KEY (id_work) REFERENCES work_basics (id_work);
ALTER TABLE recommandations ADD FOREIGN KEY (id_user) REFERENCES utilisateur (id_user);

ALTER TABLE reponses_questionnaire ADD FOREIGN KEY (id_user) REFERENCES utilisateur (id_user);

ALTER TABLE avis ADD FOREIGN KEY (id_work) REFERENCES work_basics (id_work);
ALTER TABLE avis ADD FOREIGN KEY (id_user) REFERENCES utilisateur (id_user);