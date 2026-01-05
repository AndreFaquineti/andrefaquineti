CREATE TABLE tabela_usuarios (
    email varchar(255) PRIMARY KEY,
    tipo varchar(30) NOT NULL
);
INSERT tabela_usuarios (email, tipo)
VALUES
('medico@teste1', 'medico'),
('medico@teste2', 'medico'),
('paciente@teste1', 'paciente'),
('paciente@teste2', 'paciente'),
('administrador@teste1', 'administrador'),
('administrador@teste2', 'administrador');