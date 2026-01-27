create database meadowdb;
use meadowdb;

CREATE TABLE meadowdb.users(
    id_user int AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    nickname varchar(30) NOT NULL
);

CREATE TABLE meadowdb.sessions(
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
      FOREIGN KEY (id_user) REFERENCES meadowdb.users (id_user)
      ON DELETE RESTRICT
      ON UPDATE RESTRICT
);

insert into users (email, password, nickname) VALUES ('joquinha@gmail.com', '123', 'joquinha');
insert into users (email, password, nickname) VALUES ('teste1@teste.com', 'teste', 'teste1');

insert into sessions (id_user, tag, subtag, start_time, end_time, finished, created)
VALUES ('6', 'roubar a lua', 'lançar o foguete', CURRENT_TIMESTAMP() - INTERVAL 5400 SECOND, CURRENT_TIMESTAMP(), FALSE, true);

UPDATE sessions SET end_time = CURRENT_TIMESTAMP() WHERE id_session=1;

DROP TABLE sessions;
SELECT * FROM sessions;
SELECT * FROM users;

SELECT TOP 3 * FROM sessions
ORDER BY id_session DESC;

SELECT * FROM sessions
WHERE id_user=6
ORDER BY id_session DESC
LIMIT 1;

SELECT * FROM sessions
WHERE id_user=6
AND finished = false
ORDER BY id_session DESC
LIMIT 1;