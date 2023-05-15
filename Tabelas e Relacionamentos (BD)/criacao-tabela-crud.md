# Comandos SQL para CRUD - Referência

## INSERT

### Tabela cursos
```sql
INSERT INTO categorias (descCategoria) 
VALUES(
    'Ouro',
    0
),
(
    'Prata',
    0
),
(
    'Bronze',
    0
);

INSERT INTO niveis (codNivel, descNivel) 
VALUES(
    1,
    'Adminstrador',
    0
),
(
    3,
    'Instrutor',
    0
),
(
    5,
    'Usuário',
    0
);

INSERT INTO modalidades (codModalidade, descModalidade) 
VALUES(
    10,
    'Informática',
    0
),
(
    20,
    'Mecânica',
    0
),
(
    30,
    'Culinária',
    0
);

INSERT INTO genericos (tipoFavorecido, cnpjcpf, nome, email, telefone, cep, endereco, numero, complemento, bairro, cidade, uf, codMunicipio) 
VALUES(
    2,
    "12667181840",
    "MarcelloSA",
    "marcello@hotmail.com",
    "999998877",
    "01038-100",
    "rua Francisco Coimbra",
    "403",
    "metrô penha",
    "Penha",
    "São Paulo",
    "SP",
    3550508,
    ""
);

INSERT INTO ctrAcessos(indicador, senha, generico_id, nivel_id)
VALUES(
    0,
    "123",
    1,
    1
);


INSERT INTO instrutores (limiteCurso, categoria_id, ctrAcesso_id) 
VALUES (
    99,
    0,
    1,
    1
);

INSERT INTO cursos (descCurso, complemento, indicador, caminho, modalidade_id, instrutor_id) 
VALUES(
    "HTML5 e CSS3",
    "Front-end",
    0,
    "imagem1.jpg",
    1,
    1
);
