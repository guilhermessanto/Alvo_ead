<?php

use Alvo\CtrAcesso;
use Alvo\Curso;
require "../vendor/autoload.php";
$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoInstr();

$curso = new Curso;
$curso->setId($_GET['id']);
$curso->excluirCurso();
header('location:../instro/curso.php');