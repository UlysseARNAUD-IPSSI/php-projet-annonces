DROP TABLE IF EXISTS annonces;

CREATE TABLE annonces
(
    id          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    title       VARCHAR(191)     NOT NULL,
    description TEXT(1028)       NOT NULL,
    price       FLOAT            NOT NULL DEFAULT 0,
    /*photo1       BLOB            DEFAULT NULL,
    photo2       BLOB            DEFAULT NULL,
    photo3       BLOB            DEFAULT NULL,*/
    ends_at     TIMESTAMP        NOT NULL,
    /* user_id     INT(10)          UNSIGNED DEFAULT NULL,*/
    created_at  TIMESTAMP        NOT NULL DEFAULT NOW(),
    updated_at  TIMESTAMP        NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    PRIMARY KEY (id)
    /*CONSTRAINT FOREIGN KEY fk_annonces_annonce_user (user_id) REFERENCES users (id)*/
);