<?php 
require_once "./fonte/util/logger.php";
$console = new Logger("remover");
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


function todos() {
  /*remove um usuario */
  global $dados_organizado;
  global $nome;
  global $console; 

  if (!isset($dados_organizado[$nome])) { // verifica se a chave existe 
    $console -> log("chave para acessar dados invalida", "ERROR");
    return false;
  }

  if(!confirme()) return false; // pedido de confirmação

  // ADICIONAR VERIFICAÇÃO 
  unset($dados_organizado[$nome]); // remove o usuario fornecido 
  return true;

}

function  expecifico() {
  /*remove um valor em expecifico*/
  global $dados_organizado;
  global $console; 
  global $nome;

  echo "\n--- DADOS DISPONIVEIS ---\n";
  foreach($dados_organizado[$nome] as $chave => $valor) {// mostra os campos existentes para deletar
    echo "$chave: $valor\n";
  } 

  $nome_prop = trim(readline("digite o nome da propriedade que quer remover: "));
  if (!isset($dados_organizado[$nome][$nome_prop])) { // verifica se a chave existe 
    $console -> log("chave para acessar dados invalida", "ERROR");
    return false;
  }

  if(!confirme()) return false; // pedido de confirmação

  $dados_organizado[$nome][$nome_prop] = "\0"; // adiciona caracter nulo dentro 
  return true;
}

// depende das variaveis do local em que foi chamado

function remover(string | null $nome = null) 
{
  /* usa hash map para tomada de desição 
  DEPENDENCIA:
  */

  global $dados_organizado;

  if ( $nome === null && !confirme()) return; // pede confimação do usuario para deletar ou não 

  $entrada = (int)readline("deseja apagar o usuario ou apenas alguns dado expecifico? ESCOLHA: 1/2 ") - 1; // T = todos , E = expecifico

  // MAPA 
  $mapa = [todos(...), expecifico(...)]; // apenas uma boa pratica mental para se treina sistemas escalaveis  
  
  $function_de_retorno = $mapa[$entrada]; // acessa usando o a opção do usuario 
  
  return $function_de_retorno ? $function_de_retorno : false; 
  
}