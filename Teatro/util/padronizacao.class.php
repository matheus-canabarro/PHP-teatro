<?php
class Padronizacao
{
  public static function juntarNome($valor1, $valor2): string
  {
    $array = [$valor1, $valor2];
    return implode(" ", $array);
  }

  public static function padraoNome($valor): string
  {
    return ucwords(mb_strtolower($valor));
  }

  public static function padraoEmail($valor)
  {
    return mb_strtolower($valor);
  }

  public static function converterData($valor)
  {
    return strtotime($valor);
  }

  public static function padraoData($valor)
  {
    return date("d/m/Y",$valor);
  }
}
