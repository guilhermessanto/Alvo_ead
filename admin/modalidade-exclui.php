<?php
    
    use Alvo\Modalidade;
    use Alvo\CtrAcesso;
    require_once "../vendor/autoload.php";

    $OBJctrAcesso = new CtrAcesso;
    $OBJctrAcesso->verificaAcessoAdmin();
    $OBJctrAcesso->verificaAcesso();

    $OBJmodalidade = new Modalidade;
    $OBJmodalidade->setId($_GET['id']);
    $OBJmodalidade->excluirModalidade();

    header("location:modalidade.php");

?>