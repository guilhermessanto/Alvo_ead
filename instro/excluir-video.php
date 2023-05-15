<?php

use Alvo\CtrAcesso;
use Alvo\Video;

require_once "../vendor/autoload.php";
$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoInstr();
$cursoId = $_GET['cursoId'] ?? null;
$video = new Video;
$video ->setId($_GET['videoId']);
$video ->excluirVideo();
header('location:../instro/video.php?cursoId='.$cursoId);