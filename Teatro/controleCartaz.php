<?php
session_start();
ob_start();
include_once "Modelo/cartaz.class.php";
include_once "DAO/cartazDAO.class.php";
include_once "util/padronizacao.class.php";
include_once "util/seguranca.class.php";
include_once "util/validacao.class.php";

$cartaz = new Cartaz;
$cartaz->titulo = Validacao::validarTitulo(Seguranca::antiXSS($_POST['titulo']));
$cartaz->estudio = Validacao::validarEstudio(Seguranca::antiXSS($_POST['estudio']));
$cartaz->diretor = Validacao::validarDiretor(Seguranca::antiXSS($_POST['diretor']));
$cartaz->estrela = Validacao::validarEstrela(Seguranca::antiXSS($_POST['estrela']));
$cartaz->elenco = Validacao::validarElenco(Seguranca::antiXSS($_POST['elenco']));
$cartaz->duracao = Validacao::validarDuracao(Seguranca::antiXSS($_POST['duracao']));
$cartaz->descricao = Validacao::validarDescricao(Seguranca::antiXSS($_POST['descricao']));
echo $cartaz;

$cartazDAO = new CartazDAO;
$cartazDAO->cadastrarCartaz($cartaz);
echo "<br>Obra já disponível em cartaz!";
header("location:lista-cartaz.php");
