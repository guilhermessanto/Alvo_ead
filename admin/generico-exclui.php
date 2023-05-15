<?php

    use Alvo\Generico;
    use Alvo\CtrAcesso;
    require_once "../vendor/autoload.php";

    $OBJctrAcesso = new CtrAcesso;
    $OBJctrAcesso->verificaAcessoAdmin();
    $OBJctrAcesso->verificaAcesso();

    $OBJgenerico = new Generico;
    $OBJgenerico->setId($_GET['id']);
    $OBJgenerico->excluirGenerico();

    header("location:generico.php");

?>