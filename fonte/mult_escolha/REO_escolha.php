<?php 
function REO_escolha(callable $remover, callable $editar, callable $operacao) {
  /*
    chama a função escolhida e retorna 1 para remover e 2 para editar 
  */
  $escolha = (int)readline("[1]\033[45m remover \033[m [2]\033[42m editar \033[m [3]\033[42m operaçãoes\033[m ");
  echo "\n";
  if(!is_numeric($escolha)) { // se não for um numero 
    echo "deve ser passado um numero";
    return false;
  } 

  if ($escolha === 1) {
    $nome = strtolower(trim(readline("deseja escolher um usuario em especifico para remover? se sim digite o nome causo não quera digite apenas \"N\": ")));
    
    if($nome != "n") { // remover() ja lida  com o caso do nome ser iinvalido então seria overhead terque valiidar de novo 
      $r = $remover();
      $r ? $r() : var_dump("erro o indice é invalido"); 

      return 1;
    } 
    $r = $remover($nome);
    $r ? $r() : var_dump("erro o indice é invalido"); 

    return 1;
  }

  if ($escolha === 2) {
    $editar();
    return 2;
  }

  if ($escolha === 3) {
    $operacao();
    return 3;
  }
}