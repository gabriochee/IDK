create table avis
(
    id_work   int unsigned  not null,
    id_user   int           not null,
    statut    varchar(50)   null,
    critique  varchar(1000) null,
    note      varchar(20)   null,
    date_avis datetime      null,
    id_avis   int auto_increment primary key,
    constraint avis_pk_1
        unique (id_work, id_user)
);

create table captcha
(
    id_captcha int auto_increment
        primary key,
    question   varchar(150) null
);

create table contenu
(
    id_bloc           int auto_increment
        primary key,
    page_appartenance varchar(100)  null,
    titre             varchar(1000) null,
    corps             text          null
);

create table logs
(
    id_log     int auto_increment
        primary key,
    date_log   datetime     null,
    log_action varchar(100) null,
    adresse_ip varchar(42)  null
);

create table name_basics
(
    id_person int unsigned not null
        primary key,
    name      varchar(200) null,
    birthYear smallint     null,
    deathYear smallint     null
);

create index IX_name
    on name_basics (name);

create table name_knownForTitles
(
    id_person int unsigned null,
    id_work   int unsigned null
);

create index IX_id_person
    on name_knownForTitles (id_person);

create index IX_id_work
    on name_knownForTitles (id_work);

create table name_professions
(
    id_person  int unsigned                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           null,
    profession enum ('editorial_department', 'executive', 'production_department', 'art_director', 'camera_department', 'production_manager', 'visual_effects', 'choreographer', 'electrical_department', 'assistant_director', 'transportation_department', 'assistant', 'soundtrack', 'actor', 'editor', 'miscellaneous', 'casting_department', 'sound_department', 'manager', 'legal', 'producer', 'make_up_department', 'art_department', 'costume_designer', 'casting_director', 'costume_department', 'location_management', 'stunts', 'production_designer', 'animation_department', 'actress', 'writer', 'talent_agent', 'director', 'publicist', 'set_decorator', 'music_department', 'composer', 'cinematographer', 'special_effects', 'script_department') null
);

create index IX_id_person
    on name_professions (id_person);

create index IX_profession
    on name_professions (profession);

create table reponse_captcha
(
    id_reponse    int auto_increment
        primary key,
    contenu       varchar(150) null,
    bonne_reponse tinyint(1)   null
);

create table correspondance_captcha
(
    id_captcha int not null,
    id_reponse int not null,
    primary key (id_captcha, id_reponse),
    constraint correspondance_captcha_ibfk_1
        foreign key (id_reponse) references reponse_captcha (id_reponse),
    constraint correspondance_captcha_ibfk_2
        foreign key (id_captcha) references captcha (id_captcha),
    constraint correspondance_captcha_ibfk_3
        foreign key (id_reponse) references reponse_captcha (id_reponse),
    constraint correspondance_captcha_ibfk_4
        foreign key (id_captcha) references captcha (id_captcha),
    constraint correspondance_captcha_ibfk_5
        foreign key (id_reponse) references reponse_captcha (id_reponse),
    constraint correspondance_captcha_ibfk_6
        foreign key (id_captcha) references captcha (id_captcha),
    constraint correspondance_captcha_ibfk_7
        foreign key (id_reponse) references reponse_captcha (id_reponse),
    constraint correspondance_captcha_ibfk_8
        foreign key (id_captcha) references captcha (id_captcha)
);

create index id_reponse
    on correspondance_captcha (id_reponse);

create table utilisateur
(
    id_user            int auto_increment
        primary key,
    role_user          varchar(50)  null,
    nom                varchar(100) null,
    prenom             varchar(100) null,
    date_naissance     date         null,
    sexe               varchar(50)  null,
    pseudo             varchar(100) null,
    mail               varchar(150) null,
    mdp                char(72)     null,
    date_inscription   datetime     null,
    photo_utilisateur  varchar(300) null,
    statut_newsletter  tinyint(1)   null,
    moyenne_age_ami    float        null,
    majorite_genre_ami varchar(50)  null,
    supprime           tinyint(1)   null,
    verification_code  char(6)      null,
    telephone          varchar(15)  null,
    derniere_connexion datetime     null,
    signature          varchar(300) null,
    constraint mail
        unique (mail)
);

