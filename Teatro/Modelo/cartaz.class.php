<?php
class Cartaz
{
  private $idCartaz;
  private $titulo;
  private $estudio;
  private $diretor;
  private $estrela;
  private $elenco;
  private $duracao;
  private $descricao;

  public function __construct()
  {
  }

  public function __destruct()
  {
  }

  public function __get($atributo)
  {
    return $this->$atributo;
  }

  public function __set($atributo, $valor)
  {
    $this->$atributo = $valor;
  }

  public function __toString()
  {
    return nl2br("Título: $this->titulo
                  Estúdio: $this->estudio
                  Diretor: $this->diretor
                  Estrela: $this->estrela
                  Elenco: $this->elenco
                  Duração: $this->duracao
                  Descrição: $this->descricao");
  }
}
