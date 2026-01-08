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
    subtag varchar(255),
    start_time datetime,
    end_time datetime,
    duration_seconds int AS (TIMESTAMPDIFF(SECOND, start_time, end_time)) STORED,
    finished boolean NOT NULL DEFAULT FALSE,
    created boolean NOT NULL DEFAULT FALSE,
    CONSTRAINT fk_id_user
      FOREIGN KEY (id_user) REFERENCES meadowdb1.users (id_user)
      ON DELETE RESTRICT
      ON UPDATE RESTRICT
);

insert into users (email, password, nickname) VALUES ('joquinha@gmail.com', '123', 'joquinha');
insert into users (email, password, nickname) VALUES ('teste1@teste.com', 'teste', 'teste1');

insert into sessions (id_user, tag, subtag, start_time, end_time, finished)
VALUES (1, "roubar a lua", "preparações", CURRENT_TIMESTAMP() - INTERVAL 5400 SECOND, CURRENT_TIMESTAMP(), true);

UPDATE sessions SET end_time = CURRENT_TIMESTAMP() WHERE id_session=1;

DROP TABLE sessions;
SELECT * FROM sessions;