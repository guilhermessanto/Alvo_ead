<?php
namespace Alvo;
use PDO, Exception;
use Alvo\Utilitarios;

final class Instrutor {
    private int $id;
    private string $limiteCurso;
    private int $indicador; /* ativo=0  ou inativo=1 */ 
    private int $categoria_id;
    private int $ctrAcesso_id;

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }

    // Ler Instrutores
    public function listarInstrutores():array {
        $sql = "SELECT instrutores.id, limiteCurso, instrutores.indicador, categoria_id, instrutores.ctrAcesso_id, genericos.nome, categorias.descCategoria  FROM instrutores 
        LEFT JOIN ctracessos ON instrutores.ctracesso_id = ctracessos.id
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id
        INNER JOIN categorias ON instrutores.categoria_id = categorias.id
        ORDER BY limiteCurso";

        try {   
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
        return $resultado;
    }

    // Inserir Instrutor
    public function inserirInstrutor():void {
        $sql = "INSERT INTO instrutores(limiteCurso) VALUES(:limiteCurso)";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':limiteCurso', $this->limiteCurso, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Ler UM Instrutor
    public function listarUmInstrutor():array {
        $sql = "SELECT instrutores.id, limiteCurso, instrutores.indicador, categoria_id, genericos.nome, categorias.descCategoria  FROM instrutores 
        LEFT JOIN ctracessos ON instrutores.ctrAcesso_id = ctracessos.id
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id 
        INNER JOIN categorias ON instrutores.categoria_id = categorias.id
        WHERE instrutores.id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
        return $resultado;
    }

    // Ler o CURSO relacionado a UM Instrutor
    public function listarCursoInstrutor():array {
        $sql = "SELECT cursos.id, cursos.nomeCurso, cursos.descCurso, cursos.indicador, cursos.modalidade_id, modalidades.descModalidade, cursos.instrutor_id, instrutores.ctrAcesso_id, ctracessos.generico_id, genericos.nome  
        FROM cursos 
        RIGHT JOIN instrutores ON cursos.instrutor_id = instrutores.id
        RIGHT JOIN ctracessos ON instrutores.ctrAcesso_id = ctracessos.id
        RIGHT JOIN genericos ON ctracessos.generico_id = genericos.id
        LEFT JOIN modalidades ON cursos.modalidade_id = modalidades.id
        WHERE instrutores.id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
        return $resultado;
    }

    // Atualização do Instrutor
    public function atualizarInstrutor():void {
        $sql = "UPDATE instrutores SET limiteCurso = :limiteCurso, indicador = :indicador, categoria_id = :categoria_id WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':limiteCurso', $this->limiteCurso, PDO::PARAM_STR);
            $consulta->bindParam(':indicador', $this->indicador, PDO::PARAM_INT);
            $consulta->bindParam(':categoria_id', $this->categoria_id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Exclusão do Instrutor
    public function excluirInstrutor():void {
        $sql = "DELETE FROM instrutores WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Lista os Alunos e Cursos Relacionados ao Instrutor
    public function listarCursoAlunoInst():array {
        $sql = "SELECT alunos.id, alunos.curso_id, alunos.ctrAcesso_id, genericos.nome AS nomeAluno, genericos.email,
        cursos.instrutor_id, cursos.nomeCurso, cursos.descCurso, cursos.modalidade_id
        FROM alunos
        INNER JOIN ctracessos ON alunos.ctrAcesso_id = ctracessos.id
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id
        INNER JOIN cursos ON alunos.curso_id = cursos.id
        INNER JOIN instrutores ON cursos.instrutor_id = instrutores.id
        WHERE instrutores.id = :id";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
        return $resultado;
    }


    // id
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }

    // limiteCurso
    public function getlimiteCurso(): string
    {
        return $this->limiteCurso;
    }
    public function setlimiteCurso(string $limiteCurso)
    {
        $this->limiteCurso = filter_var($limiteCurso, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // Indicador -> 0-Ativo / 1-Desativado
    public function getIndicador()
    {
        return $this->indicador;
    }
    public function setIndicador($indicador)
    {
        $this->indicador = filter_var($indicador, FILTER_SANITIZE_NUMBER_INT);
    }

    // categoria_id - (tabela) categorias
    public function getCategoriaId(): int
    {
        return $this->categoria_id;
    }
    public function setCategoriaId(int $categoria_id)
    {
        $this->categoria_id = filter_var($categoria_id, FILTER_SANITIZE_NUMBER_INT);
    }

    // ctrAcesso_id - (tabela) ctrAcessos
    public function getCtrAcessoId(): int
    {
        return $this->ctrAcesso_id;
    }
    public function setCtrAcessoId(int $ctrAcesso_id)
    {
        $this->ctrAcesso_id = filter_var($ctrAcesso_id, FILTER_SANITIZE_NUMBER_INT);
    }


}