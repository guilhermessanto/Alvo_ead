<?php
use Alvo\Generico;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Favorecido (Atualiza)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJgenerico = new Generico;
$OBJgenerico->setId($_GET['id']);
$dados = $OBJgenerico->listarUmGenerico();

$listaUF = Utilitarios::listaUF();
$listaTipoFavorecido = Utilitarios::tipoFavorecido();

// Utilitarios::dump($listaUF);
if( isset ($_POST['atualizar'])) {
	$OBJgenerico->setNome($_POST['nome']);
	$OBJgenerico->setTelefone($_POST['telefone']);
    $OBJgenerico->setCep($_POST['cep']);
    $OBJgenerico->setEndereco($_POST['endereco']);
    $OBJgenerico->setNumero($_POST['numero']);
    $OBJgenerico->setComplemento($_POST['complemento']);
    $OBJgenerico->setBairro($_POST['bairro']);
    $OBJgenerico->setCidade($_POST['cidade']);
    $OBJgenerico->setUf($_POST['uf']);
    $OBJgenerico->setCodMunicipio($_POST['codMunicipio']);

	$OBJgenerico->atualizarGenerico();
	header("location:generico.php");
}
?>

<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Atualizar dados Favorecido
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="tipoFavorecido">Tipo Favorecido:</label>
				<input class="form-control" type="text" id="tipoFavorecido" name="tipoFavorecido" value="<?=$dados['tipoFavorecido']?> - <?=$listaTipoFavorecido[$dados['tipoFavorecido']]?>" readonly>
			</div>

            <div class="mb-3">
				<label class="form-label" for="text">CNPJ/CPF:</label>
				<input class="form-control" type="text" id="cnpjcpf" name="cnpjcpf" value="<?=Utilitarios::formataCnpjcpf($dados['cnpjcpf'])?>" readonly>
			</div>

			<div class="mb-3">
				<label class="form-label" for="text">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$dados['nome']?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="text">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?=$dados['email']?>" readonly>
			</div>

			<div class="mb-3">
				<label class="form-label" for="telefone">Telefone:</label>
				<input class="form-control" type="text" id="telefone" name="telefone" value="<?=$dados['telefone']?>">
			</div>

			<div class="mb-3">
				<label class="form-label" for="cep">CEP:</label>
				<input class="form-control" type="text" id="cep" name="cep" maxlength="9" value="<?=$dados['cep']?>" required>
				<b id="status"></b>
			</div>

			<div class="mb-3">
				<label class="form-label" for="endereco">Endereço:</label>
				<input class="form-control" type="text" id="endereco" name="endereco" value="<?=$dados['endereco']?>">
			</div>

			<div class="mb-3">
				<label class="form-label" for="numero">Número:</label>
				<input class="form-control" type="text" id="numero" name="numero" value="<?=$dados['numero']?>">
			</div>

			<div class="mb-3">
				<label class="form-label" for="complemento">Complemento:</label>
				<input class="form-control" type="text" id="complemento" name="complemento" value="<?=$dados['complemento']?>">
			</div>

			<div class="mb-3">
				<label class="form-label" for="bairro">Bairro:</label>
				<input class="form-control" type="text" id="bairro" name="bairro" value="<?=$dados['bairro']?>">
			</div>

			<div class="mb-3">
				<label class="form-label" for="cidade">Cidade:</label>
				<input class="form-control" type="text" id="cidade" name="cidade" value="<?=$dados['cidade']?>">
			</div>

			<div class="mb-3">
				<label class="form-label" for="uf">UF:</label>
				<select class="form-select" name="uf" id="uf">
                    <option value="<?=$dados['uf']?>"><?=$dados['uf']?> - <?=$listaUF[$dados['uf']]?></option>
                    <?php foreach($listaUF as $UF => $descUF) { ?>
                        <option value="<?=$UF?>" required><?=$UF?> - <?=$descUF?></option>
                    <?php } ?>
                </select>
			</div>

			<div class="mb-3">
				<label class="form-label" for="codMunicipio">Código Município (IBGE):</label>
				<input class="form-control" type="number" id="codMunicipio" name="codMunicipio" min="1111111" max="9999999" step="1" value="<?=$dados['codMunicipio']?>">
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
			
			<a class="btn btn-secondary ms-5" href="generico.php"><i class="bi bi-pencil"> Voltar</i></a>

			<br class="mb-5">
			<br class="mb-5">
			<br class="mb-5">

		</form>
		
	</article>
</div>
<?php 
require_once "../inc/rodape-admin.php";
?>

</body>
</html>