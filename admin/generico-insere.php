<?php
ob_start();
use Alvo\Generico;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Favorecido (Insere)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$listaUF = Utilitarios::listaUF();
$listaTipoFavorecido = Utilitarios::tipoFavorecido();

$OBJgenerico = new Generico;
$listaDeGenerico = $OBJgenerico->listarGenerico();

// Mensagens de Erro 'msgErro'
if( isset($_GET['cnpj_divergente'])) {
	$msgErro = 'Cadastro CNPJ deve ter 14 Numéricos<i class="bi bi-x-circle"></i>';
} elseif ( isset($_GET['cpf_divergente']) ) {
	$msgErro = 'Cadastro CPF deve ter 11 Numéricos<i class="bi bi-x-circle"></i>';
} elseif ( isset($_GET['email_cadastradado']) ) {
	$msgErro = 'E-mail já Cadastrado em outro Favorecido<i class="bi bi-x-circle"></i>';
} elseif ( isset($_GET['cnpjcpf_cadastradado']) ) {
	$msgErro = 'CNPJ/CPF já Cadastrado<i class="bi bi-x-circle"></i>';
} elseif( isset($_GET['cnpj_invalido'])) {
	$msgErro = 'CNPJ Inválido (Divergência Dígito Verificador)<i class="bi bi-x-circle"></i>';
} elseif( isset($_GET['cpf_invalido'])) {
	$msgErro = 'CPF Inválido (Divergência Dígito Verificador)<i class="bi bi-x-circle"></i>';
}



?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Inserir novo Favorecido
		</h2>   

		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

            <?php if( isset($msgErro) ){?>
                <p class="my-2 alert alert-warning text-center"><?= $msgErro?></p>
            <?php } ?>

			<div class="mb-3">
				<label class="form-label" for="tipoFavorecido">Tipo Favorecido:</label>

				<select class="form-select" name="tipoFavorecido" id="tipoFavorecido">
                    <option value=""></option>
                    <?php foreach($listaTipoFavorecido as $tipoFavorecido => $descTF) { ?>
                        <option id="tipoFavorecido" name="tipoFavorecido" value="<?=$tipoFavorecido?>" required><?=$tipoFavorecido?> - <?=$descTF?></option>
                    <?php } ?>
                </select>

			</div>

			<div class="mb-3">
				<label class="form-label" for="cnpjcpf">CNPJ/CPF:</label>
				<input class="form-control" type="text" id="cnpjcpf" name="cnpjcpf" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" required>
			</div>
			
            <div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="telefone">Telefone:</label>
				<input class="form-control" type="text" id="telefone" name="telefone" placeholder="Digite apenas números, incluindo o DDD">
			</div>

			<div class="mb-3">
				<label class="form-label" for="cep">CEP:</label>
				<input class="form-control" type="text" id="cep" name="cep" maxlength="9" required>
				<b id="status"></b>
			</div>

			<div class="mb-3">
				<label class="form-label" for="endereco">Endereço:</label>
				<input class="form-control" type="text" id="endereco" name="endereco">
			</div>

			<div class="mb-3">
				<label class="form-label" for="numero">Número:</label>
				<input class="form-control" type="text" id="numero" name="numero">
			</div>

			<div class="mb-3">
				<label class="form-label" for="complemento">Complemento:</label>
				<input class="form-control" type="text" id="complemento" name="complemento">
			</div>

			<div class="mb-3">
				<label class="form-label" for="bairro">Bairro:</label>
				<input class="form-control" type="text" id="bairro" name="bairro">
			</div>

			<div class="mb-3">
				<label class="form-label" for="cidade">Cidade:</label>
				<input class="form-control" type="text" id="cidade" name="cidade">
			</div>

			<div class="mb-3">
				<label class="form-label" for="uf">UF:</label>
				<select class="form-select" type="text" name="uf" id="uf" required>
                    <option value=""></option>
                    <?php foreach($listaUF as $UF => $descUF) { ?>
                        <option value="<?=$UF?>" required><?=$UF?> - <?=$descUF?></option>
                    <?php } ?>
                </select>
			</div>

			<div class="mb-3">
				<label class="form-label" for="codMunicipio">Código Município (IBGE):</label>
				<input class="form-control" type="number" id="codMunicipio" name="codMunicipio" min="1111111" max="9999999" step="1">
			</div>

			<button class="btn btn-primary" type="submit" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
            <a class="btn btn-secondary ms-5" href="generico.php"><i class="bi bi-pencil"> Voltar</i></a>

            <br class="mb-5">
			<br class="mb-5">
            <br class="mb-5">
			
		</form>
	</article>

    <?php
    // Inserir - Atualiza cadastro
    if ( isset ($_POST['inserir'])) {
        
        $OBJgenerico->setTipoFavorecido($_POST['tipoFavorecido']);
        $OBJgenerico->setCnpjcpf($_POST['cnpjcpf']);
        $OBJgenerico->setNome($_POST['nome']);
        $OBJgenerico->setEmail($_POST['email']);
        $OBJgenerico->setTelefone($_POST['telefone']);
        $OBJgenerico->setCep($_POST['cep']);
        $OBJgenerico->setEndereco($_POST['endereco']);
        $OBJgenerico->setNumero($_POST['numero']);
        $OBJgenerico->setComplemento($_POST['complemento']);
        $OBJgenerico->setBairro($_POST['bairro']);
        $OBJgenerico->setCidade($_POST['cidade']);
        $OBJgenerico->setUf($_POST['uf']);
        $OBJgenerico->setCodMunicipio($_POST['codMunicipio']);
    
        // Consistência
        $cnpj_cpf = preg_replace("/\D/", '', $_POST['cnpjcpf']);
        $existEmail = 0;
        $existCnpjCpf = 0;
        foreach ( $listaDeGenerico AS $chkGenerico ) {
            $chkEmail = $chkGenerico['email'];
            $chkCnpjCpf = $chkGenerico['cnpjcpf'];
            if ( $_POST['email'] == $chkEmail ) { 
                $existEmail = 1;
                break; 
            }
            if ( $cnpj_cpf == $chkCnpjCpf ) { 
                $existCnpjCpf = 1;
                break; 
            }
        }


        // Mensagem de Erro/Retorno
        if( ($_POST['tipoFavorecido'] == "1") &&  ( strlen($cnpj_cpf) != 14) ) {
            header("location:generico-insere.php?cnpj_divergente");     
        } elseif ( ($_POST['tipoFavorecido'] == "2") && (strlen($cnpj_cpf) != 11) ) {
            header("location:generico-insere.php?cpf_divergente");
        } elseif ( $existEmail == 1) {
            header("location:generico-insere.php?email_cadastradado");
        } elseif ( $existCnpjCpf == 1) {
            header("location:generico-insere.php?cnpjcpf_cadastradado");
        } elseif ( ($_POST['tipoFavorecido'] == "2") && (strlen($cnpj_cpf) == 11) && ( Utilitarios::valida_cpf( $cnpj_cpf ) === false ) ) {
            header("location:generico-insere.php?cpf_invalido");
        } elseif ( ($_POST['tipoFavorecido'] == "1") && (strlen($cnpj_cpf) == 14) && ( Utilitarios::valida_cnpj( $cnpj_cpf ) === false ) ) {
            header("location:generico-insere.php?cnpj_invalido");
        } else {
            $OBJgenerico->inserirGenerico();
            header("location:generico.php");
        }

    }
    ?>
    
