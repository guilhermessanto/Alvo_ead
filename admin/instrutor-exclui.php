<?php

    use Alvo\Instrutor;
    use Alvo\CtrAcesso;
    require_once "../vendor/autoload.php";

    $OBJctrAcesso = new CtrAcesso;
    $OBJctrAcesso->verificaAcessoAdmin();
    $OBJctrAcesso->verificaAcesso();

    $instrutor = new Instrutor;
    $instrutor->setId($_GET['id']);
    $instrutor->excluirInstrutor();

    header("location:instrutor.php");

?>