<?php 
function status_de_dowload() {
  /* apenas incerre um o propriedade "download_tentados" em $dados 
  
  DEPENDENCIAS:
  dependee de ter dados no escopo externo*/
  global $dados;
  global $contador_dowload;
  $dados["download_tentados"] = $contador_dowload;

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