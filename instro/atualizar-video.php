<?php

use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Utilitarios;
use Alvo\Video;

$pagina = "Atualizar Video";

require_once "../inc/cabecalho-admin.php";
$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoInstr();

$cursoId = $_GET['cursoId'] ?? null;

$curso = new Curso;
$curso ->setId($cursoId);
$umCurso = $curso -> listarUmCurso();

$video = new Video;
$video ->setId($_GET['videoId']);
$umVideo = $video -> listarUmVideo();


if(isset($_POST['inserir'])){
	$video->setNomeVideo($_POST['nomeVideo']);
	$video->setLink($_POST['link']);
	$video->setDescricao($_POST['descricao']);
	$video->setCursoId($_POST['curso']);
    $video->atualizarVideo();
    header('location:../instro/video.php?cursoId='.$cursoId);

}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Inserir video
		</h2>
				
		<form enctype="multipart/form-data" class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

            <div class="mb-3">
                <label class="form-label" for="categoria">Nome do Curso:</label>
                <select class="form-select" name="curso" id="curso" required>
					<option value="<?=$umCurso['id']?>"><?=$umCurso['nomeCurso']?></option>
				</select>
			</div>

			<div class="mb-3">
                <label class="form-label" for="nomeVideo">Título video:</label>
                <input class="form-control" required type="text" id="nomeVideo" name="nomeVideo"  value="<?=$umVideo['nomeVideo']?>">
			</div>
			<div class="mb-3">
                <label class="form-label" for="link">link do Video:</label>
                <input class="form-control" required type="text" id="link" name="link" value="<?=$umVideo['link']?>">
			</div>
			

			<div class="mb-3">
                <label class="form-label" for="descricao">Descrição:</label>
                <textarea class="form-control" required name="descricao" id="descricao" cols="50" rows="6"><?=$umVideo['descricao']?></textarea>
			</div>


			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>