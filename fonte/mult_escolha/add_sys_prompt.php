<?php 
function adicionar_sys_prompt(callable $prompt) {
  /*
    verifica se o usuario quer que add um system prompt 
  */

  $sys_prompt = strtolower(trim(readline("deseja add system prompt ? S/N: ")));
  if($sys_prompt === "s") {
    
    $prompt();
    return true;
  }

  if($sys_prompt === "n" || $sys_prompt === "s") { // verifica se o valor digitado corresponde a escolha possivel 
    return true;
  }

  echo "valor digitado invalido\n";
  return false;
}