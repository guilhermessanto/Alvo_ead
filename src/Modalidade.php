<?php
namespace Alvo;
use PDO, Exception;

final class Modalidade {
    private int $id;
    private string $codModalidade;
    private string $descModalidade;
    private int $indicador;

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }

    // Ler Modalidades
    public function listarModalidade():array {
        $sql = "SELECT id, codModalidade, descModalidade, indicador FROM modalidades ORDER BY codModalidade";

        try {   
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
        return $resultado;
    }

    // Inserir Modalidade
    public function inserirModalidade():void {
        $sql = "INSERT INTO modalidades(codModalidade, descModalidade) VALUES(:codModalidade, :descModalidade)";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':codModalidade', $this->codModalidade, PDO::PARAM_INT);
            $consulta->bindParam(':descModalidade', $this->descModalidade, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Ler UMA Modalidade
    public function listarUmaModalidade():array {
        $sql = "SELECT id, codModalidade, descModalidade FROM modalidades WHERE id = :id";
    
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

    // Atualização da Modalidade
    public function atualizarModalidade():void {
        $sql = "UPDATE modalidades SET codModalidade = :codModalidade, descModalidade = :descModalidade WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':codModalidade', $this->codModalidade, PDO::PARAM_INT);
            $consulta->bindParam(':descModalidade', $this->descModalidade, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

     // Atualização da Indicador
     public function alteraIndicador():void {
        $sql = "UPDATE modalidades SET indicador = :indicador WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':indicador', $this->indicador, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Exclusão da Modalidade
    public function excluirModalidade():void {
        $sql = "DELETE FROM modalidades WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
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

    // codModalidade
    public function getCodModalidade(): string
    {
        return $this->codModalidade;
    }
    public function setCodModalidade(string $codModalidade)
    {
        $this->codModalidade = filter_var($codModalidade, FILTER_SANITIZE_NUMBER_INT);
    }

    // descModalidade
    public function getDescModalidade(): string
    {
        return $this->descModalidade;
    }
    public function setDescModalidade(string $descModalidade)
    {
        $this->descModalidade = filter_var($descModalidade, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // indicador
    public function getIndicador(): int
    {
        return $this->indicador;
    }
    public function setIndicador($indicador)
    {
        $this->indicador = filter_var($indicador, FILTER_SANITIZE_NUMBER_INT);
    }
}