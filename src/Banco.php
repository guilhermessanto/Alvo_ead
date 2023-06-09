<?php

namespace Alvo;

// Indicamos o uso das classes nativas do PHP (ou seja, classes que não fazem parte do nosso namespace).
use PDO, Exception;

abstract class Banco {
    // Propriedades/Atributos de acesso ao servidor de BD
    private static string $servidor = "localhost";
    private static string $usuario = "root";
    private static string $senha = "";
    private static string $banco = "bd_alvo";
    private static PDO $conexao;
    
    // Método de conexão ao banco
    public static function conecta():PDO {
        try {
            self::$conexao = new PDO(
                "mysql:host=".self::$servidor.";
                dbname=".self::$banco.";
                charset=utf8",
                self::$usuario,
                self::$senha
            );
            
            self::$conexao ->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            // echo "Ok!";

        } catch (Exception $erro) {
            die("Erro.: ".$erro->getMessage());
        }

        return self::$conexao;

    }
}