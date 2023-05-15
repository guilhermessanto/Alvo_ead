<?php
$pagina = "atualizar";

use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Modalidade;

$pagina = "Cursos";
 require_once "../inc/cabecalho-admin.php";
 $OBJctrAcesso = new CtrAcesso;
 $OBJctrAcesso->verificaAcessoInstr();

 $modalidade = new Modalidade;
 $listarModalidades = $modalidade -> listarModalidade();
 $curso = new Curso;
 $curso ->setId($_GET['id']);
 $umCurso = $curso -> listarUmCurso();

 if(isset($_POST['atualizar'])){
    $curso->setNomeCurso($_POST['nomeCurso']);
    $curso->setDescCurso($_POST['descricao']);
    $curso->setIndicador($_POST['indicador']);
    $curso->setModalidadeId($_POST['categoria']);
    $curso->setInstrutorId(1);

    if(empty($_FILES['imagem']['name'])){
        $curso->setImagem($_POST['imagem-existente']); 
    }else{
        $curso->upload($_FILES["imagem"]);
        $curso->setImagem($_FILES['imagem']["name"]);
    };
    $curso->atualizarCurso();
    header('location:../instro/curso.php');
 }
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar curso
		</h2>
				
		<form enctype="multipart/form-data" class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

            <div class="mb-3">
                <label class="form-label" for="categoria">Categoria:</label>
                <select class="form-select" name="categoria" id="categoria" required>
					<option value=""></option>
                    <?php foreach($listarModalidades as $modalidade){ ?>
					<option 
                    <?php
                    if($umCurso['modalidade_id'] === $modalidade['id'])  echo " selected ";?> 
                    value="<?=$modalidade['id']?>"><?= $modalidade['descModalidade']?>
                    </option>
					<?php } ?>
				</select>
			</div>

			<div class="mb-3">
                <label class="form-label" for="nomeCurso">Nome do curso:</label>
                <input class="form-control" required type="text" id="nomeCurso" name="nomeCurso"  value="<?=$umCurso['nomeCurso']?>">
			</div>

			<div class="mb-3">
                <label class="form-label" for="descricao">Descrição:</label>
                <textarea class="form-control" required name="descricao" id="descricao" cols="50" rows="6"><?=$umCurso['descCurso']?></textarea>
			</div>
            <label class="form-label" for="categoria">Status do Curso:</label>
                <select class="form-select" name="indicador" id="indicador" required>
                <option 
                <?php if ($umCurso['indicador'] == 0) echo "selected" ;?>
					 value="0">Ativo</option>
					<option <?php if ($umCurso['indicador'] == 1) echo "selected" ;?> value="1">Desativo</option>
				</select>

            <div class="mb-3">
                <label for="imagem-existente" class="form-label">Imagem do curso:</label>
                <!-- campo somente leitura, meramente informativo -->
                <input class="form-control" type="text" id="imagem-existente" name="imagem-existente" value="<?=$umCurso['imagem']?>" readonly>
            </div>

			<div class="mb-3">
                <label class="form-label" for="imagem" class="form-label">Selecione uma imagem:</label>
                <input  class="form-control" type="file" id="imagem" name="imagem"
                accept="image/png, image/jpeg, image/gif, image/svg+xml">
			</div>
		
			<button class="btn btn-primary" id="atualizar" name="atualizar"><i class="bi bi-save"></i> Atualizar</button>
            <a class="btn btn-secondary ms-5" href="curso.php"><i class="bi bi-pencil"> Voltar</i></a>

            <br class="mb-5">
			<br class="mb-5">
			<br class="mb-5">

		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

