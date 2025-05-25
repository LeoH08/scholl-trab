CREATE TABLE
    IF NOT EXISTS cursos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        descricao TEXT NOT NULL,
        duracao VARCHAR(100) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS materias (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        descricao TEXT NOT NULL,
        curso_id INT NOT NULL,
        FOREIGN KEY (curso_id) REFERENCES cursos (id)
    );

CREATE TABLE
    IF NOT EXISTS usuario (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        senha VARCHAR(100) NOT NULL,
        tipo VARCHAR(20) NOT NULL CHECK (tipo IN ('aluno', 'professor', 'admin'))
    );

CREATE TABLE
    IF NOT EXISTS professores (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        masp VARCHAR(100) NOT NULL UNIQUE,
        endereco VARCHAR(100) NOT NULL,
        materias_id INT,
        usuario_id INT,
        curso_id INT,
        FOREIGN KEY (materias_id) REFERENCES materias (id),
        FOREIGN KEY (usuario_id) REFERENCES usuario (id),
        FOREIGN KEY (curso_id) REFERENCES cursos (id)
    );

CREATE TABLE
    IF NOT EXISTS alunos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        curso_id INT NOT NULL,
        usuario_id INT,
        materias_id INT,
        matricula VARCHAR(100) NOT NULL UNIQUE,
        nome VARCHAR(100) NOT NULL,
        FOREIGN KEY (curso_id) REFERENCES cursos (id),
        FOREIGN KEY (usuario_id) REFERENCES usuario (id),
        FOREIGN KEY (materias_id) REFERENCES materias (id)
    );

CREATE TABLE
    IF NOT EXISTS matricula (
        id INT AUTO_INCREMENT PRIMARY KEY,
        curso_id INT NOT NULL,
        aluno_id INT NOT NULL,
        FOREIGN KEY (curso_id) REFERENCES cursos (id),
        FOREIGN KEY (aluno_id) REFERENCES alunos (id)
    );

CREATE TABLE
    IF NOT EXISTS turmas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        curso_id INT NOT NULL,
        professor_id INT NOT NULL,
        horario VARCHAR(100) NOT NULL,
        FOREIGN KEY (curso_id) REFERENCES cursos (id),
        FOREIGN KEY (professor_id) REFERENCES professores (id)
    );

CREATE TABLE
    IF NOT EXISTS notas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        aluno_id INT NOT NULL,
        curso_id INT NOT NULL,
        nota DECIMAL(5, 2) NOT NULL,
        FOREIGN KEY (aluno_id) REFERENCES alunos (id),
        FOREIGN KEY (curso_id) REFERENCES cursos (id)
    );

INSERT INTO
    cursos (nome, descricao, duracao)
VALUES
    (
        'Informática',
        'Curso técnico em Informática',
        '2 anos'
    ),
    (
        'Administração',
        'Curso técnico em Administração',
        '2 anos'
    ),
    (
        'Enfermagem',
        'Curso técnico em Enfermagem',
        '3 anos'
    );

INSERT INTO
    materias (nome, descricao, curso_id)
VALUES
    (
        'Lógica de Programação',
        'Aprender lógica básica',
        1
    ),
    ('Banco de Dados', 'Modelagem e SQL', 1),
    (
        'Gestão Empresarial',
        'Fundamentos de administração',
        2
    ),
    ('Anatomia', 'Estudo do corpo humano', 3);

INSERT INTO
    usuario (username, email, senha, tipo)
VALUES
    (
        'joao_aluno',
        'joao@example.com',
        'senha123',
        'aluno'
    ),
    (
        'maria_prof',
        'maria@example.com',
        'senha123',
        'professor'
    ),
    (
        'admin1',
        'admin@example.com',
        'admin123',
        'admin'
    ),
    (
        'ana_aluna',
        'ana@example.com',
        'senha456',
        'aluno'
    ),
    (
        'carlos_prof',
        'carlos@example.com',
        'senha456',
        'professor'
    );

INSERT INTO
    professores (
        nome,
        masp,
        endereco,
        materias_id,
        usuario_id,
        curso_id
    )
VALUES
    ('Maria Silva', '123456', 'Rua A, 100', 1, 2, 1),
    ('Carlos Souza', '654321', 'Rua B, 200', 3, 5, 2);

INSERT INTO
    alunos (
        curso_id,
        usuario_id,
        materias_id,
        matricula,
        nome
    )
VALUES
    (1, 1, 1, '20240001', 'João Oliveira'),
    (1, 4, 2, '20240002', 'Ana Costa');

INSERT INTO
    matricula (curso_id, aluno_id)
VALUES
    (1, 1),
    (1, 2);

INSERT INTO
    turmas (curso_id, professor_id, horario)
VALUES
    (1, 1, '08:00 - 10:00'),
    (2, 2, '10:00 - 12:00');

INSERT INTO
    notas (aluno_id, curso_id, nota)
VALUES
    (1, 1, 8.5),
    (2, 1, 9.0);