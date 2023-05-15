<?php
namespace Alvo;
use PDO, Exception;

final class CtrAcesso {
    private int $id;
    private int $indicador;
    private string $senha;
    private int $generico_id;
    private int $nivel_id;
    /* private int $tabDestino_id; */

    private PDO $conexao;

    public function __construct(){
        
        $this->conexao = Banco::conecta();
        
        // Se NÃO EXISTE uma sessão em funcionamento
        if( !isset($_SESSION) ){
            // Então iniciamos a sessão
            session_start();
        }
    }

    public function verificaAcesso():void{
        /* Se NÃO EXISTIR uma variável de sessão relacionada ao id do usuário logado... */
        if(!isset($_SESSION['id'])){
            /* Então significa que o usuário não está  logado,
            portanto apague qualquer resquício de sessão
            e force o usuário a ir para login.php*/
            session_destroy();
            header("location:../login.php?acesso_proibido");
            die(); // exit;
        }
    }

    public function login(int $id, string $email, string $nivel_id, string $nome, string $descNivel){
        /* No momento em que ocorrer o login, adicionamos à sessão
        variáveis de sessão contendo os dados necessários para o sistema*/
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['nivel_id'] = $nivel_id;
        $_SESSION['nome'] = $nome;
        $_SESSION['descNivel'] = $descNivel;

  
   
    }

    public function logout():void{
        session_start();
        session_destroy();
        header("location:../login.php?logout");
        die(); // exit;
    }

    public function verificaAcessoAdmin():void {
        if($_SESSION['nivel_id'] !== "1" ){
            header("location:nao-autorizado.php");
            die();
        }

    }

    public function verificaAcessoInstr():void {
        if($_SESSION['nivel_id'] > 2 ){
            header("location:nao-autorizado.php");
            die();
        }
    }
    
    public function verificaAcessoAluno():void {
        if($_SESSION['nivel_id'] > 3 ){
            header("location:nao-autorizado.php");
            die();
        }

    }

    

    // Habilita Controle de Acesso
    public function habilitaCtrAcesso():void {
        // Criando a tabela de controle de acesso
        $sqlInsert = "INSERT INTO ctracessos(indicador, senha, generico_id, nivel_id) VALUES(:indicador, :senha, :generico_id, :nivel_id)";
        // Atualização tabela 'genericos' ,, dependência do id (controle de acesso)
        $sqlUpdate = "UPDATE genericos SET ctrAcesso_id = :ctrAcesso_id WHERE id = :id";
        // Criando a tabela Instrutores >> quando necessário
        $sqlInsertInstr = "INSERT INTO instrutores(limiteCurso, indicador, categoria_id, ctrAcesso_id) VALUES(:limiteCurso, :indicador, :categoria_id, :ctrAcesso_id)";
        // Criando a tabela Instrutores >> quando necessário
        $sqlInsertAluno = "INSERT INTO alunos(indicador, ctrAcesso_id) VALUES(:indicador, :ctrAcesso_id)";
        try {
            // Cria controle de acesso
            $consultaInsert = $this->conexao->prepare($sqlInsert);
            $consultaInsert->bindParam(':indicador', $this->indicador, PDO::PARAM_INT);
            $consultaInsert->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $consultaInsert->bindParam(':generico_id', $this->generico_id, PDO::PARAM_INT);
            $consultaInsert->bindParam(':nivel_id', $this->nivel_id, PDO::PARAM_INT);
            $consultaInsert->execute();

            // Recuperando o id criado automaticamente da tabela 'ctrAcesso' para inserção de fk na tabela 'genericos'.
            $ctrAcesso_id = $this->conexao->lastInsertId();
            $consultaUpdate = $this->conexao->prepare($sqlUpdate);
            $consultaUpdate->bindParam(':ctrAcesso_id', $ctrAcesso_id, PDO::PARAM_INT);
            $consultaUpdate->bindValue(':id', $this->getGenericoId(), PDO::PARAM_INT);
            $consultaUpdate->execute();

            // Quando selecionado Instrutor, já cria/habilita na tabela de 'innstrutores'
            if ( $this->getNivelId() == 2 ) {
                $consultaInsertInstr = $this->conexao->prepare($sqlInsertInstr);
                $consultaInsertInstr->bindValue(':limiteCurso', 0, PDO::PARAM_INT);
                $consultaInsertInstr->bindParam(':indicador', $this->indicador, PDO::PARAM_INT);
                $consultaInsertInstr->bindValue(':categoria_id', 2, PDO::PARAM_INT);
                $consultaInsertInstr->bindParam(':ctrAcesso_id', $ctrAcesso_id, PDO::PARAM_INT);
                $consultaInsertInstr->execute();
            }

            // Quando selecionado Aluno, já cria/habilita na tabela de 'Alunos'
            if ( $this->getNivelId() == 3 ) {
                $consultaInsertAluno = $this->conexao->prepare($sqlInsertAluno);
                $consultaInsertAluno->bindParam(':indicador', $this->indicador, PDO::PARAM_INT);
                $consultaInsertAluno->bindParam(':ctrAcesso_id', $ctrAcesso_id, PDO::PARAM_INT);
                $consultaInsertAluno->execute();
            }
/* 
            if ( $this->getNivelId() == 2 || $this->getNivelId() == 3  ) {
                // Cria Id da ulima inserção (instrutor ou aluno)
                $tabDestino_id = $this->conexao->lastInsertId();
                // Cria controle de acesso
                $consultaInsert = $this->conexao->prepare($sqlInsert);
                $consultaInsert->bindParam(':tabDestino_id', $this->tabDestino_id, PDO::PARAM_INT);
                $consultaInsert->execute();
            } */


        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }

    }
    
