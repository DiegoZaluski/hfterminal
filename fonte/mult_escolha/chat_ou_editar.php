<?php 

function chat_ou_editar() {

  echo "\n --- escolha para aonde ir --- \n";
  $escolha = (int)readline("[1]\033[45m chat \033[m [2]\033[42m editar \033[m "); // pergunta qual menu o usario quer ir 
  echo "\n";

  if(!is_numeric($escolha)) return false; // se não for um numero 

  if ($escolha === 1 || $escolha === 2 ) return $escolha; // deve ser apenas um ou dois 

  return false;
}