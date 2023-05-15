<?php 
namespace Alvo;
use PDO, Exception;

final class Curso{
    private int $id;
    private string $nomeCurso;
    private string $descCurso;
    private int $indicador; /* ativo=0  ou inativo=1 */ 
    private string $imagem;
    private int $modalidade_id; /* categoria */
    private int $instrutor_id;
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Banco::conecta();
    }    

    public function inserirCurso():void{
        $sql = "INSERT INTO cursos(nomeCurso, descCurso,indicador,imagem,modalidade_id,instrutor_id) VALUES(:nomeCurso, :descCurso, :indicador, :imagem, :modalidade_id, :instrutor_id)";
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":nomeCurso", $this->nomeCurso, PDO::PARAM_STR);
            $consulta->bindParam(":descCurso", $this->descCurso, PDO::PARAM_STR);
            $consulta->bindParam(":indicador", $this->indicador, PDO::PARAM_INT);
            $consulta->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindParam(":modalidade_id", $this->modalidade_id, PDO::PARAM_INT);
            $consulta->bindValue(":instrutor_id",$this->instrutor_id, PDO::PARAM_INT);
            $consulta->execute();
            
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
    }
    public function upload(array $arquivo){
        $tiposValidos = [
            "image/png",
            "image/jpeg",
            "image/gif",
            "image/svg+xml"
        ];
        if(!in_array($arquivo['type'], $tiposValidos))
        {
            die("<script>
            alert('Formato inválido!');
            history.back();
            </script>"
            );
        }
        $nome = $arquivo['name'];
        $temporario = $arquivo['tmp_name'];
        $destino = "../imagem/".$nome;
        move_uploaded_file($temporario, $destino);
    }

    public function cursosAtivos():array{
      /*   $sql = "SELECT id, nomeCurso, descCurso,indicador,imagem,modalidade_id,instrutor_id 
        FROM cursos

        RIGHT JOIN ctracessos ON instrutores.ctrAcesso_id = ctracessos.id
        WHERE indicador = 0 AND instrutor_id = :instrutores.id"; */

        $sql = "SELECT cursos.id, cursos.nomeCurso, cursos.descCurso, cursos.indicador, cursos.modalidade_id, cursos.instrutor_id, instrutores.ctrAcesso_id  
        FROM cursos 
        RIGHT JOIN instrutores ON cursos.instrutor_id = instrutores.id
        RIGHT JOIN ctracessos ON instrutores.ctrAcesso_id = ctracessos.id
        WHERE instrutores.id = :id";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id",$this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
            return $resultado;
    }

    public function todosOsCursos(){
        $sql = "SELECT id, nomeCurso, descCurso,indicador,imagem,modalidade_id,instrutor_id 
        FROM cursos";
        
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
            return $resultado;
    }

    public function cursosDesativos():array{
        $sql = "SELECT id, nomeCurso, descCurso,indicador,imagem,modalidade_id,instrutor_id 
        FROM cursos WHERE indicador = 1";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
            return $resultado;
    }
    
    public function listarUmCurso(){
        $sql = "SELECT id, nomeCurso, descCurso, indicador, imagem,modalidade_id, instrutor_id 
        FROM cursos WHERE id = :id ";
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
    
    public function atualizarCurso(){
    $sql = "UPDATE cursos set nomeCurso = :nomeCurso, descCurso = :descCurso, indicador = :indicador, imagem = :imagem, modalidade_id = :modalidade_id, instrutor_id = :instrutor_id WHERE id = :id";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            $consulta->bindParam(":nomeCurso", $this->nomeCurso, PDO::PARAM_STR);
            $consulta->bindParam(":descCurso", $this->descCurso, PDO::PARAM_STR);
            $consulta->bindParam(":indicador", $this->indicador, PDO::PARAM_INT);
            $consulta->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindParam(":modalidade_id", $this->modalidade_id, PDO::PARAM_INT);
            $consulta->bindValue(":instrutor_id",$this->instrutor_id, PDO::PARAM_INT);
            $consulta->execute();
            
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
    }
    
    public function excluirCurso(){
        $sql = "DELETE FROM cursos WHERE id = :id";
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();

        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
    }


    // Atualiza o indicador do Aluno (0-Ativo / 1-Desativado)
    public function atualizaIndicadorCurso() {
        $sql = "UPDATE cursos SET indicador = :indicador WHERE id = :id ";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id",$this->id, PDO::PARAM_INT);
            $consulta->bindParam(":indicador",$this->indicador,PDO::PARAM_INT );
            $consulta->execute();
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }

    }






























 /* -----------GETTERS AND SETTERS-------------*/   
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id) 
    {
        $this->id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
    }
/* ------------------------------------------- */
    public function getDescCurso(): string
    {
        return $this->descCurso;
    }

    public function setDescCurso(string $descCurso) 
    {
        $this->descCurso = filter_var($descCurso,FILTER_SANITIZE_SPECIAL_CHARS);
    }
/* ------------------------------------------- */
    public function getComplemento(): string
    {
        return $this->complemento;
    }
    public function setComplemento(string $complemento) 
    {
        $this->complemento =  filter_var($complemento,FILTER_SANITIZE_SPECIAL_CHARS);
    }
/* ------------------------------------------- */
 
    public function getIndicador(): int
    {
        return $this->indicador;
    }

    public function setIndicador(int $indicador) 
    {
        $this->indicador = filter_var($indicador,FILTER_SANITIZE_NUMBER_INT);
    }
/* ------------------------------------------- */

    public function getCaminho(): string
    {
        return $this->caminho;
    }

    public function setCaminho(string $caminho) 
    {
        $this->caminho =  filter_var($caminho,FILTER_SANITIZE_SPECIAL_CHARS);
    }
/* ------------------------------------------- */
 
    public function getModalidadeId(): int
    {
        return $this->modalidade_id;
    }

    public function setModalidadeId(int $modalidade_id) 
    {
        $this->modalidade_id =filter_var($modalidade_id,FILTER_SANITIZE_NUMBER_INT);
    }
/* ------------------------------------------- */
 
    public function getInstrutorId(): int
    {
        return $this->instrutor_id;
    }
    public function setInstrutorId(int $instrutor_id) 
    {
        $this->instrutor_id = filter_var($instrutor_id,FILTER_SANITIZE_NUMBER_INT);
    }
/* ------------------------------------------- */

    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function setImagem(string $imagem)
    {
        $this->imagem = filter_var($imagem,FILTER_SANITIZE_SPECIAL_CHARS);
    }
/* ------------------------------------------- */

    public function getNomeCurso(): string
    {
        return $this->nomeCurso;
    }
    public function setNomeCurso(string $nomeCurso)
    {
        $this->nomeCurso = filter_var($nomeCurso, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}