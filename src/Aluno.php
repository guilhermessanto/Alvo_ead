<?php 
namespace Alvo;
use PDO, Exception;

final class Aluno{
    private int $id;
    private int $indicador;
    private int $curso_id;
    private int $ctrAcesso_id;
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }

    // ---------------------------- Utilizado na Área do Adminstrativa (/admin) ---------------------------
    // Lista UM Aluno (/admin)
    public function listarUmAlunoADM(){
        $sql = "SELECT ctracessos.id, ctracessos.indicador, genericos.nome, genericos.email
        FROM ctracessos
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id
        WHERE ctracessos.id = :id";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id",$this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
            return $resultado;
    }

    // Lista de Alunos partindo do CtrAcesso
    public function listarAlunosADM(){
        $sql = "SELECT ctracessos.id, ctracessos.nivel_id, ctracessos.indicador, genericos.nome, genericos.cnpjcpf
        FROM ctracessos
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id
        WHERE ctracessos.nivel_id = 3";
        
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
            return $resultado;
    }

    // Lista os Cursos que estão Habilitados ao Aluno (/admin)
    public function listarCursoAlunoADM():array {
        $sql = "SELECT alunos.id, alunos.ctrAcesso_id, cursos.nomeCurso, cursos.descCurso, cursos.id AS cursoId, cursos.indicador, genericos.id, genericos.nome AS nomeInstrutor, genericos.nome AS nomeInstrutor
        FROM alunos
        RIGHT JOIN cursos ON alunos.curso_id = cursos.id
        RIGHT JOIN instrutores ON cursos.instrutor_id = instrutores.id
        RIGHT JOIN ctracessos ON instrutores.ctrAcesso_id = ctracessos.id
        LEFT JOIN genericos ON ctracessos.generico_id = genericos.id
        WHERE alunos.ctrAcesso_id = :id";
    
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
    // ======================================== FIM DA ÁREA ADM ========================================


    // ------------------------------ Utilizado na Área do Aluno (/alunos) -----------------------------
    // Lista de Alunos
    public function listarAlunos(){
        $sql = "SELECT alunos.id , alunos.indicador, alunos.curso_id, alunos.ctrAcesso_id, genericos.nome,genericos.cnpjcpf, ctracessos.generico_id
        FROM alunos
        LEFT JOIN ctracessos ON alunos.ctrAcesso_id = ctracessos.id
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id";
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
            return $resultado;
    }

    // Listar UM Aluno (/alunos)
    public function listarUmAluno(){
        $sql = "SELECT alunos.id AS alunoId, alunos.indicador, alunos.ctrAcesso_id, genericos.nome,genericos.email, ctracessos.generico_id
        FROM alunos
        LEFT JOIN ctracessos ON alunos.ctrAcesso_id = ctracessos.id
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id 
        WHERE alunos.ctrAcesso_id = :ctrAcesso_id";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":ctrAcesso_id",$this->ctrAcesso_id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
            return $resultado;
    }

    // Listar UM Curso do Aluno
    public function listarUmCurso(){
        $sql = "SELECT alunos.id AS alunoId, alunos.indicador, alunos.curso_id, alunos.ctrAcesso_id, genericos.nome,genericos.email, ctracessos.generico_id, cursos.nomeCurso
        FROM alunos
        INNER JOIN ctracessos ON alunos.ctrAcesso_id = ctracessos.id
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id 
        INNER JOIN cursos ON alunos.curso_id = cursos.id
        WHERE alunos.id = :id ";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id",$this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
            return $resultado;
    }

    // Atualiza o indicador do Aluno (0-Ativo / 1-Desativado)
    public function atualizaIndicador(){
        $sql = "UPDATE alunos SET indicador = :indicador WHERE id = :id ";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id",$this->id, PDO::PARAM_INT);
            $consulta->bindParam(":indicador",$this->indicador,PDO::PARAM_INT );
            $consulta->execute();
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }

    }

    // Habilita Curso(s) para o Aluno
    public function habilitaCurso(){
        $sql = "INSERT INTO alunos (indicador, curso_id, ctrAcesso_id) VALUES (:indicador, :curso_id, :ctrAcesso_id)";

        try{
            $consulta = $this->conexao->prepare($sql);
            /* $consulta->bindParam(":id",$this->id, PDO::PARAM_INT); */
            $consulta->bindParam(":indicador",$this->indicador,PDO::PARAM_INT );
            $consulta->bindParam(":curso_id",$this->curso_id,PDO::PARAM_INT );
            $consulta->bindParam(":ctrAcesso_id",$this->ctrAcesso_id,PDO::PARAM_INT );
            $consulta->execute();
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }

    }

    // Lista os Cursos Ativo do Aluno
    public function cursosAtivosAlunos(){
        $sql = "SELECT  alunos.id as alunoId , alunos.indicador, alunos.curso_id, alunos.ctrAcesso_id, genericos.nome,genericos.email, ctracessos.generico_id, cursos.id, cursos.nomeCurso, cursos.imagem
        FROM alunos
        INNER JOIN ctracessos ON alunos.ctrAcesso_id = ctracessos.id
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id
        INNER JOIN cursos ON alunos.curso_id = cursos.id 
        WHERE alunos.ctrAcesso_id = :ctrAcesso_id ";

         try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":ctrAcesso_id",$this->ctrAcesso_id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
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

    // Indicador -> 0-Ativo / 1-Desativado
    public function getIndicador(): int
    {
        return $this->indicador;
    }
    public function setIndicador(int $indicador)
    {
        $this->indicador = filter_var($indicador, FILTER_SANITIZE_NUMBER_INT);
    }

    // Cursos atribuidos ao aluno (por ser NULL)
    public function getCursoId(): int
    {
        return $this->curso_id;
    }
    public function setCursoId(int $curso_id)
    {
        $this->curso_id = filter_var($curso_id, FILTER_SANITIZE_NUMBER_INT);
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