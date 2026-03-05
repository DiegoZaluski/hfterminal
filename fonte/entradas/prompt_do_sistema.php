<?php 

function prompt() { // a ordem ue chama essa função pode acabar cortando ele do array ainda não sei o porque 
  /*
    gera um prompt e salva ele sera injetado no modelo na primeira interação com o modelo

  */
  global $dados;
  $prompt = trim(readline("digite o prompt de orientação para o modelo: "));
  $dados["prompt"] = $prompt;

}