create table administration_captcha
(
    id_user    int not null,
    id_captcha int not null,
    primary key (id_user, id_captcha),
    constraint administration_captcha_ibfk_1
        foreign key (id_captcha) references captcha (id_captcha),
    constraint administration_captcha_ibfk_2
        foreign key (id_user) references utilisateur (id_user),
    constraint administration_captcha_ibfk_3
        foreign key (id_captcha) references captcha (id_captcha),
    constraint administration_captcha_ibfk_4
        foreign key (id_user) references utilisateur (id_user),
    constraint administration_captcha_ibfk_5
        foreign key (id_captcha) references captcha (id_captcha),
    constraint administration_captcha_ibfk_6
        foreign key (id_user) references utilisateur (id_user),
    constraint administration_captcha_ibfk_7
        foreign key (id_captcha) references captcha (id_captcha),
    constraint administration_captcha_ibfk_8
        foreign key (id_user) references utilisateur (id_user)
);

create index id_captcha
    on administration_captcha (id_captcha);

create table administration_contenu
(
    id_user          int           not null,
    id_bloc          int           not null,
    date_maj         datetime      null,
    id_maj           int auto_increment
        primary key,
    before_maj_titre varchar(1000) null,
    before_maj_corps text          null,
    after_maj_titre  varchar(1000) null,
    after_maj_corps  text          null,
    constraint administration_contenu_ibfk_1
        foreign key (id_bloc) references contenu (id_bloc),
    constraint administration_contenu_ibfk_2
        foreign key (id_user) references utilisateur (id_user)
);

create table ami
(
    id_user_1   int      not null,
    id_user_2   int      not null,
    date_amitie datetime null,
    constraint ami_ibfk_1
        foreign key (id_user_1) references utilisateur (id_user),
    constraint ami_ibfk_2
        foreign key (id_user_2) references utilisateur (id_user)
);

create index id_user_1
    on ami (id_user_1);

create index id_user_2
    on ami (id_user_2);

create table ban
(
    id_ban     int auto_increment
        primary key,
    definitif  tinyint(1)   null,
    date_ban   datetime     null,
    date_deban datetime     null,
    raison     varchar(100) null,
    id_user    int          null,
    probleme   int          null,
    constraint ban_utilisateur_id_user_fk
        foreign key (id_user) references utilisateur (id_user)
);

create index id_user
    on ban (id_user);

create table demande_admin
(
    id            int auto_increment
        primary key,
    id_admin      int          null,
    id_user       int          null,
    mail          varchar(150) null,
    date_message  datetime     null,
    titre         varchar(100) null,
    messages      text         null,
    sexe          varchar(50)  null,
    prenom        varchar(100) null,
    nom           varchar(100) null,
    telephone     varchar(15)  null,
    statut        tinyint(1)   null,
    statut_ticket varchar(30)  null,
    constraint demande_admin_ibfk_1
        foreign key (id_user) references utilisateur (id_user),
    constraint demande_admin_ibfk_2
        foreign key (id_admin) references utilisateur (id_user)
);

create index id_admin
    on demande_admin (id_admin);

create index id_user
    on demande_admin (id_user);

create table demande_ami
(
    envoyeur       int         not null,
    receveur       int         not null,
    statut_demande varchar(42) null,
    date_demande   datetime    null,
    id_demande     int auto_increment
        primary key,
    constraint demande_ami_utilisateur_id_user_fk
        foreign key (envoyeur) references utilisateur (id_user),
    constraint demande_ami_utilisateur_id_user_fk_2
        foreign key (receveur) references utilisateur (id_user)
);

create table listes
(
    id_liste      int auto_increment
        primary key,
    date_creation datetime      null,
    details       varchar(250)  null,
    statut        varchar(42)   null,
    id_user       int           not null,
    nom           varchar(300)  null,
    partages      int default 0 null,
    constraint listes_utilisateur_id_user_fk
        foreign key (id_user) references utilisateur (id_user)
);

