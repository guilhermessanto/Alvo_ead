<?php

use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Video;

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAluno();
$cursoId = $_GET['cursoId'] ?? null;

$curso =  new Curso;
$curso -> setId($cursoId);
$umCurso = $curso -> listarUmCurso();

$video = new Video;
$video ->setCursoId($cursoId);
$videos = $video -> listarVideo();
$idVideo = $_GET['videoId']  ?? null;


?>

<div class="accordion">
    <div class="accordion-item">
      <a href="#" class=" align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom ">
        <span class="fs-5 fw-semibold"><?=$umCurso['nomeCurso']?></span>
      </a>
      <ul class="list-group list-group-flush border-bottom scrollarea  barraLateral">
        <?php foreach($videos as $video ){ ?>
        <li>
            <a href="videos.php?cursoId=<?=$cursoId?>&videoId=<?=$video['id']?>" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
              <div class=" w-100 align-items-center justify-content-between">
                <strong class="mb-1"><?=$video['nomeVideo']?></strong>
              </div>

            </a>
        </li>
        
        <?php } ?>
      </ul>
          
    </div>
  </div>