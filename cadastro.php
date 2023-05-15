<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';



// if(isset($_POST['criar'])){
//     $nome = $_POST['nome'];
//     $email = $_POST['email'];

//     //Create an instance; passing `true` enables exceptions
//     $mail = new PHPMailer(true);
//     $mail->CharSet = "UTF-8";
//     $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
// try {  
//     $mail->isSMTP();
//     $mail->Host = 'smtp.titan.email';
//     $mail->SMTPAuth = true;
//     $mail->Port = 587;
//     $mail->SMTPSecure = 'tls'; 
//     $mail->Username = 'admin@alvoead.com.br';
//     $mail->Password = 'Alvoead';

//         //Quem envia
//         $mail->setFrom('admin@alvoead.com.br', 'Alvoead');
        
//         // Quem recebe
//         $mail->addAddress('contato@alvoead.com.br', 'Alvoead');


//         // Para quem responder
//         $mail->addReplyTo($email, 'Retorno do contato');

//         //Content
//         $mail->isHTML(true);                                  
        
//         //Set email format to HTML
//         $mail->Subject = "Contato Site";
        
//         // Corpo da mensagem em formato HTML
//         $mail->Body = "<b>Nome:</b> $nome <br> 
//         <b>E-mail:</b> $email";
        
//         // Corpo da mensagem em formato texto puro
//         $mail->AltBody = "Nome: $nome \n E-mail: $email";

//          $mail->send();
//         echo 'Mensagem foi enviada com sucesso!';
//     } catch (Exception $e) {
//         echo "Ops! Deu ruim: {$mail->ErrorInfo}";
//     }
// } // final do if enviar
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Alvo</title>
    <!-- Favicon -->
  <link rel="shortcut icon" href="assets/alvo_favicon.ico" type="image/x-icon">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="js/bootstrap.min.css">
  <link rel="stylesheet" href="js/all.min.css">
  <!-- CSS Proprio -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="container-fluid d-flex flex-column h-100">
<div class="row">

<div class="bg-geral col-12 col-md-4 py-4 vh-100">

<div class="d-flex justify-content-center mt-2 pt-5 pb-5">

<a href="index.php">
    <img src="assets/logo-alvo-figma.png" alt="">
</a>

</div>
        
    <main class="pt-3 mt-2">     
    <h2 class="text-center fw-light text-light mb-4">Seja um instrutor - Cadastre-se</h2>
        <div class="text-white mt-4 text-center">
            <p>Está página é o meio campo entre você e o curso em que deseja postar na alvo, insira os dados abaixos para entrarmos em contato para mais informações!</p>
        </div>

        <form action="" method="post" id="form-cadstro" name="form-cadastro" class="w-75 container-fluid">

        <?php if(isset($feedback)){?>
				<p class="my-2 alert alert-warning text-center">
					<?= $feedback?>
				</p>
                <?php } ?>
          

                <div class="mb-3">
					<label for="name" class="form-label text-light">Nome:</label>
					<input class="form-control" type="name" id="name" name="nome" placeholder="Insira seu nome">
				</div>

				<div class="mb-3">
					<label for="email" class="form-label text-light">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email" placeholder="Insira seu E-mail">
				</div>

				<!-- <button class="btn botaoPrimario btn-lg w-100 mt-2" name="criar" type="submit">Seja aluno!</button> -->
				<button class="btn btn-warning btn-lg w-100 mt-2" name="criar" type="submit">Seja um Instrutor!</button>

             

                <div class="d-flex">
                <p class="text-center p-2">
                    <a href="login.php" class="text-light">Login</a>
                </p> 

                <p class="text-center p-2">
                    <a href="index.php" class="text-light">Voltar a home</a>
                </p>

                </div>

			</form> 
    </main> 
</div>

<?php 
if(isset($_POST['criar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];

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
        <b>E-mail:</b> $email";
        
        // Corpo da mensagem em formato texto puro
        $mail->AltBody = "Nome: $nome \n E-mail: $email";

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
         window.location="cadastro.php";
    </script>
 <?php   
    }
} // final do if enviar
?>



<?php 
//     } catch (Exception $e) {
//         echo "Ops! Deu ruim: {$mail->ErrorInfo}";
//     }
// } // final do if enviar
?>


<section class="mx-auto imagemLogin col-6 bg-white d-md-block align-self-center">
        <div class="d-flex justify-content-center pt-5 mt-5">
            <img src="assets/ilustracaocadastro.png" class="img-fluid" alt="" srcset="">
        </div>
</section>



<!-- <section class="imagemLogin col-8">
        <div>
            <img src="computer-login-pana.svg" alt="" srcset="">
        </div>
</section> -->


<!--     
    <section>
        <div>
            <img src="/Módulo 2 (Back-End)/Protótipo (Versão 7)/assets/homem-estudando.png" alt="">
        </div>
    </section>
-->
</div>        
</body>
</html>