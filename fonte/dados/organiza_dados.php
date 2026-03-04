<?php 

function organiza_dados() {
  
  /* 
    pega os dados individuais e organiza em um array associativo
    para ser usado chamando pelo nome da pessoa
    
    ele ordena para deixa possivel um busca binaria

    DEPENCIA :

    depende um array $dados e $dados_organizado no escopo externo para funcinal 

  */
  
  global $dados;
  global $dados_organizado;

  if (!is_array($dados)) return; 

  $dados_organizado[$dados["usuario"]] = $dados;

  if (count($dados_organizado) <= 1) return; // se o array tiver apenas um elemento ele não tenta ordenar 

  ksort($dados_organizado); // ordena em ardem alfabetica 
  
  // ordem alfabetica 
  
}