create fulltext index `fulltext`
    on listes (nom);

create index id_user
    on listes (id_user);

create table message_demande
(
    id_message_dem  int auto_increment
        primary key,
    id_user         int          not null,
    id_admin        int          null,
    titre_demande   varchar(100) null,
    message_demande text         null,
    message         text         null,
    date_message    datetime     null,
    id_demande      int          null,
    statut_ticket   varchar(30)  null,
    envoyeur        int          null,
    receveur        int          null,
    etre_message    tinyint(1)   null,
    etre_admin      tinyint(1)   null,
    constraint message_demande_ibfk_1
        foreign key (id_admin) references utilisateur (id_user),
    constraint message_demande_ibfk_2
        foreign key (id_user) references utilisateur (id_user),
    constraint message_demande_ibfk_3
        foreign key (id_user) references utilisateur (id_user),
    constraint message_demande_utilisateur_id_user_fk
        foreign key (envoyeur) references utilisateur (id_user),
    constraint message_demande_utilisateur_id_user_fk_2
        foreign key (receveur) references utilisateur (id_user)
);

create index id_admin
    on message_demande (id_admin);

create index id_user
    on message_demande (id_user);

create table messages
(
    id              int auto_increment
        primary key,
    id_user_1       int           not null,
    id_user_2       int           not null,
    contenu_message varchar(1000) null,
    date_messsage   datetime      null,
    constraint messages_ibfk_1
        foreign key (id_user_2) references utilisateur (id_user),
    constraint messages_ibfk_2
        foreign key (id_user_1) references utilisateur (id_user)
);

create index id_user_1
    on messages (id_user_1);

create index id_user_2
    on messages (id_user_2);

create table reponses_questionnaire
(
    id_reponse       int auto_increment
        primary key,
    date             datetime      null,
    corps_question   varchar(1000) null,
    corps_reponse    varchar(1000) null,
    id_user          int           not null,
    id_questionnaire varchar(255)  not null,
    constraint reponses_questionnaire_ibfk_1
        foreign key (id_user) references utilisateur (id_user),
    constraint reponses_questionnaire_ibfk_2
        foreign key (id_user) references utilisateur (id_user),
    constraint reponses_questionnaire_ibfk_3
        foreign key (id_user) references utilisateur (id_user),
    constraint reponses_questionnaire_ibfk_4
        foreign key (id_user) references utilisateur (id_user)
);

create index id_user
    on reponses_questionnaire (id_user);

create fulltext index pseudo
    on utilisateur (pseudo);

create table work_akas
(
    id_work         int unsigned      null,
    ordering        smallint unsigned null,
    title           varchar(1000)     null,
    region          varchar(4)        null,
    language        varchar(3)        null,
    attributes      varchar(200)      null,
    isOriginalTitle tinyint           null,
    constraint UX_id_work_ordering
        unique (id_work, ordering)
);

create fulltext index `FullText`
    on work_akas (title);

create table work_basics
(
    id_work        int unsigned                                                                                                                         not null
        primary key,
    worktype       enum ('tvEpisode', 'tvMiniSeries', 'short', 'tvMovie', 'tvSeries', 'tvShort', 'video', 'videoGame', 'movie', 'tvSpecial', 'tvPilot') null,
    primaryTitle   varchar(1000)                                                                                                                        null,
    originalTitle  varchar(1000)                                                                                                                        null,
    isAdult        tinyint                                                                                                                              null,
    startYear      smallint                                                                                                                             null,
    endYear        smallint                                                                                                                             null,
    runtimeMinutes mediumint unsigned                                                                                                                   null
);

