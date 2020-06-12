<?php
class Validacao
{

  public static function validarTitulo($valor): bool
  {
    $expressao = "/^[^!@#$%¨&()_]{2,50}$/";
    return pregmatch($expressao, $valor);
  }

  public static function validarEstudio($valor): bool
   {
     $expressao = "/^[^!@#$%¨&()]{2,100}$/";
     return preg_match($expressao, $valor);
   }

   public static function validarDiretor($valor): bool
  {
    $expressao = "/^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,50}$/";
    return preg_match($expressao, $valor);
  }

  public static function validarEstrela($valor): bool
  {
    $expressao = "/^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,50}$/";
    return preg_match($expressao, $valor);
  }

  public static function validarElenco($valor): bool
  {
    $expressao = "/^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,200}$/";
    return pregmatch($expressao, $valor);
  }

  public static function validarDuracao($valor): bool
   {
     $expressao = "/^[0-9, ]{1,3}$/";
     return pregmatch($expressao, $valor);
   }

   public static function validarDescricao($valor): bool
   {
     $expressao = "/^[^0-9!@#$%¨&*()^]{2,100}$/";
     return preg_match($expressao, $valor);
   }

   public static function validarNome($valor): bool
  {
    $expressao = "/^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,50}$/";
    return pregmatch($expressao, $valor);
  }

  public static function validarEmail($valor): bool
  {
    if(filter_var($valor, FILTER_VALIDATE_EMAIL)) {
  echo 'e-mail valido';
} else {
  echo 'e-mail invalido!';
}
  }

  public static function validarCpf($valor): bool
  {
    $expressao = "/^[0-9]{11,14}$/";
    return preg_match($expressao, $valor);
  }

  public static function validarDataDeNascimento($valor): bool
  {
    $expressao = "/^[0-9]{10}$/";
    return preg_match($expressao, $valor);
  }
  public static function validarEndereco($valor): bool
  {
    $expressao = "/^[A-Za-záÁÉéíÍóÓúÚãÃçÇüÜàÀÔôâÂÊê ]{2,150}$/"
    return preg_match($expressao, $valor);
  }
}
