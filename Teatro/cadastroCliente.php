<?php
session_start();
ob_start();
include_once "Modelo/login.class.php";
 ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/> -->
    <link href="node_modules/bulma/css/bulma.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/ajax/lib/ajax.js"></script>
    <!-- <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script> -->
  </head>
  <body>
    <section class="hero is-primary is-medium">

    <div class="hero-head">
      <nav class="navbar">
        <div class="container">
          <div class="navbar-brand">
             <a class="navbar-item">
              <!-- <img style="width: 200px;" src="logo.jpg" alt="Logo">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
               </button> -->
             </a>
             <span class="navbar-burger burger" data-target="navbarMenuHeroA">
                <span></span>
                <span></span>
                <span></span>
            </span>
          </div>
       <div class="navbar-menu" id="navbarMenuHeroA">
         <div class="navbar-end">
             <a class="navbar-item nav-link" href="index.php">
               Home
             </a>
             <a class="navbar-item nav-link" href="lista-cartaz.php">
               Em Cartaz
             </a>

             <?php
             if(isset($_SESSION['privateUser'])) {
               $login = unserialize($_SESSION['privateUser']);
               if($login->permissao == "adm"){
                 ?>
              <a class="navbar-item nav-link" href="lista-usuarios.php">
                Usuários
              </a>

              <?php
            }
          }
           ?>

         </span>
        </div>
      </div>
    </div>
  </nav>
</div>

<div class="hero-body">
    <div class="container has-text-centered">
      <h1 class="title">
        All Space
      </h1>
      <h2 class="subtitle">
        Teatro para tudo e todos!
      </h2>
    </div>
  </div>

  <div class="hero-foot">
    <nav class="tabs">
      <div class="container">
        <ul>
           <?php
           if(isset($_SESSION['privateUser'])) {
             $login = unserialize($_SESSION['privateUser']);
             if($login->permissao == "usuario"){
               ?>


           <li>
             <a class="nav-link is-active" href="cadastroCliente.php">Área do Cliente</a>
           </li>

           <?php
         }
       }
          ?>

          <?php
           if(isset($_SESSION['privateUser'])) {
             $login = unserialize($_SESSION['privateUser']);
             if($login->permissao == "adm"){
               ?>
               <li>
                 <a class="nav-link" href="cadastroCartaz.php">Cadastro de Título</a>
              </li>

           <?php
         }
       }
          ?>
        </ul>
      </div>
    </nav>
  </div>
</section>

    <?php
    if(!isset($_SESSION['privateUser'])) {
      echo "<h2>Ops! Acho que você tentou acessar uma página inexistente...";
      echo "</body>";
      echo "</html>";
      die();
    } else {
      $login = unserialize($_SESSION['privateUser']);
      if($login->permissao != "usuario") {
        echo "<h2>Sua permissão não é adequada para essa página";
        echo "</body>";
        echo "</html>";
        die();
      }
    }
    ?>

    <div class="tile is-vertical is-parent">
      <article class="title is-child notification is-success">
        <div class="content">
          <p class="title">
            Informações do Usuário
          </p>
            <div class="content">
              <form name="cadastro" method="post" action="controle.php">
                <div class="field">
                  <input type="text" name="nome" placeholder="Primeiro nome" required pattern="" autofocus class="input"required pattern="^[^0-9%$#@!¨*()]{2,50}$">
                </div>

                <div class="field">
                  <input type="email" name="email" placeholder="Digite seu email" required pattern="" class="input" required pattern="^[A-Za-z0-9@_\-\. ]{8,60}$">
                </div>

                <div class="field">
                  <input type="text" name="cpf" placeholder="Digite seu CPF" class="input" required pattern="^[0-9]{11,14}$">
                </div>

                <div class="field">
                  <input type="date" name="datadenascimento" class="input" required pattern="^[0-9]{10}$">
                </div>

                <div class="field">
                  <input type="text" name="endereco" placeholder="Digite seu endereço" class="input" required pattern="^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,150}$">
                </div>

                <div class="field">
                  <div class="control">
                    <button type="submit" name="cadastrar" class="button is-link is-light">Cadastrar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </article>
      </div>
    </div>
  </body>
</html>
