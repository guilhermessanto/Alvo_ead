# Adminstração Tabelas (BD):

## 1) Genérico (Adminstrador/Instrutor).
1.1) Cadastro Favorecidos:
	- Primeiro passo para input do cadastro;
		- feito pelo Adm quando cadastrar instrutor.
		- feito pelo Instrutor no cadastro dos alunos.


## 2) Adminstrador.
2.1) Cadastro de tipo categoria:
	- Exemplo(s): Ouro, Prata ou Bronze
		(Será atribuida ao cadastro do instrutor para fins financeiro (marketing).

2.2) Tabela Nível Usuário:
	- 1-Adminstrador, 3-Instrutor, 5-Usuário (final).

2.3) Tabela Modalidade Curso:
	- Categorias: Informática, Mecânica, Culinária, nnn...

2.4) Habilita Instrutor:
	- Dados Absorvidos da Tabela Favorecidos (1.1).

2.5) Quantidade de Cursos Liberado para o Instrutor Cadastrar:
	- nn (quantiade a ser definida) ou 99 (sem limite).


## 3) Instrutor.
3.1) Tabela de Cursos

3.2) Habilita Usuário (Aluno):
	- Dados Absorvidos da Tabela Favorecidos (1.1).


## 4) Usuário (Aluno).
4.1) Controle de Curso:
	- Para controle do aluno.#