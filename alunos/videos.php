<?php

use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Utilitarios;
use Alvo\Video;

$pagina = "Aulas";
require_once "../inc/cabecalho-user.php";
/* $OBJctrAcesso = new CtrAcesso; */
// $OBJctrAcesso->verificaAcessoAluno();

?>

<main class="vContainer">
    <div class="gridContainer">
      <section class=" bg-white ">
    
      <?php include_once "../instro/acordeon.php";
        $video = new Video;
        $video->setId($_GET['videoId']);
        $umVideo = $video-> listarUmVideo();
        /* Utilitarios::dump($umVideo); */
      ?>
        
      </section >
      
      <section class="videoGrid">
  
        <div class="ratio ratio-16x9 video">
        <iframe class="largura" src="https://www.youtube-nocookie.com/embed/<?=$umVideo['link']?>?modestbranding=1&showinfo=0&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay;  gyroscope; picture-in-picture" allowfullscreen ></iframe>
        </div>
     
      </section>
    </div>
</main>


 <?php 
 require_once "../inc/rodape-admin.php"
 ?>