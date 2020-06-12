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
    <title>Cadastro de Títulos</title>
    <!-- <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/> -->
    <link href="node_modules/bulma/css/bulma.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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
             <a class="nav-link" href="cadastroCliente.php">Área do Cliente</a>
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
                 <a class="nav-link is-active" href="cadastroCartaz.php">Cadastro de Título</a>
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
      if($login->permissao != "adm") {
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
            Informações da Obra
          </p>
            <div class="content">
              <form name="cadastroCartaz" method="post" action="controleCartaz.php">
                <div class="field">
                  <input type="text" name="titulo" placeholder="Digite o titulo da obra" required pattern="^[^!@#$%¨&()_]{2,50}$" autofocus class="input">
                </div>

                <div class="field">
                  <input type="text" name="estudio" placeholder="Digite o estudio/grupo de produção" required pattern="^[^!@#$%¨&()]{2,100}$"  class="input">
                </div>

                <div class="field">
                  <input type="text" name="diretor" placeholder="Digite o nome do diretor da obra" required pattern="^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,50}$"  class="input">
                </div>

                <div class="field">
                  <input type="text" name="estrela" placeholder="Digite o nome da estrela da peça" required pattern="^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,50}$"  class="input">
                </div>

                <div class="field">
                  <input type="text" name="elenco" placeholder="Digite os nomes principais do elenco" required pattern="^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,200}$"  class="input">
                </div>

                <div class="field">
                  <input type="text" name="duracao" placeholder="Digite a duração do filme(Em minutos)" required pattern="^[0-9, ]{1,3}$"  class="input">
                </div>

                <div class="field">
                  <input type="text" name="descricao" placeholder="Descrição da obra" required pattern="^[^0-9!@#$%¨&*()^]{2,100}$"  class="input">
                </div>

                <div class="field is-grouped">
                  <div class="control">
                  <button type="submit" name="cadastrarCartaz" class="button is-link is-light">Cadastrar Obra</button>
                </div>
              </form>
            </div>
          </div>
        </article>
      </div>
    </div>
  </body>
</html>
