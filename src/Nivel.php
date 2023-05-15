<?php
namespace Alvo;
use PDO, Exception;

final class Nivel {
    private int $id;
    private string $codNivel;
    private string $descNivel;
    private int $indicador;

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }

    // Ler Niveis
    public function listarNiveis():array {
        $sql = "SELECT id, codNivel, descNivel, indicador FROM niveis ORDER BY codNivel";

        try {   
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
        return $resultado;
    }

    // Inserir Nivel
    public function inserirNivel():void {
        $sql = "INSERT INTO niveis(codNivel, descNivel) VALUES(:codNivel, :descNivel)";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':codNivel', $this->codNivel, PDO::PARAM_INT);
            $consulta->bindParam(':descNivel', $this->descNivel, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Ler UM Nivel
    public function listarUmNivel():array {
        $sql = "SELECT id, codNivel, descNivel FROM niveis WHERE id = :id";
    
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

    // Atualização do Nivel
    public function atualizarNivel():void {
        $sql = "UPDATE niveis SET codNivel = :codNivel, descNivel = :descNivel WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':codNivel', $this->codNivel, PDO::PARAM_INT);
            $consulta->bindParam(':descNivel', $this->descNivel, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

      // Atualização da Indicador
      public function alteraIndicador():void {
        $sql = "UPDATE niveis SET indicador = :indicador WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':indicador', $this->indicador, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Exclusão do Nivel
    public function excluirNivel():void {
        $sql = "DELETE FROM niveis WHERE id = :id";
    
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

    // codNivel
    public function getCodNivel(): string
    {
        return $this->codNivel;
    }
    public function setCodNivel(string $codNivel)
    {
        $this->codNivel = filter_var($codNivel, FILTER_SANITIZE_NUMBER_INT);
    }

    // descNivel
    public function getDescNivel(): string
    {
        return $this->descNivel;
    }
    public function setDescNivel(string $descNivel)
    {
        $this->descNivel = filter_var($descNivel, FILTER_SANITIZE_SPECIAL_CHARS);
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