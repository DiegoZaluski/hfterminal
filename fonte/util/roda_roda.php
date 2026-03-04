<?php 
require_once "./fonte/util/logger.php";

$console = new Logger("roda_roda:closure injetado");

function roda_roda(string $nome_modelo) 
{
  /*
    função para verificar se o processo de dowload ja foi concluido e qual o seu status 
    ele roda um spiner conforma a verifica se o processo esta vido fica verificando em loop
  */

  // verifica se o processo de download esta ativo 

  /*
    TODO
    1. montar array para spiner 
    2. verifica se o processo esta vivo, montar parada
    3. verifica se o download foi bem sucedido retornando um boleano sim ou não 
  */  
  global $console;

  $spiner = ["⠋", "⠙", "⠹", "⠸", "⠼", "⠴", "⠦", "⠧", "⠇", "⠏"]; // percorrer o array e volta usando logica simples de dividir por % o valor do proprio index do array
  $indice = 0;

  $len_spiner = count($spiner); // usado para divir o array 

  while ( true ) { // loope de verificação 

    $s = $spiner[$indice % $len_spiner];
    $indice++;

    echo "\r $s";

    if (!shell_exec("pgrep -f \"wget.*{$nome_modelo}\"")) break;  // verifica se o processo ainda ta vivo ou seja ainda esta baixando se não estiver ele para o loop 
    usleep(100000); // pausa para ver o spiner girar 

    }

  echo "\r"; // re para limopar 

  // verificando se o arquivos de .sucess existe dentro do caminho "/dev/shm" se existir então o download foi bem sucedido por que o ele so sera criado se for 
  // 
  $ls_sucesso = shell_exec("cd /dev/shm/ && ls");
  $model_sucess = "{$nome_modelo}.success";// nome do arquivo que sera criado causo de tudo certo na hora de baixar
  $sucesso_download = str_contains($ls_sucesso , $model_sucess);

  if(!$sucesso_download) {

    $console -> log("Modelo não foi instalado", "AVISO");
    return false;

  }
  
  // remove o arquivo de sucessos para evitar possiveis falsos positivos futurios 
  shell_exec("cd /dev/shm && rm -r $model_sucess");
  $console -> log("download concluido com sucesso! ");
  return true;

}