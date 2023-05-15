# Criando Tabelas

## Criando DataBase
```sql
CREATE DATABASE bd_alvo CHARACTER SET utf8mb4;
USE DATABASE bd_alvo;
```

### Criar Tabelas
```sql
CREATE TABLE categorias(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    descCategoria VARCHAR(50) NOT NULL,
    indicador INT NULL
);

CREATE TABLE niveis(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    codNivel INT NOT NULL,
    descNivel VARCHAR(50) NOT NULL,
    indicador INT NULL
);

CREATE TABLE modalidades(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    codModalidade INT NOT NULL,
    descModalidade VARCHAR(100) NOT NULL,
    indicador INT NULL
);

CREATE TABLE genericos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipoFavorecido INT NOT NULL,
    cnpjcpf VARCHAR(30) NOT NULL UNIQUE,
    nome VARCHAR(60) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20) NULL,
    cep VARCHAR(9) NULL,
    endereco VARCHAR(60) NULL,
    numero VARCHAR(20) NULL,
    complemento VARCHAR(100) NULL,
    bairro VARCHAR(60) NULL,
    cidade VARCHAR(60) NULL,
    uf VARCHAR(2) NULL,
    codMunicipio VARCHAR(7) NULL,
    ctrAcesso_id INT NULL
);

CREATE TABLE ctrAcessos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    indicador INT NOT NULL,
    senha VARCHAR(255) NOT NULL,
    generico_id INT NOT NULL,
    nivel_id INT NOT NULL
);

CREATE TABLE instrutores(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    limiteCurso INT NOT NULL,
    indicador INT NULL,
    categoria_id INT NOT NULL,
    ctrAcesso_id INT NOT NULL
);

CREATE TABLE cursos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nomeCurso VARCHAR(200) NOT NULL,
    descCurso VARCHAR(200) NOT NULL,
    indicador INT NULL,
    imagem VARCHAR(200) NULL,
    modalidade_id INT NOT NULL,
    instrutor_id INT NOT NULL
);

CREATE TABLE videos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nomeVideo VARCHAR(150) NOT NULL,
    link VARCHAR(100) NOT NULL,
    descricao VARCHAR(200) NULL,
    curso_id INT NOT NULL
);

CREATE TABLE alunos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    indicador INT NULL,
    curso_id INT  NULL,
    ctrAcesso_id INT NOT NULL
);

CREATE TABLE controleCursos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    descCtrCurso VARCHAR(100) NOT NULL,
    aluno_id INT NOT NULL
);



```

### Criação da Chave Estrangeira (FK - relacionamento entre as tabelas)

```sql
ALTER TABLE ctrAcessos
    ADD CONSTRAINT fk_ctrAcessos_genericos
    FOREIGN KEY(generico_id) REFERENCES genericos(id);

ALTER TABLE ctrAcessos
    ADD CONSTRAINT fk_ctrAcessos_niveis
    FOREIGN KEY(nivel_id) REFERENCES niveis(id);


ALTER TABLE instrutores
    ADD CONSTRAINT fk_instrutores_categorias
    FOREIGN KEY(categoria_id) REFERENCES categorias(id);

ALTER TABLE instrutores
    ADD CONSTRAINT fk_instrutores_ctrAcessos
    FOREIGN KEY(ctrAcesso_id) REFERENCES ctrAcessos(id);


ALTER TABLE cursos
    ADD CONSTRAINT fk_cursos_modalidades
    FOREIGN KEY(modalidade_id) REFERENCES modalidades(id);

ALTER TABLE cursos
    ADD CONSTRAINT fk_cursos_instrutores
    FOREIGN KEY(instrutor_id) REFERENCES instrutores(id);
    
ALTER TABLE videos
    ADD CONSTRAINT fk_videos_cursos
    FOREIGN KEY(curso_id) REFERENCES cursos(id);
    

ALTER TABLE alunos
    ADD CONSTRAINT fk_alunos_ctrAcessos
    FOREIGN KEY(ctrAcesso_id) REFERENCES ctrAcessos(id);

ALTER TABLE alunos
    ADD CONSTRAINT fk_alunos_cursos
    FOREIGN KEY(curso_id) REFERENCES cursos(id);


ALTER TABLE controleCursos
    ADD CONSTRAINT fk_controleCursos_alunos
    FOREIGN KEY(aluno_id) REFERENCES alunos(id);



```