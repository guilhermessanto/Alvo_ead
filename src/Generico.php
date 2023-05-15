<?php
namespace Alvo;
use PDO, Exception;
use Alvo\Utilitarios;

final class Generico {
    private int $id;
    private int $tipoFavorecido;
    private string $cnpjcpf;
    private string $nome;
    private string $email;
    private string $telefone;
    private string $cep;
    private string $endereco;
    private string $numero;
    private string $complemento;
    private string $bairro;
    private string $cidade;
    private string $uf;
    private string $codMunicipio;
    private int $ctrAcesso_id;

    private string $strConsulta;

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }

    // Ler cnpj/cpf
    public function listarGenerico():array {
        $sql = "SELECT id, tipoFavorecido, cnpjcpf, nome, email, ctrAcesso_id FROM genericos ORDER BY cnpjcpf";

        try {   
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
        return $resultado;
    }
    
    // Inserir cnpj/cpf
    public function inserirGenerico():void {
        $sql = "INSERT INTO genericos(tipoFavorecido, cnpjcpf, nome, email, telefone, cep, endereco, numero, complemento, bairro, cidade, uf, codMunicipio) VALUES(:tipoFavorecido, :cnpjcpf, :nome, :email, :telefone, :cep, :endereco, :numero, :complemento, :bairro, :cidade, :uf, :codMunicipio)";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':tipoFavorecido', $this->tipoFavorecido, PDO::PARAM_INT);
            $consulta->bindParam(':cnpjcpf', $this->cnpjcpf, PDO::PARAM_STR);
            $consulta->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $consulta->bindParam(':email', $this->email, PDO::PARAM_STR);
            $consulta->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
            $consulta->bindParam(':cep', $this->cep, PDO::PARAM_STR);
            $consulta->bindParam(':endereco', $this->endereco, PDO::PARAM_STR);
            $consulta->bindParam(':numero', $this->numero, PDO::PARAM_STR);
            $consulta->bindParam(':complemento', $this->complemento, PDO::PARAM_STR);
            $consulta->bindParam(':bairro', $this->bairro, PDO::PARAM_STR);
            $consulta->bindParam(':cidade', $this->cidade, PDO::PARAM_STR);
            $consulta->bindParam(':uf', $this->uf, PDO::PARAM_STR);
            $consulta->bindParam(':codMunicipio', $this->codMunicipio, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }
    
    // Ler UM cnpj/cpf
    public function listarUmGenerico():array {
        $sql = "SELECT id, tipoFavorecido, cnpjcpf, nome, email, telefone, cep, endereco, numero, complemento, bairro, cidade, uf, codMunicipio, ctrAcesso_id FROM genericos WHERE id = :id";
    
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
    
    // Atualização de cnpj/cpf
    public function atualizarGenerico():void {
        $sql = "UPDATE genericos SET nome = :nome, telefone = :telefone, cep = :cep, endereco = :endereco, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, uf = :uf, codMunicipio = :codMunicipio WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $consulta->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
            $consulta->bindParam(':cep', $this->cep, PDO::PARAM_STR);
            $consulta->bindParam(':endereco', $this->endereco, PDO::PARAM_STR);
            $consulta->bindParam(':numero', $this->numero, PDO::PARAM_STR);
            $consulta->bindParam(':complemento', $this->complemento, PDO::PARAM_STR);
            $consulta->bindParam(':bairro', $this->bairro, PDO::PARAM_STR);
            $consulta->bindParam(':cidade', $this->cidade, PDO::PARAM_STR);
            $consulta->bindParam(':uf', $this->uf, PDO::PARAM_STR);
            $consulta->bindParam(':codMunicipio', $this->codMunicipio, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    }
    
    // Exclusão de cnpj/cpf
    public function excluirGenerico():void {
        $sql = "DELETE FROM genericos WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
    }

    // Busca (string) nos atributos de texto
    public function buscaFavorecido():array {
        $sql = "SELECT id, tipoFavorecido, cnpjcpf, nome, email, ctrAcesso_id FROM genericos
            WHERE nome LIKE :strConsulta OR cnpjcpf LIKE :strConsulta OR email LIKE :strConsulta
            ORDER BY nome DESC";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(':strConsulta', '%'.$this->strConsulta.'%', PDO::PARAM_STR);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
        return $resultado;
    }



    public function buscar(){
        $sql = "SELECT * FROM genericos INNER JOIN ctracessos ON ctracessos.generico_id = genericos.id WHERE email = :email";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":email", $this->email, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $erro) {
            die("Erro: ". $erro->getMessage());
        }

        return $resultado;
    }

    public function codificaSenha(string $senha):string {
        return password_hash($senha, PASSWORD_DEFAULT);
    }
        
    /* Usamos a password_verify para COMPARAR as duas senhas: 
    a digitada no formulário e a existente no Banco*/
    public function verificaSenha(string $senhaFormulario, string $senhaBanco):string {
        if (password_verify($senhaFormulario, $senhaBanco)) {
            return $senhaBanco;
        } else {
           return $this->codificaSenha($senhaFormulario);
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

    // tipo favorecido
    public function getTipoFavorecido(): int
    {
        return $this->tipoFavorecido;
    }
    public function setTipoFavorecido(int $tipoFavorecido)
    {
        $this->tipoFavorecido = filter_var($tipoFavorecido, FILTER_SANITIZE_NUMBER_INT);
    }

    // cnpj / cpf
    public function getCnpjcpf(): string
    {
        return $this->cnpjcpf;
    }
    public function setCnpjcpf(string $cnpjcpf)
    {
        $this->cnpjcpf = filter_var(Utilitarios::limpaMascara($cnpjcpf), FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // nome
    public function getNome(): string
    {
        return $this->nome;
    }
    public function setNome(string $nome)
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // e-mail
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // telefone
    public function getTelefone(): string
    {
        return $this->telefone;
    }
    public function setTelefone(string $telefone)
    {
        $this->telefone = filter_var($telefone, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
    // cep
    public function getCep(): string
    {
        return $this->cep;
    }
    public function setCep(string $cep)
    {
        $this->cep = filter_var($cep, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // endereço
    public function getEndereco(): string
    {
        return $this->endereco;
    }
    public function setEndereco(string $endereco)
    {
        $this->endereco = filter_var($endereco, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // número
    public function getNumero(): string
    {
        return $this->numero;
    }
    public function setNumero(string $numero)
    {
        $this->numero = filter_var($numero, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // complemento
    public function getComplemento(): string
    {
        return $this->complemento;
    }
    public function setComplemento(string $complemento)
    {
        $this->complemento = filter_var($complemento, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // bairro
    public function getBairro(): string
    {
        return $this->bairro;
    }
    public function setBairro(string $bairro)
    {
        $this->bairro = filter_var($bairro, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // cidade
    public function getCidade(): string
    {
        return $this->cidade;
    }
    public function setCidade(string $cidade)
    {
        $this->cidade = filter_var($cidade, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // uf
    public function getUf(): string
    {
        return $this->uf;
    }
    public function setUf(string $uf)
    {
        $this->uf = filter_var($uf, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // código município
    public function getCodMunicipio(): string
    {
        return $this->codMunicipio;
    }
    public function setCodMunicipio(string $codMunicipio)
    {
        $this->codMunicipio = filter_var($codMunicipio, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // Id da Tabela controle de acesso
    public function getCtrAcessoId(): int
    {
        return $this->ctrAcesso_id;
    }
    public function setCtrAcessoId(int $ctrAcesso_id)
    {
        $this->ctrAcesso_id = filter_var($ctrAcesso_id, FILTER_SANITIZE_NUMBER_INT);
    }

    // string de consulta (usando na busca)
    public function getStrConsulta(): string
    {
        return $this->strConsulta;
    }
    public function setStrConsulta(string $strConsulta)
    {
        $this->strConsulta = filter_var($strConsulta, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}