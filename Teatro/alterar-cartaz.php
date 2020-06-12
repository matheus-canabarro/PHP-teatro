<?php
ob_start(); //abrir em todos
include_once "Modelo/cartaz.class.php";
include_once "DAO/cartazDAO.class.php";
// include_once "util/seguranca.class.php";

if(isset($_GET['id'])) {
  // echo "<br>oi: ".$_GET['id'];

  $cartazDAO = new CartazDAO;
  $cartazes = $cartazDAO->filtrarCartaz("codigo", $_GET['id']);
   // var_dump($cartazes);
  $cartaz = $cartazes[0];
  // echo $cartaz;
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
           <form name="alterarcartaz" method="post" action="">

                 <div class="field">
                  <input type="text" name="idcartaz" class="input"
                  value="<?php echo $cartaz->idcartaz ?? ""; ?>" readonly>
                </div>

               <div class="field">
                 <input type="text" name="titulo" placeholder="Digite o titulo da obra" required pattern="^[^!@#$%¨&()_]{2,50}$" autofocus class="input"
                 value="<?php echo $cartaz->titulo ?? ""; ?>">
               </div>

               <div class="field">
                 <input type="text" name="estudio" placeholder="Digite o estudio/grupo de produção" required pattern="^[^!@#$%¨&()]{2,100}$" class="input"
                 value="<?php echo $cartaz->estudio ?? ""; ?>">
               </div>

               <div class="field">
                 <input type="text" name="diretor" placeholder="Digite o nome do diretor da obra" required pattern="^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,50}$" class="input"
                 value="<?php echo $cartaz->diretor ?? ""; ?>">
               </div>

               <div class="field">
                 <input type="text" name="estrela" placeholder="Digite o nome da estrela da peça" required pattern="^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,50}$" class="input"
                 value="<?php echo $cartaz->estrela ?? ""; ?>">
               </div>

               <div class="field">
                 <input type="text" name="elenco" placeholder="Digite os nomes principais do elenco" required pattern="^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,200}$" class="input"
                 value="<?php echo $cartaz->elenco ?? ""; ?>">
               </div>

               <div class="field">
                 <input type="text" name="duracao" placeholder="Digite a duração do filme(Em minutos)" required pattern="^[0-9, ]{1,3}$" class="input"
                 value="<?php echo $cartaz->duracao ?? ""; ?>">
               </div>

               <div class="field">
                 <input type="text" name="descricao" placeholder="Descrição da obra" required pattern="^[^0-9!@#$%¨&*()^]{2,100}$" class="input"
                 value="<?php echo $cartaz->descricao ?? ""; ?>">
               </div>

               <div class="field">
                 <div class="control">
                   <button type="submit" name="alterarcartaz" class="button is-link is-light">Alterar</button>
                 </div>
               </div>
             </form>
           </div>
         </div>
       </article>
     </div>
   </div>

     <?php
     if(isset($_POST['alterarcartaz'])) {
       $cartaz = new Cartaz;
       $cartaz->idcartaz = $_POST['idcartaz'];
       $cartaz->titulo = $_POST['titulo'];
       $cartaz->estudio = $_POST['estudio'];
       $cartaz->diretor = $_POST['diretor'];
       $cartaz->estrela = $_POST['estrela'];
       $cartaz->elenco = $_POST['elenco'];
       $cartaz->duracao = $_POST['duracao'];
       $cartaz->descricao = $_POST['descricao'];

       echo $cartaz;

       $cartazDAO = new CartazDAO;
       $cartazDAO->alterarCartaz($cartaz);
       echo "Cartaz alterado com sucesso!";

       header("location:lista-cartaz.php");
     }
     ?>
  </body>
</html>
