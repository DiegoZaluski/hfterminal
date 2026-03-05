<?php 
// ------ IMPORTS -----
require_once  "./fonte/entradas/entradas_inicias.php";
require_once "./fonte/entradas/prompt_do_sistema.php";
require_once "./fonte/util/roda_roda.php";
require_once "./fonte/manipular/download_e_build_llama.php";
require_once "./fonte/dados/organiza_dados.php"; 
require_once "./fonte/manipular/remover.php";
require_once "./fonte/manipular/editar.php";
require_once "./fonte/util/imprimir_dados.php";
require_once "./fonte/mult_escolha/add_sys_prompt.php";
require_once "./fonte/mult_escolha/chat_ou_editar.php";
require_once "./fonte/mult_escolha/baixar_sn.php";
require_once "./fonte/llama_cli/chat.php";
require_once "./fonte/mult_escolha/REO_escolha.php";
require_once "./fonte/manipular/calculos.php";

// --------------------- //

// ----- INSTANCIAS -----
$contador_dowload = 0;
$dados = [];
$dados_organizado = [];
$ligar_chave = 0; // como um chave de carro tu so pode girar para dois lados, indica que um usuario entrou na sessão valores possiveis 0 e 1, usado tambem para trocar de usuario 
// --------------------- //

while(true) {

  // COMPORTAMENTO INCIAL // 
  if(!$ligar_chave) {

    if(!usuario_nome())continue; // continua se não retorar true 
    echo "\r";
    data_hora();
    llama_cpp_existe();

    while(true){
      if(!baixar_sn(baixar_modelo(...), roda_roda(...))) continue; // pergunta se o usuario quer baixar algum modelo 
      break;
    }

    while(true){
      if(!adicionar_sys_prompt(prompt(...))) continue; // pergunta se o usuario quer add um sys prompt se sim cham prompt() e retorna true se não 
      break;
    }

    organiza_dados();

    $ligar_chave++;
  } 
  // imprimir_dados($dados_organizado);// organiza os dados para printar 
  var_dump($dados_organizado); // exibe dados 

  $CE = chat_ou_editar(); 
  echo "\r";
  if ($CE === 1) {// LLAMA CLI
    chat();
  } 

  elseif ($CE === 2) { // ESCOLHA DE EDIÇÃO 
    while(true) { // causo erre ele 
      // AJUSTAR O NOME DA FUNÇÃO ADD MAIS REPONSABILIDADES A ELA remover_ou_editar
      $REO = REO_escolha(remover(...), editar(...), operacao(...)); // decide qual caminho usar retorn 1 ou 2 ou false (REO: remover, editar, operações)
      if(!$REO)continue; // volta 
      // MESANGEM DE INSERAMENTO
      echo $REO === 1 ? "\n--- Operação de remoção concluida ---\n" : "\n--- Operação de editar concluida ---\n"; 
      break;     
    }
  }

  else echo "Erro desconhecido";

  $sair = strtolower(trim(readline("[ctrl+c]: PARA SAIR ou apente a tecla \"S\": "))) === "s"? true : false;
  echo "\r"; 
  if ($sair) {

    $ligar_chave--; // desliga o motor fechando sessão 

    break;

  } // para o loop

}


