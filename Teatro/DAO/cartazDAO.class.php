<?php

require "conexaobanco.class.php";
class CartazDAO
{

  private $conexao = null;

  public function __construct()
  {
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function cadastrarCartaz($cartaz)
  {
    try {
      $statement = $this->conexao->prepare("insert into cartaz(idcartaz,titulo,estudio,diretor,estrela,elenco,duracao,descricao)values(null,?,?,?,?,?,?,?)");

      $statement->bindValue(1, $cartaz->titulo);
      $statement->bindValue(2, $cartaz->estudio);
      $statement->bindValue(3, $cartaz->diretor);
      $statement->bindValue(4, $cartaz->estrela);
      $statement->bindValue(5, $cartaz->elenco);
      $statement->bindValue(6, $cartaz->duracao);
      $statement->bindValue(7, $cartaz->descricao);
      $statement->execute();
    } catch(PDOException $error) {
      echo "Erro ao cadastrar!".$error;
    }
  }

  public function buscarCartaz()
  {
    try {
      $statement = $this->conexao->query("select * from cartaz");
      $array = $statement->fetchAll(PDO::FETCH_CLASS,'Cartaz');
      return $array;
    } catch(PDOException $error) {
      echo "Erro ao buscar as obras em cartaz!".$error;
    }
  }

  public function excluirCartaz($id)
  {
    try {
      $statement = $this->conexao->prepare("delete from cartaz where idcartaz = ?");
      $statement->bindValue(1, $id);
      $statement->execute();
    } catch(PDOException $error) {
      echo "Erro ao excluir cartaz!".$error;
    }
  }

  public function filtrarCartaz($filtro, $pesquisa)
  {
    try {

      switch($filtro) {
        case "codigo": $query = "where idcartaz =".$pesquisa;
        break;
        case "titulo": $query = "where titulo like '%".$pesquisa."%'";
        break;
        case "estudio": $query = "where estudio like '%".$pesquisa."%'";
        break;
        case "diretor": $query = "where diretor like '%".$pesquisa."%'";
        break;
        case "estrela": $query = "where estrela like '%".$pesquisa."%'";
        break;
        case "elenco": $query = "where elenco like '%".$pesquisa."%'";
        break;
        case "duracao": $query = "where duracao like '%".$pesquisa."%'";
        break;
        default: $query = "";
        break;
      }

      $statement = $this->conexao->query("select * from cartaz {$query}");
      return $statement->fetchAll(PDO::FETCH_CLASS, 'Cartaz');
    } catch(PDOException $error) {
      echo "Erro ao filtrar Cartaz!".$error;
    }
  }

  public function alterarCartaz($cartaz)
  {
    try {
      $statement = $this->conexao->prepare("update cartaz set titulo=?,estudio=?,diretor=?,estrela=?,elenco=?,duracao=?,descricao=? where idcartaz=?");

      $statement->bindValue(1, $cartaz->titulo);
      $statement->bindValue(2, $cartaz->estudio);
      $statement->bindValue(3, $cartaz->diretor);
      $statement->bindValue(4, $cartaz->estrela);
      $statement->bindValue(5, $cartaz->elenco);
      $statement->bindValue(6, $cartaz->duracao);
      $statement->bindValue(7, $cartaz->descricao);
      $statement->bindValue(8, $cartaz->idcartaz);
      $statement->execute();
    } catch(PDOException $error) {
      echo "Erro ao alterar os dados da obra...".$error;
    }
  }
}