create table element_liste
(
    id_liste   int          not null,
    id_work    int unsigned not null,
    date_ajout datetime     null,
    detail     varchar(50)  null,
    primary key (id_liste, id_work),
    constraint element_liste_ibfk_1
        foreign key (id_work) references work_basics (id_work),
    constraint element_liste_ibfk_2
        foreign key (id_liste) references listes (id_liste),
    constraint element_liste_ibfk_3
        foreign key (id_work) references work_basics (id_work),
    constraint element_liste_ibfk_4
        foreign key (id_liste) references listes (id_liste),
    constraint element_liste_ibfk_5
        foreign key (id_work) references work_basics (id_work),
    constraint element_liste_ibfk_6
        foreign key (id_liste) references listes (id_liste),
    constraint element_liste_ibfk_7
        foreign key (id_work) references work_basics (id_work),
    constraint element_liste_ibfk_8
        foreign key (id_liste) references listes (id_liste)
);

create index id_work
    on element_liste (id_work);

create table recommandation
(
    id_user     int          not null,
    id_work     int unsigned not null,
    type_action varchar(50)  null,
    genre_1     varchar(100) null,
    genre_2     varchar(100) null,
    genre_3     varchar(100) null,
    annee       int          null,
    origine     varchar(3)   null,
    actor_1     varchar(100) null,
    actor_2     varchar(100) null,
    actress_1   varchar(100) null,
    actress_2   varchar(100) null,
    director_1  varchar(100) null,
    director_2  varchar(100) null,
    writer_1    varchar(100) null,
    writer_2    varchar(100) null,
    composer    varchar(100) null,
    primary key (id_user, id_work),
    constraint recommandation_ibfk_1
        foreign key (id_work) references work_basics (id_work),
    constraint recommandation_ibfk_2
        foreign key (id_user) references utilisateur (id_user),
    constraint recommandation_ibfk_3
        foreign key (id_work) references work_basics (id_work),
    constraint recommandation_ibfk_4
        foreign key (id_user) references utilisateur (id_user)
);

create index id_work
    on recommandation (id_work);

create index IX_originalTitle
    on work_basics (originalTitle(50));

create index IX_runtimeMinutes
    on work_basics (runtimeMinutes);

create index IX_startYear
    on work_basics (startYear);

create index IX_worktype
    on work_basics (worktype);

create table work_director
(
    id_work   int unsigned null,
    id_person int unsigned null
);

create index IX_id_person
    on work_director (id_person);

create index IX_id_work
    on work_director (id_work);

create table work_genres
(
    id_work int unsigned                                                                                                                                                                                                                                                                                                          null,
    genre   enum ('Romance', 'Talk-Show', 'Drama', 'Fantasy', 'Action', 'Sci-Fi', 'Animation', 'Thriller', 'Comedy', 'Documentary', 'Reality-TV', 'Adventure', 'Mystery', 'Film-Noir', 'Game-Show', 'Horror', 'Music', 'Family', 'Adult', 'Sport', 'War', 'Biography', 'History', 'Crime', 'News', 'Western', 'Musical', 'Short') null
);

create index IX_genre
    on work_genres (genre);

create index IX_id_work
    on work_genres (id_work);

create table work_principals
(
    id_work    int unsigned                                                                                                                                                            null,
    ordering   tinyint unsigned                                                                                                                                                        null,
    id_person  int unsigned                                                                                                                                                            null,
    category   enum ('archive_sound', 'editor', 'director', 'producer', 'self', 'production_designer', 'actress', 'cinematographer', 'actor', 'writer', 'archive_footage', 'composer') null,
    job        varchar(500)                                                                                                                                                            null,
    characters varchar(1400)                                                                                                                                                           null,
    constraint UX_id_work_ordering
        unique (id_work, ordering)
);

create index IX_id_person
    on work_principals (id_person);

create table work_ratings
(
    id_work       int unsigned  not null
        primary key,
    averageRating decimal(3, 1) null,
    numVotes      int unsigned  null
);

create table work_types
(
    id_work  int unsigned                                                                                 null,
    ordering smallint unsigned                                                                            null,
    type     enum ('alternative', 'dvd', 'festival', 'tv', 'video', 'working', 'original', 'imdbDisplay') null
);

create index IX_id_work_ordering
    on work_types (id_work, ordering);

create table work_writer
(
    id_work   int unsigned null,
    id_person int unsigned null
);

create index IX_id_person
    on work_writer (id_person);

create index IX_id_work
    on work_writer (id_work);


