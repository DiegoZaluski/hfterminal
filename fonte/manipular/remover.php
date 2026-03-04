<?php 

function confirme() {

  $confirme = readline("[AVISO]: essa operação é inrreversivel.\n tem certeza que deseja mesmo remover? S/N ");
  $confirme =  strtoupper($confirme);

  if ($confirme == "S") {
    return true;
  } 

  if ($confirme == "S") {
    return false;
  }

} 

function todos($nome, callable $confirme) {
  global $dados_organizado;
  if(!confirme()) return false;

  // ADICIONAR VERIFICAÇÃO SE A PROPRIEDADE EXISTE OU NÃO ?? 
  isset($dados_organizado[$nome]);
  // ADICIONAR VERIFICAÇÃO 
  return true;


}

$mapa = ["t" => todos($nome, confirme(...)),
  "e"
]; // depende das variaveis do local em que foi chamado

function remover(string | null $nome, callable $mapa, callable $confirme ) 
{
  /* usa hash map para tomada de desição 
  DEPENDENCIA:
  */
  global $dados_organizado;
   
  if ( $nome === null && !$confirme()) return; // pede confimação do usuario para deletar ou não 

  $entrada = strtolower(readline("deseja apagar o usuario ou apenas alguns dado expecifico? T/E")); // T = todos , E = expecifico
  

  
  // isset()
     
}