<?php 
function chat() {
  global $dados;

  echo "--- ultimo modelo baixado ---\n";
  echo isset($dados["nome_modelo"]) ? $dados["nome_modelo"] . "\n" : "não há modelos baixados recentemente\n";
  
  $modelo = trim(readline("digite o nome do modelo que deseja usar: "));

  $descritores = [
    0 => ["file", "/dev/stdin", "r"],   // stdin
    1 => ["file", "/dev/stdout", "w"],  // stdout
    2 => ["file", "/dev/stderr", "w"],  // stderr
  ];

  $local = "./llama.cpp";
  $comando = "./build/bin/llama-cli -m ./models/{$modelo}.gguf -cnv --temp 0.7 -n 512 -c 4096 --color on";

  $processo = proc_open(
    "bash -c " . escapeshellarg($comando), // comando que rodara 
    $descritores, // local de entrada, saida e saida de erro no meu caso para local algum 
    $pipe, // array de indexado , resumindo um array com informação em tempo real do processo de [entrada, saida, saida de erro]
    $local); // local aonde rodara o processo mesma coisa que dar um cd e entrar em diretorio

  if(!is_resource($processo)) {
      echo "[ERRO]: ao tentar chamar o modelo";
  }

  proc_close($processo);
}