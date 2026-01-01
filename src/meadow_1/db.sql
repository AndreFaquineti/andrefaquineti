create database meadowdb1;
use meadowdb1;

CREATE TABLE meadowdb1.users(
    id_user int AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    nickname varchar(50) NULL
);

CREATE TABLE meadowdb1.sessions(
    id_session int AUTO_INCREMENT PRIMARY KEY,
    id_user int,
    tag varchar(255),
    start_time datetime,
    end_time datetime,
    duration_seconds int,
    finished boolean NOT NULL DEFAULT FALSE,
    CONSTRAINT fk_id_user
      FOREIGN KEY (id_user) REFERENCES meadowdb1.users (id_user)
      ON DELETE RESTRICT
      ON UPDATE RESTRICT
);

insert into users (email, password, nickname) VALUES ('joquinha@gmail.com', 123, 'joquinha');
insert into sessions (id_user, tag, start_time, end_time, duration_seconds, finished)
VALUES (1, "não sei", "2025-12-31 13:08:22", CURRENT_TIMESTAMP(), TIMESTAMPDIFF(SECOND, "2025-12-31 13:08:22", CURRENT_TIMESTAMP()), true);