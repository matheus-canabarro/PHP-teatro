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
    <title>Home</title>
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
             <a class="navbar-item is-active nav-link" href="index.php">
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

    <!-- <div class="columns">
      <div class="column is-half is-offset-one-quarter">is-three-quarters</div>
      <div class="column">Auto</div>
      <div class="column">Auto</div>
      </div>
    </div> -->

    <?php
    if(isset($_SESSION['privateUser'])) {
      include_once "Modelo/login.class.php";
      $login = unserialize($_SESSION['privateUser']);
      echo "<div class='tile is-parent'>
              <article class='tile is-child notification is-primary'>
                  <h1>
                    O que é a <strong>All Space</strong>?
                  </h1>
                </article>
            </div>
            <div class='tile is-parent'>
              <article class='tile is-child notification is-warning'>
            <div class='field has-addons'>
              <p class='control'>
                <strong>All Space é a promessa do Teatro que todas as pessoas precisam</strong><br>
                O Teatro atual permanece morrendo dia após dia, com a crescente dos cinemas<br>
                o teatro cada vez mais remete apenas a um ambiente para pessoas datadas<br>
                e céticas demais, como um lugar chato e desmotivante onde apenas os jovens<br>
                que ali se encontram procuram lutar contra sua timidez...<br><br>
                Nós da All Space não aceitamos esse preconceito, essa imagem estranha<br>
                que foi construido sobre o grande nome histórico que é o Teatro<br>
                e para mudarmos isso, começamos com uma abordagem moderna<br>
                e bem a cara do século XXI...<br><br>
                <strong>UM SITE!</strong><BR>
                </p>
                  </article>
                  </div>
                </div>
                <div class='tile is-parent'>
                  <article class='tile is-child notification is-success'>
                    <div class='content'>
                      <h2>Olá {$login->login}, seja bem-vindo!</h2>";
      ?>
      <div class="content">
          <form name="deslogar" method="post" action="">
            <div class="field is-grouped">
              <button type="submit" name="deslogar" class="button is-link is-light">Sair</button>
            </div>
          </form>
        </div>
      </div>
    </article>
  </div>
</div>

      <?php
      if(isset($_POST['deslogar'])) {
        unset($_SESSION['privateUser']);
        header("location:index.php");
      }

    } else {
      ?>

              <div class="tile is-parent">
                      <article class="tile is-child notification is-primary">
                          <h1>
                            O que é a <strong>All Space</strong>?
                          </h1>
                        </article>
                    </div>
                    <div class="tile is-parent">
                      <article class="tile is-child notification is-warning">
                    <div class="field has-addons">
                      <p class="control">
                        <strong>All Space é a promessa do Teatro que todas as pessoas precisam</strong><br>
                        O Teatro atual permanece morrendo dia após dia, com a crescente dos cinemas<br>
                        o teatro cada vez mais remete apenas a um ambiente para pessoas datadas<br>
                        e céticas demais, como um lugar chato e desmotivante onde apenas os jovens<br>
                        que ali se encontram procuram lutar contra sua timidez...<br><br>
                        Nós da All Space não aceitamos esse preconceito, essa imagem estranha<br>
                        que foi construido sobre o grande nome histórico que é o Teatro<br>
                        e para mudarmos isso, começamos com uma abordagem moderna<br>
                        e bem a cara do século XXI...<br><br>
                        <strong>UM SITE!</strong><BR>
                        </p>
                          </article>
                          </div>
                        </div>


          <div class="tile is-parent">
            <article class="tile is-child notification is-success">
              <div class="content">
                <p class="title">Login de Moderadores</p>
                  <p class="subtitle">(apenas para funcionários)</p>
                    <div class="content">

                        <form name="login" method="post" action="">
                          <div class="field">
                            <label class="label">Login</label>
                            <div class="control has-icons-left">
                              <input type="text" name="login" placeholder="Login" class="input">
                                <span class="icon is-small is-left">
                                  <i class="fa fa-user"></i>
                                </span>
                              </div>
                            </div>

                          <div class="field">
                          <label class="label">Chave-Mestra</label>
                          <div class="control has-icons-left">
                            <input type="password" name="chavemestra" placeholder="Insira a chave-mestra" class="input">
                            <span class="icon is-small is-left">
                              <i class="fa fa-key"></i>
                            </span>
                          </div>
                        </div>

                        <div class="field">
                          <label class="label">Permissão</label>
                            <div class="control">
                              <div class="select">
                                <select name="permissao">
                                  <option value="adm">Administrador</option>
                                  <option value="usuario">Usuário</option>
                                </select>
                              </div>
                            </div>
                          </div>

                        <div class="field is-grouped">
                          <div class="control">
                        <button type="submit" name="entrar" class="button is-link is-light">Entrar</button>
                      </div>
                    </form>
                  </div>
                  </div>
                </article>
              </div>
            </div>
      <?php
    }
    ?>

    <?php
    if(isset($_POST['entrar'])) {
      include_once "Modelo/login.class.php";
      include_once "DAO/loginDAO.class.php";
      include_once "util/seguranca.class.php";

      $login = new Login();
      $login->login = $_POST['login'];
      $login->chavemestra = Seguranca::criptografar($_POST['chavemestra']);
      $login->permissao = $_POST['permissao'];

      $loginDAO = new LoginDAO();
      $login = $loginDAO->verificarUsuario($login);

      if($login == null) {
        echo "<h2>Login/Senha ou Permissao inválida!</h2>";
      } else {
        $_SESSION['privateUser'] = serialize($login);
        header("location:index.php");
      }
    }
    ?>
  </body>
</html>
