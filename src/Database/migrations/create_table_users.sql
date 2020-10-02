DROP TABLE IF EXISTS users;

CREATE TABLE users
(
    id             INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    pseudo         VARCHAR(191)     NOT NULL,
    phone          VARCHAR(191)     NOT NULL,
    /*avatar         BLOB                      DEFAULT NULL,*/
    email          VARCHAR(255)     NOT NULL,
    password       VARCHAR(255)     NOT NULL,
    token_remember VARCHAR(255)              DEFAULT NULL,
    token_session  VARCHAR(255)              DEFAULT NULL,
    token_api      VARCHAR(255)              DEFAULT NULL,
    created_at     TIMESTAMP        NOT NULL DEFAULT NOW(),
    updated_at     TIMESTAMP        NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    PRIMARY KEY (id),
    UNIQUE KEY users_pseudo_unique (pseudo),
    UNIQUE KEY users_email_unique (email)
);