<?php 
require_once  "./fonte/entradas/entradas_inicias.php";
require_once "./fonte/util/roda_roda.php";
require_once "./fonte/manipular/download_e_build_llama.php";
require_once "./fonte/dados/organiza_dados.php"; // dar um nome mais descritivo 

// instancimento dos arrays que serão usados 
$contador_dowload = 0;
$dados = [];
$dados_organizado = [];
while(true) {

  usuario_nome();
  data_hora();
  llama_cpp_existe(); // verifica se o llama existe no projeto 
  organiza_dados();
  
  var_dump($dados_organizado);
  
  // baixar_modelo(roda_roda(...));
  
  // download_e_build_llama(llama_cpp_existe(...));
}
