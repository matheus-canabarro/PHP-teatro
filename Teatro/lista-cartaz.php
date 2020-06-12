<?php
session_start();
ob_start();
include_once "Modelo/cartaz.class.php";
include_once "DAO/cartazDAO.class.php";
include_once "Modelo/login.class.php";
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peças em Cartaz</title>
    <!-- <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/> -->
    <link href="node_modules/bulma/css/bulma.min.css" rel="stylesheet"/>
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
             <a class="navbar-item is-active nav-link" href="lista-cartaz.php">
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

    <?php
    $cartazDAO = new CartazDAO;
    $cartazes = $cartazDAO->buscarCartaz();

    if(count($cartazes) == 0) {
      echo "<h2>Não há obras em cartaz";
      echo "</body>";
      echo "</html>";
      die();
    }
    ?>

    <form name="pesquisa" method="post" action="">
        <div class="columns">
          <div class="column is-half is-offset-one-quarter is-vcentered">
          <nav class="level">
            <div class="level-left">
              <div class="level-item">
                <p class="subtitle is-5">
                  <strong>Filtro</strong>
                </p>
              </div>

              <div class="level-item">
                <div class="field has-addons">
                      <div class="control">
                        <input type="text" name="pesquisa" class="input" placeholder="Digite sua pesquisa">
                      </div>
                    <div class="control">
                        <button type="submit" name="filtrar" class="button">Filtrar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="level-right">
                <div class="level-item">
                  <div class="control">
                    <div class="select">
                          <select name="filtro">
                            <option value="todos">Todos</option>
                            <option value="idcartaz">Código</option>
                            <option value="titulo">Título</option>
                            <option value="estudio">Estúdio</option>
                            <option value="diretor">Diretor</option>
                            <option value="estrela">Estrela</option>
                            <option value="elenco">Elenco</option>
                            <option value="duracao">Duração</option>
                          </select>
                          </div>
                        </div>
                      </div>
                  </div>
                </nav>
              </div>
            </div>
          </form>

    <?php
    if(isset($_POST['filtrar'])) {
      // echo "oi";
      $cartazDAO = new CartazDAO;
      $cartazes = $cartazDAO->filtrarCartaz($_POST['filtro'], $_POST['pesquisa']);
      // var_dump($cartazes);
      unset($_POST['filtrar']);
      if(count($cartazes) == 0) {
        echo "<h2>Sua consulta não retornou cartazes</h2>";
        echo "</body>";
        echo "</html>";
        die();
      }
    }
    ?>
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr class="table">
                  <th>Código</th>
                  <th>Título</th>
                  <th>Estúdio</th>
                  <th>Diretor</th>
                  <th>Estrela da Peça</th>
                  <th>Elenco</th>
                  <th>Duração</th>
                  <th>Descrição</th>
                  <th>Alterar</th>
                  <th>Excluir</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($cartazes as $cartaz) {
                  echo "<tr>";
                    echo "<td>$cartaz->idcartaz</td>";
                    echo "<td>$cartaz->titulo</td>";
                    echo "<td>$cartaz->estudio</td>";
                    echo "<td>$cartaz->diretor</td>";
                    echo "<td>$cartaz->estrela</td>";
                    echo "<td>$cartaz->elenco</td>";
                    echo "<td>$cartaz->duracao</td>";
                    echo "<td>$cartaz->descricao</td>";
                    echo "<td><button href='alterar-cartaz.php?id=$cartaz->idcartaz' class='button'>Alterar</button></td>";
                    echo "<td><button href='lista-cartaz.php?id=$cartaz->idcartaz' class='button'>Excluir</button></td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </div>
          </div>

      <?php
      if(isset($_GET['id'])) {
        $cartazDAO = new CartazDAO;
        $cartazDAO->excluirCartaz($_GET['id']);
        header("location:lista-cartaz.php");
      }
      ?>
  </body>
</html>
