<?php
$pagina = "Cursos";
include_once "inc/cabecalho.php";
?>
 <!--__________________________________________________________________________________________  -->
        <!-- Links dos ícones (Área de vantagens) -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">

  <symbol id="people-circle" viewBox="0 0 16 16">
    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
  </symbol>
 
  <symbol id="collection" viewBox="0 0 16 16">
    <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z"/>
  </symbol>

  <symbol id="toggles2" viewBox="0 0 16 16">
    <path d="M9.465 10H12a2 2 0 1 1 0 4H9.465c.34-.588.535-1.271.535-2 0-.729-.195-1.412-.535-2z"/>
    <path d="M6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm.535-10a3.975 3.975 0 0 1-.409-1H4a1 1 0 0 1 0-2h2.126c.091-.355.23-.69.41-1H4a2 2 0 1 0 0 4h2.535z"/>
    <path d="M14 4a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"/>
  </symbol>

  <symbol id="chevron-right" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
  </symbol>

</svg>

 <!--__________________________________________________________________________________________  -->
        <!-- área de destaque -->

        <section id="motion">
            <div class="destaqueTexto">
                    <h2><span style="color: #000;">Aprendizagem<br></span><span style="color: blue;">Online</span></h2>
                    <form action="login.php"><input type="submit" name="enviar" id="enviar1" value="Acessar" ></form>
            </div>
        </section>
 <!--__________________________________________________________________________________________  -->
        <!-- área de vantagens -->

    <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom text-center">Vantagens da Alvo</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">

              <div class="feature col text-center">
                <div class="icone feature-icon d-inline-flex align-items-center justify-content-center text-bg-warning bg-gradient fs-2 mb-3">
                  <svg class="bi" width="4rem" height="4rem"><use xlink:href="#collection"/></svg>
                </div>
                <h3 class="fs-2">Acesso 24h</h3>
                <p>Acesse a plataforma no local e horário mais convenientes para você!!</p>
                <a href="cadastro.php" class="icon-link d-inline-flex align-items-center">
                  Conheça
                  <svg class="bi" width="1rem" height="1rem"><use xlink:href="#chevron-right"/></svg>
                </a>
              </div>

              <div class="feature col text-center">
                <div class="icone feature-icon d-inline-flex align-items-center justify-content-center text-bg-warning bg-gradient fs-2 mb-3">
                  <svg class="bi" width="4rem" height="4rem"><use xlink:href="#people-circle"/></svg>
                </div>
                <h3 class="fs-2">Login vitalício</h3>
                <p>Adquira o treinamento e tenha acesso vitalício que contempla atualizações sem custo adicional.</p>
                <a href="cadastro.php" class="icon-link d-inline-flex align-items-center">
                Conheça
                  <svg class="bi" width="1rem" height="1rem"><use xlink:href="#chevron-right"/></svg>
                </a>
              </div>

              <div class="feature col text-center">
                <div class="icone feature-icon d-inline-flex align-items-center justify-content-center text-bg-warning bg-gradient fs-2 mb-3">
                  <svg class="bi" width="4rem" height="4rem"><use xlink:href="#toggles2"/></svg>
                </div>
                <h3 class="fs-2">Mude de nível</h3>
                <p>Continue a crescer profissionalmente fazendo novos cursos e tenha sucesso profissional!!</p>
                <a href="cadastro.php" class="icon-link d-inline-flex align-items-center">
                Conheça
                  <svg class="bi" width="1rem" height="1rem"><use xlink:href="#chevron-right"/></svg>
                </a>
              </div>

          </div>
      </div>

<!-- __________________________________________________________________________________________ 
      Secção cursos -->
  <section class="row d-flex justify-content-evenly ajusfigura">

      <div class="card text-center card col-3 mb-5 ajusRaio" style="width: 18rem;">
        <img src="assets/solidworks.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Solidworks</h5>
          <p class="card-text">Aprenda do básico ao avançado e explore todo potencial da modelagem em 3D</p>
          <a href="cadastro.php" class="btn btn-primary">Comprar agora</a>
        </div>
      </div>

      <div class="card text-center card col-3 mb-5 ajusRaio" style="width: 18rem;">
        <img src="assets/autocad.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">AutoCad</h5>
          <p class="card-text">Domine o AutoCad, faça projetos incríveis em 2D em qualquer área de projeto.</p>
          <a href="cadastro.php" class="btn btn-primary">Comprar agora</a>
        </div>
      </div>

      <div class="card text-center card col-3 mb-5 ajusRaio" style="width: 18rem;">
        <img src="assets/excelbasico.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Excel básico</h5>
          <p class="card-text">Inicie sua jornada utilizando a ferramenta de controle mais utilizada no mundo!</p>
          <a href="cadastro.php" class="btn btn-primary">Comprar agora</a>
        </div>
      </div>

      <div class="card text-center card col-3 mb-5 ajusRaio" style="width: 18rem;">
        <img src="assets/excelavancado.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Excel avançado</h5>
          <p class="card-text">Avance e descubra uma novo patamar de utilização avançada do Microsoft Excel!</p>
          <a href="cadastro.php" class="btn btn-primary">Comprar agora</a>
        </div>
      </div>

  </section>

<?php
include_once "inc/footer.php";
?>