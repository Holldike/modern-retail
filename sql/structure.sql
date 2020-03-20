CREATE TABLE IF NOT EXISTS user
(
    user_id    INT(11) PRIMARY KEY AUTO_INCREMENT,
    firstname  VARCHAR(255) NOT NULL,
    lastname   VARCHAR(255) NOT NULL,
    email      VARCHAR(255) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    user_type  VARCHAR(255) NOT NULL,
    created_at DATETIME     NOT NULL
);

CREATE TABLE IF NOT EXISTS address
(
    address_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    user_id    INT(11)      NOT NULL,
    city       VARCHAR(255) NOT NULL,
    postcode   VARCHAR(255) NOT NULL,
    region     VARCHAR(255) NOT NULL,
    street     VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (user_id)
);