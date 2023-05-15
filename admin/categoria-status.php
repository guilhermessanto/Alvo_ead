<?php

    use Alvo\Categoria;
    use Alvo\CtrAcesso;
    require_once "../vendor/autoload.php";

    $OBJctrAcesso = new CtrAcesso;
    $OBJctrAcesso->verificaAcessoAdmin();
    $OBJctrAcesso->verificaAcesso();
   
    $OBJcategoria = new Categoria;
    $OBJcategoria->setId($_GET['id']);
    $OBJcategoria->setIndicador($_GET['indicador']);

    $OBJcategoria->alteraIndicador();
    header("location:categoria.php");

?>