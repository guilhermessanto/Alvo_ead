<?php
use Alvo\Generico;
use Alvo\Utilitarios;
use Alvo\Nivel;
use Alvo\CtrAcesso;

$pagina = "Favorecido (Habilita)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJgenerico = new Generico;
$OBJgenerico->setId($_GET['id']);
$dados = $OBJgenerico->listarUmGenerico();

$OBJnivel = new Nivel;
$listaDeNiveis = $OBJnivel->listarNiveis();


// Utilitarios::dump($dados);


if( isset ($_POST['atualizar'])) {

	$OBJctrAcesso->setIndicador($_POST['indicador']);
	$generico_id = $dados['id'];
	$OBJctrAcesso->setGenericoId($generico_id);
	$OBJctrAcesso->setNivelId($_POST['nivel_id']);

	$OBJctrAcesso->setSenha( $OBJctrAcesso->codificaSenha($_POST['senha']) );

	$OBJctrAcesso->habilitaCtrAcesso();
	header("location:generico.php");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Habilita Favorecido
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

            <div class="mb-3">
				<label class="form-label" for="text">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$dados['nome']?>" readonly>
			</div>

			<div class="mb-3">
				<label class="form-label" for="text">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?=$dados['email']?>" readonly>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Insira uma Senha">
			</div>

            <div class="mb-3">
				<label class="form-label" for="indicador">Status de Controle:</label>
                <select class="form-select" name="indicador" id="indicador" required>
                    <option value=""></option>
                    <option value="0">Ativo</option>
                    <option value="1">Desativado</option>
                </select>
			</div>

			<div class="mb-3">
				<label class="form-label" for="nivel_id">Nível:</label>
                <select class="form-select" name="nivel_id" id="nivel_id" required>
                    <option value=""></option>
                    <?php foreach($listaDeNiveis as $nivel) { 
						if ( $nivel['indicador'] == 1 ) { continue; }
						?>
                        <option id="nivel_id" name="nivel_id" value="<?=$nivel['id']?>" required><?=$nivel['descNivel']?></option>
                    <?php } ?>
                </select>
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