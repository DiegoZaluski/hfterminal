<?php 
function status_de_dowload() {
  /* apenas add um o propriedade "download_tentados" em $dados 
  
  DEPENDENCIAS:
  dependee de ter dados no escopo externo*/
  global $dados;
  global $contador_dowload;
  $dados["download_tentados"] = $contador_dowload;
  return $dados["download_tentados"]; 

}
// --- (LOC): MEDIA DE DOWNLOAD --- 
function media_de_dowload() {

  /*retorna a media de download de todos os usuario
  
  DEPENDECIA:
  $dados_organizado array do scopo externo  
  */ 

  global $dados_organizado;

  $somatorio = 0;

  foreach ($dados_organizado as $dados_) {
    $somatorio += $dados_["download_tentados"];
  } 

  $len_dados = count($dados_organizado);

  return $somatorio / $len_dados; //media  

}

// --- TOTAL DE DOWNLOAD DE TODOS OS USUARIO --- 

function total_de_dowload() {
  global $dados_organizado;

  $somatorio = 0;

  foreach ($dados_organizado as $dados_) {
    $somatorio += $dados_["download_tentados"];
  } 

  return $somatorio;
  
}

function operacao() {

  $operacao = [
    fn() => total_de_dowload(),
    fn() => media_de_dowload(),
    fn() => status_de_dowload(),
  ];

  $escolha = (int)readline("[1]\033[45m total de download \033[m [2]\033[42m media de download \033[m [3]\033[44m download tentados \033[m ") - 1;

  $op = $operacao[$escolha]();

  echo "\nvalor da operação escolhida: " .  $op . "\n";

}
