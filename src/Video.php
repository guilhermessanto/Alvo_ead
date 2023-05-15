<?php
namespace Alvo;
use PDO, Exception;

final class Video{
    private int $id;
    private  string $nomeVideo;
    private string $link;
    private string $descricao;
    private int $curso_id;
    private PDO $conexao;

    
    public function __construct()
    {
        $this->conexao = Banco::conecta();
    } 
    
    public function inserirVideo():void{
        $sql = "INSERT INTO videos(nomeVideo, link, descricao, curso_id) VALUES (:nomeVideo, :link, :descricao,:curso_id)";
        
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":nomeVideo", $this->nomeVideo, PDO::PARAM_STR);
            $consulta->bindParam(":link", $this->link, PDO::PARAM_STR);
            $consulta->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $consulta->bindParam(":curso_id",$this->curso_id, PDO::PARAM_INT);
            $consulta->execute();
            
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
    }


    public function listarVideo(){
        $sql = "SELECT id, nomeVideo, link, descricao, curso_id FROM videos WHERE curso_id = :curso_id ORDER BY nomeVideo";
        
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":curso_id",$this->curso_id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
        return  $resultado;
    }


    public function listarUmVideo(){
        $sql = "SELECT id, nomeVideo, link, descricao, curso_id FROM videos WHERE id = :id";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id",$this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
        return  $resultado;


    }


    public function atualizarVideo(){
        $sql = "UPDATE videos set nomeVideo = :nomeVideo, link = :link, descricao = :descricao, curso_id = :curso_id WHERE id = :id";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            $consulta->bindParam(":nomeVideo", $this->nomeVideo, PDO::PARAM_STR);
            $consulta->bindParam(":link", $this->link, PDO::PARAM_STR);
            $consulta->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $consulta->bindParam(":curso_id", $this->curso_id, PDO::PARAM_INT);
            $consulta->execute();
            
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
    }

    public function excluirVideo(){

        $sql = "DELETE FROM videos WHERE id = :id";
        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();

        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
    }















    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);

        
    }

    public function getNomeVideo(): string
    {
        return $this->nomeVideo;
    }

   
    public function setNomeVideo(string $nomeVideo)
    {
        $this->nomeVideo = filter_var($nomeVideo,FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link)
    {
        $this->link = filter_var($link,FILTER_SANITIZE_SPECIAL_CHARS);
        
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao)
    {
        $this->descricao = filter_var($descricao,FILTER_SANITIZE_SPECIAL_CHARS);

    }

    
    public function getCursoId(): int
    {
        return $this->curso_id;
    }


    public function setCursoId(int $curso_id)
    {
        $this->curso_id = filter_var($curso_id,FILTER_SANITIZE_NUMBER_INT);
    }

    public function getControleVideo(): int
    {
        return $this->controleVideo;
    }

    public function setControleVideo(int $controleVideo)
    {
        $this->controleVideo = filter_var($controleVideo,FILTER_SANITIZE_NUMBER_INT);
    }
}
