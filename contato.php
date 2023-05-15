<?php
$pagina = "Contato";
include_once "inc/cabecalho.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
?>
<div class="container-fluid" style="background-color: #d9d9d990;">

<section class="container"> 
    <main id="conteudo">

            <article class="geral">
                <section class="explicacao text-center mt-5">
                    <h2 >Contato</h2>
                    <p>Preencha o formulário abaixo para entrar em contato conosco.</p>
                    <p>Se preferir, utilize o telefone: <b>(11)-99999-8888</b> ou o e-mail: <b>contatoAlvo@gmail.com</b></p>
                </section>

           

<form action="" method="post" id="form-contato" name="form-contato" class="row g-3">

<div class="container px-5 text-left">
  <div class="row gx-5">

    <div class="col">
    <label for="name" class="form-label mt-5">Nome</label>
    <input class="form-control" type="nome" id="name" name="nome" class="form-control" placeholder="Escreva seu nome" aria-label="First name">

    <div class="col">
    <label for="email" class="form-label  mt-3">Email</label>
    <input class="form-control" type="email" id="email" name="email" placeholder="Insira seu melhor e-mail" id="inputEmail4">
    </div>

    <div>
    <label for="tipo" name="tipo" class="form-label  mt-3">Assunto</label>
    <select id="tipo" name="tipo" class="form-select">
      <option selected></option>
      <option>Dúvidas</option>
      <option>Reclamações</option>
      <option>Elogios</option>
      <option>Parcerias</option>
    </select>
    </div>

    <div>
    <label for="mensagem" name="mensagem" id="mensagem" class="form-label  mt-3 ">Insira sua Mensagem</label>
  <div class="form-floating col-md-12">
  <textarea class="form-control" name="mensagem"  id="mensagem" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Mensagem</label>
</div>
    </div>

  </div>
</div>

  <div class="col-12  mt-3 mb-5">
    <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
  </div> 



</form>
</main>


<!-- Mapa -->
    <h2>Localização, Visite-nos!</h2>
        <div id="mapa" class="mb-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3658.1761016747014!2d-46.542480384428444!3d-23.5261677661801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce5e46752d26e5%3A0xfd7d34baaa261c06!2sR.%20Francisco%20Coimbra%2C%20403%20-%20Penha%20de%20Fran%C3%A7a%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2003639-000!5e0!3m2!1spt-BR!2sbr!4v1644416750402!5m2!1spt-BR!2sbr" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        <!-- para tornar o mapa expansivo alterado o width p/ 100% -->
        </div>
</section>



<?php 
if(isset($_POST['enviar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];
    $mensagem = $_POST['mensagem'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8";
   // $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
try {  
    $mail->isSMTP();
    $mail->Host = 'smtp.titan.email';
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls'; 
    $mail->Username = 'admin@alvoead.com.br';
    $mail->Password = 'Alvoead';

        //Quem envia
        $mail->setFrom('admin@alvoead.com.br', 'Alvoead');
        
        // Quem recebe
        $mail->addAddress('contato@alvoead.com.br', 'Alvoead');


        // Para quem responder
        $mail->addReplyTo($email, 'Retorno do contato');

        //Content
        $mail->isHTML(true);                                  
        
        //Set email format to HTML
        $mail->Subject = "Contato Site";
        
        // Corpo da mensagem em formato HTML
        $mail->Body = "<b>Nome:</b> $nome <br> 
        <b>E-mail:</b> $email <br>
    <b>Assunto da mensagem:</b> $tipo <br>
<b>Mensagem:</b> $mensagem";
        
        // Corpo da mensagem em formato texto puro
        $mail->AltBody = "Nome: $nome \n E-mail: $email \n Tipo: $tipo \n Mensagem: $mensagem";

         $mail->send();
       // echo 'Mensagem foi enviada com sucesso!';
    ?>

    <script>
        alert ("Dados enviados com sucesso");
         window.location="index.php";
    </script>


<?php 
    } catch (Exception $e) {
?>
       <script>
        alert ("Erro no preenchimento do formulário, confira se todos os campos foram preenchidos corretamente");
         window.location="contato.php";
    </script>
 <?php   
    }
} // final do if enviar
?>




</div>
<?php
include_once "inc/footer.php";
?>