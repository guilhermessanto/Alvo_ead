<?php

$pagina = "Inserir Curso";

use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Instrutor;
use Alvo\Modalidade;
use Alvo\Utilitarios;

require_once "../inc/cabecalho-admin.php";
$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoInstr();


$modalidade = new Modalidade;
$listarModalidades = $modalidade -> listarModalidade();

$OBJinstro = new Instrutor;

$listaDeInstrutores = $OBJinstro -> listarInstrutores();
foreach($listaDeInstrutores as $instrutor){

	if($instrutor['ctrAcesso_id'] == $_SESSION['id'] ){
		$_SESSION['id_tabRel'] = $instrutor['id'];
	}
};



if(isset($_POST['inserir'])){
    $curso = new Curso;
	/* $curso ->setId($_POST['id']); */
    $curso->setNomeCurso($_POST['nomeCurso']);
    $curso->setDescCurso($_POST['descricao']);
    $curso->setIndicador(0);
    $curso->setModalidadeId($_POST['categoria']);

    $curso->setInstrutorId($_SESSION['id_tabRel']);

    $imagem = $_FILES["imagem"];
    $curso->upload($imagem);
    $curso->setImagem($imagem['name']);

    $curso->inserirCurso();
	header('location:../instro/curso.php');
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Inserir novo curso
		</h2>
				
		<form enctype="multipart/form-data" class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

            <div class="mb-3">
                <label class="form-label" for="categoria">Modalidade:</label>
                <select class="form-select" name="categoria" id="categoria" required>
					<option value=""></option>
				<?php foreach($listarModalidades as $modalidade){ 
					if ( $modalidade['indicador'] == 1 ) { continue; }
					?>
					<option value="<?=$modalidade['id']?>"><?=$modalidade['descModalidade']?></option>
					<?php } ?>
				</select>
			</div>

			<div class="mb-3">
                <label class="form-label" for="nomeCurso">Nome do curso:</label>
                <input class="form-control" required type="text" id="nomeCurso" name="nomeCurso" >
			</div>

			<div class="mb-3">
                <label class="form-label" for="descricao">Descrição:</label>
                <textarea class="form-control" required name="descricao" id="descricao" cols="50" rows="6"></textarea>
			</div>

			<div class="mb-3">
                <label class="form-label" for="imagem" class="form-label">Selecione uma imagem:</label>
                <input required class="form-control" type="file" id="imagem" name="imagem"
                accept="image/png, image/jpeg, image/gif, image/svg+xml">
			</div>

			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
			
			<br class="mb-5">
			<br class="mb-5">
			<br class="mb-5">
			
		</form>
		
	</article>
</div>
	

<?php 
require_once "../inc/rodape-admin.php";
?>