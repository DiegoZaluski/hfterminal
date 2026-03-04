<?php 
$sqlite = new SQLite3("dados.db"); // deverar ser mudado para outro local somentar para testes deixar aqui 

  // $dados = "usuario" , "data", "hora", [bool] "llama_cpp", "modelo_baixado" = [$nome_modelo => false] // array formado ate agora
  function criar_tabela() {
    /*cria um tabela simples sqlite usando o array associativo do loop while*/
    global $sqlite;
    $sqlite -> exec("CREATE DATABASE IF NOT EXISTS `dados`(
      id INTEGER PRIMARY KEY,
      usuario TEXT NOT NULL,
      _data TEXT NOT NULL,
      hora TEXT NOT NULL,
      llama_cpp INTEGER NOT NULL,
      MODELO_BAIXADO INTEGER NOT NULL,
      nome_modelo TEXT NOT NULL
    ) ");

    $sqlite -> close();

  }

function inserir_dados() {
  global $sqlite;
  global $dados;

  $coringado = $sqlite -> prepare("INSERT INTO dados() VALUES(?,?,?,?,?,?)");// retorna um metodo para trocas os corigas e inserir os dados reais 
  $coringado -> execute($dados); // dados precisa ter a ordem correta para funcionar 

}

function pegar_dados(string | null $id = null, string | null $nome = null) {
  global $sqlite; 
  $selecionado = $id ? $id : ($nome ? $nome : "*"); 

  /** @var PDO $sqlite */ // comentario serve para parar de apontar erros inexistente no vscode deixando tela vermelha

  $select = $sqlite -> prepare("SELECT $selecionado FROM dados");
  $select -> execute();

  return $select -> fetchAll(2); // PDO::FETCH_ASSOC === 2

}