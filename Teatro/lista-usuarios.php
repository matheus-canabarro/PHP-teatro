<?php
session_start();
ob_start();
include_once "Modelo/cliente.class.php";
include_once "DAO/clienteDAO.class.php";
include_once "Modelo/login.class.php";

?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
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
             <a class="navbar-item nav-link" href="lista-cartaz.php">
               Em Cartaz
             </a>

             <?php
             if(isset($_SESSION['privateUser'])) {
               $login = unserialize($_SESSION['privateUser']);
               if($login->permissao == "adm"){
                 ?>
              <a class="navbar-item is-active nav-link" href="lista-usuarios.php">
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

    <?php
    $clienteDAO = new ClienteDAO;
    $clientes = $clienteDAO->buscarClientes();
    // var_dump($clientes);

    if(count($clientes) == 0) {
      echo "<h2>Não há usuários cadastrados</h2>";
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
                         <option value="idcliente">Código</option>
                         <option value="nome">nome</option>
                         <option value="email">E-Mail</option>
                         <option value="cpf">CPF</option>
                         <option value="datadenascimento">Data de Nascimento</option>
                         <option value="endereco">Endereço</option>
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
      // echo  "oi";
      $clienteDAO = new ClienteDAO;
      $clientes = $clienteDAO->filtrarClientes($_POST['filtro'], $_POST['pesquisa']);
      // var_dump($clientes);
      unset($_POST['filtrar']);
      if(count($clientes) == 0) {
        echo "<h2>Sua consulta não retornou clientes</h2>";
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
            <th>Nome</th>
            <th>E-Mail</th>
            <th>CPF</th>
            <th>Data de Nascimento</th>
            <th>Endereço</th>
            <th>Alterar</th>
            <th>Excluir</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($clientes as $cliente) {
            echo "<tr>";
              echo "<td>$cliente->idcliente</td>";
              echo "<td>$cliente->nome</td>";
              echo "<td>$cliente->email</td>";
              echo "<td>$cliente->cpf</td>";
              echo "<td>$cliente->datadenascimento</td>";
              echo "<td>$cliente->endereco</td>";
              echo "<td><button href='alterar-usuario.php?id=$cliente->idcliente' class='button'>Alterar</button></td>";
              echo "<td><button href='lista-usuarios.php?id=$cliente->idcliente' class='button'>Excluir</button></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </div>

          <?php
    if(isset($_GET['id'])) {
      $clienteDAO = new ClienteDAO;
      $clienteDAO->excluirClientes($_GET['id']);
      header("location:lista-usuarios.php");
    }
    ?>

  </body>
</html>
