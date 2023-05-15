<?php

    use Alvo\Nivel;
    use Alvo\CtrAcesso;
    require_once "../vendor/autoload.php";

    $OBJctrAcesso = new CtrAcesso;
    $OBJctrAcesso->verificaAcessoAdmin();
    $OBJctrAcesso->verificaAcesso();

    $OBJnivel = new Nivel;
    $OBJnivel->setId($_GET['id']);
    $OBJnivel->setIndicador($_GET['indicador']);

    $OBJnivel->alteraIndicador();
    header("location:nivel.php");

?>