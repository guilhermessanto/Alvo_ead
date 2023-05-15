<?php
namespace Alvo;
use PDO, Exception;

final class Categoria {
    private int $id;
    private string $descCategoria;
    private int $indicador;

    private PDO $conexao;

    public function __construct() {
        // No momento em que for criado um objeto a partir da classe Fabricante, automaticamente será feita a conexão com o banco.
        $this->conexao = Banco::conecta();
    }

    // Ler Categorias
    public function listarCategorias():array {
        $sql = "SELECT id, descCategoria, indicador FROM categorias ORDER BY descCategoria";

        try {   
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
        return $resultado;
    }

    // Inserir Categoria
    public function inserirCategoria():void {
        $sql = "INSERT INTO categorias(descCategoria) VALUES(:descCategoria)";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':descCategoria', $this->descCategoria, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Ler UMA Categoria
    public function listarUmaCategoria():array {
        $sql = "SELECT id, descCategoria FROM categorias WHERE id = :id";
    
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

    // Atualização da Categoria
    public function atualizarCategoria():void {
        $sql = "UPDATE categorias SET descCategoria = :descCategoria WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':descCategoria', $this->descCategoria, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Atualização da Indicador
    public function alteraIndicador():void {
        $sql = "UPDATE categorias SET indicador = :indicador WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':indicador', $this->indicador, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }

    // Exclusão de Categoria
    public function excluirCategoria():void {
        $sql = "DELETE FROM categorias WHERE id = :id";
    
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

    // descCategoria
    public function getDescCategoria(): string
    {
        return $this->descCategoria;
    }
    public function setDescCategoria(string $descCategoria)
    {
        $this->descCategoria = filter_var($descCategoria, FILTER_SANITIZE_SPECIAL_CHARS);
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