    // Altera Controle de Acesso (status e nivel do usuário)
    public function alteraCtrAcesso():void {
        $sql = "UPDATE ctracessos SET indicador = :indicador WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':indicador', $this->indicador, PDO::PARAM_INT);
            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }

    }

    
    // Listar UM ctrAcesso
    public function listarUmCtrAcesso():array {
        $sql = "SELECT ctracessos.id, ctracessos.indicador, ctracessos.generico_id, ctracessos.nivel_id, genericos.nome, niveis.descNivel FROM ctracessos
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id
        INNER JOIN niveis ON ctracessos.nivel_id = niveis.id
        WHERE ctracessos.id = :id";
    
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

    // consistência da senha
    public function codificaSenha(string $senha):string {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    // Verifica senha
    public function verificaSenha(string $senhaFormulario, string $senhaBanco):string {
        
        // Usando a password_verify para COMPARAR as duas senhas: digitada com existente no BD
        if ( password_verify($senhaFormulario, $senhaBanco) ) {
            // Senhas iguais,, então não mude!
            return $senhaBanco;
        } else {
            // Senhas diferentes,, então codifique!
            return $this->codificaSenha($senhaFormulario);
        }
    }

    //Atualiza Senha
    public function trocaSenha(){
        $sql = "UPDATE ctracessos SET senha = :senha WHERE id = :id ";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            
            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }


    }

    public function listarCtrAcessos(){
        $sql = "SELECT ctracessos.id, ctracessos.indicador, ctracessos.generico_id, ctracessos.nivel_id, genericos.nome,genericos.cnpjcpf, niveis.descNivel FROM ctracessos
        INNER JOIN genericos ON ctracessos.generico_id = genericos.id
        INNER JOIN niveis ON ctracessos.nivel_id = niveis.id
        WHERE ctracessos.nivel_id = 3";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            
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

    // indicador 0-ativo / 1-desativado
    public function getIndicador(): int
    {
        return $this->indicador;
    }
    public function setIndicador(int $indicador)
    {
        $this->indicador = filter_var($indicador, FILTER_SANITIZE_NUMBER_INT);
    }

    // senha
    public function getSenha(): string
    {
        return $this->senha;
    }
    public function setSenha(string $senha)
    {
        $this->senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // id - (tabela) generico
    public function getGenericoId(): int
    {
        return $this->generico_id;
    }
    public function setGenericoId(int $generico_id)
    {
        $this->generico_id = filter_var($generico_id, FILTER_SANITIZE_NUMBER_INT);
    }

    // id - (tabela) niveis
    public function getNivelId(): int
    {
        return $this->nivel_id;
    }
    public function setNivelId(int $nivel_id)
    {
        $this->nivel_id = filter_var($nivel_id, FILTER_SANITIZE_NUMBER_INT);
    }


    // id - (tabela de origem) ou instrutor ou aluno, recuperar pelo nivel de id.
  /*   public function getTabDestinoId(): int
    {
        return $this->tabDestino_id;
    }
    public function setTabDestinoId(int $tabDestino_id)
    {
        $this->tabDestino_id = filter_var($tabDestino_id, FILTER_SANITIZE_NUMBER_INT);
    } */
}