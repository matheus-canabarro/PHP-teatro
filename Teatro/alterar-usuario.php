<?php
ob_start(); //abrir em todos
include_once "Modelo/cliente.class.php";
include_once "DAO/clienteDAO.class.php";
// include_once "util/seguranca.class.php";

if(isset($_GET['id'])) {
  // echo "oi";

  $clienteDAO = new ClienteDAO;
  $clientes = $clienteDAO->filtrarClientes("idcliente", $_GET['id']);
  // var_dump($clientes);
  $cliente = $clientes[0];
  // echo $cliente;
}
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/> -->
    <link href="node_modules/bulma/css/bulma.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/ajax/lib/ajax.js"></script>
    <!-- <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <title>Alterar Dados de Usuário</title>
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
<div class="tile is-vertical is-parent">
  <article class="title is-child notification is-success">
    <div class="content">
      <p class="title">
        Informações da Obra
      </p>
        <div class="content">
           <form name="alterar" method="post" action="">

             <div class="field">
              <input type="text" name="idcliente" class="input"
              value="<?php echo $cliente->idcliente ?? ""; ?>" readonly>
            </div>

             <div class="field">
               <input type="text" name="nome" placeholder="Digite o seu nome"  required pattern="^[^0-9%$#@!¨*()]{2,50}$" autofocus class="input"
               value="<?php echo $cliente->nome ?? ""; ?>">
             </div>

             <div class="field">
               <input type="email" name="email" placeholder="Digite seu email" required pattern="^[A-Za-z0-9@_\-\. ]{8,60}$"  class="input"
               value="<?php echo $cliente->email ?? ""; ?>">
             </div>

             <div class="field">
               <input type="text" name="cpf" placeholder="Digite seu CPF" required pattern="^[0-9]{11,14}$" class="input"
               value="<?php echo $cliente->cpf ?? ""; ?>">
             </div>

             <div class="field">
               <input type="text" name="datadenascimento" placeholder="Digite sua data de nascimento"  required pattern="^[0-9]{10}$" class="input"
               value="<?php echo $cliente->datadenascimento ?? ""; ?>">
             </div>

             <div class="field">
               <input type="text" name="endereco" placeholder="Digite seu endereço" required pattern="^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,150}$" class="input"
               value="<?php echo $cliente->endereco ?? ""; ?>">
             </div>

             <div class="field">
                <div class="control">
                 <button type="submit" name="alterar" class="button is-link is-light">Alterar</button>
                </div>
             </div>
           </form>
         </div>
       </div>
     </article>
   </div>
 </div>

     <?php
     if(isset($_POST['alterar'])) {
       $cliente = new Cliente;
       $cliente->idcliente = $_POST['idcliente'];
       $cliente->nome = $_POST['nome'];
       $cliente->email = $_POST['email'];
       $cliente->cpf = $_POST['cpf'];
       $cliente->datadenascimento = $_POST['datadenascimento'];
       $cliente->endereco = $_POST['endereco'];

       // echo $cliente;

       $clienteDAO = new ClienteDAO;
       $clienteDAO->alterarCliente($cliente);
       echo "Usuário alterado com sucesso!";

       header("location:index.php");
     }
     ?>
  </body>
</html>