</div>
<?php 
require_once "../inc/rodape-admin.php";
?>


 <!--___________________________________________________________________________________________ -->

    <!-- Vanilla Masker para o formulário (Plugin para validação do formulário)-->
    <script src="plugins/vanilla-masker.min.js"></script>

    <script>
        // Corrige o CEP
        VMasker(document.querySelector("#cep")).maskPattern("99999-999");

        // Corrige o Telefone e o CPF/CNPJ
        function inputHandler(masks, max, event) {
            var c = event.target;
            var v = c.value.replace(/\D/g, '');
            var m = c.value.length > max ? 1 : 0;
            VMasker(c).unMask();
            VMasker(c).maskPattern(masks[m]);
            c.value = VMasker.toPattern(v, masks[m]);
            }

            var telMask = ['(99) 9999-99999', '(99) 99999-9999'];
            var tel = document.querySelector('#telefone');
            VMasker(tel).maskPattern(telMask[0]);
            tel.addEventListener('input', inputHandler.bind(undefined, telMask, 14), false);

            var docMask = ['999.999.999-999', '99.999.999/9999-99'];
            var doc = document.querySelector('#cnpjcpf');
            VMasker(doc).maskPattern(docMask[0]);
            doc.addEventListener('input', inputHandler.bind(undefined, docMask, 14), false);
    </script>
<!-- ___________________________________________________________________________________________ -->
   

<!-- Utilizando Webservice VIACEP para preencher o formulário com o CEP -->
<!-- Como foi baixada faz-se a referência abaixo da biblioteca -->
<script src="plugins/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#endereco").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#codMunicipio").val("");
        }
        
        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#endereco").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#codMunicipio").val("...");
                    $("#status").text("CEP encontrado").css('color', 'black');

                    

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf); // value
                            $("#codMunicipio").val(dados.ibge);
                            $("#status").text(" ").css('color', 'black');
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            $("#status").text("CEP não encontrado.").css('color', 'red');
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    $("#status").text("Formato de CEP inválido.").css('color', 'red');
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });
</script>





</body>
</html>
<?php ob_end_flush(); ?>