<?php
session_start();
ob_start();
include_once "Modelo/cliente.class.php";
include_once "DAO/clienteDAO.class.php";
include_once "util/padronizacao.class.php";
include_once "util/seguranca.class.php";
include_once "util/validacao.class.php";

$cliente = new Cliente;
$cliente->nome = Padronizacao::PadraoNome(
                Seguranca::antiXSS(
                Validacao::validarNome(
                $_POST['nome']
                  )
                )
              );
$cliente->email = Padronizacao::padraoEmail(
                  Seguranca::antiXSS(
                  Validacao::validarNome(
                $_POST['email']
                  )
                )
              );
$cliente->cpf = Seguranca::antiXSS($_POST['cpf']);
$cliente->datadenascimento = Padronizacao::padraoData(
                            Padronizacao::converterData(
                              ////////////////////////
                          Seguranca::antiXSS(
                          Validacao::validarNome(
                $_POST['datadenascimento']
                    )
                  )
                )
              );
$cliente->endereco = Validacao::validarNome(
                    Seguranca::antiXSS(
                  $_POST['endereco']
                )
              );
echo $cliente;

$clienteDAO = new ClienteDAO;
$clienteDAO->cadastrarCliente($cliente);
echo "<br>Cliente cadastrado com sucesso!";
header("location:index.php");
