<?php 
require_once "./fonte/util/logger.php";
//  - **Cadastrar** um novo registro com pelo menos 4 campos (sendo pelo menos 1 string, 1 inteiro e
// 1 booleano)

$console = new Logger("./entrada/entradas_inicias");

// --- (LOC):USUARIO ---
function usuario_nome() 
{
  /*
    procedimento para manipular um array depende um array definido no escopo lexical,
    incere a propriedade nome vindo de um input do usuario 
  */
  global $dados; // chama o array do escopo externo 

  $nome = trim(readline("Digite seu nome: "));
  $comprimento_nome = strlen($nome);
  
  if ($nome && !is_numeric($nome) && $comprimento_nome > 0 ) $dados["usuario"] = $nome; // adiciona o nome digitado pelo usuario ao array de dados   

}
// $dados = "usuario" , ... 
//  --- (LOC): DATA/HORA ---
function data_hora() 
{ 
  /*
    apenas adiciona data e hora dentro do array, depende de um array do escopo lexical com o nome de $dodos
  */
  global $dados;
  $data =  date("d/m/Y");
  $hora = date("H:i:s");

  $dados["data"] = $data;
  $dados["hora"] = $hora;

}
// $dados = "usuario" , "data", "hora", ...

//  --- (LOC): VERIFICAÇÃO DO LLAMA.CPP --- 
function llama_cpp_existe() 

{
  
  /*verifica se o llama.cpp ja esta na raiz do projeto add um boleano ao array,
  depende de um array do escopo lexical com o nome de $dodos,
  é obrigatorio chamar a função no main.php ele se localiza com base na raiz do projeto
  */

  global $dados;
  global $console;

  $shell = explode("\n", shell_exec("ls"));

  foreach($shell as $elemento) {
    if ($elemento === "llama.cpp") {
      $dados["llama_cpp"] = true;

      $console->log("llama.cpp [PRESENTE]"); 

      return;
    } 
  }

  $console->log("llama.cpp [AUSENTE]", "ERROR");

}

// $dados = "usuario" , "data", "hora", [bool] llama_cpp

// --- (LOC): DOWNLOAD DE MODELOS --- 
function baixar_modelo(callable $roda_roda) //  callable $verifica_llama  ira receber o  llama_cpp_existe no futuro fiz assim somente para ficar mais flexivel e menor dependente a função 
{ 
  /*
  arg: injeção de depencia para usar um spiner de informação de download
  */
  require_once "./fonte/dados/modelos.php"; // array de modelos para sugestão de download e repositorio aonde eles se encontram 
  global $dados;
  global $console;
  
  if (!$dados["llama_cpp"]) {
    $console -> log("não a llama_cpp na raiz do projeto", "ERROR");
    return;
  } 
  
  echo "--- DOWLOAD DE MODELOS ---\n";
  var_dump($modelos);
  $escolha_do_modelo = (int)readline("Digite o indice do modelo que deseja baixar: "); // se não for possivel converter para int ele vai definir com padrão o numeor 0 
  
  if (!isset($modelos[$escolha_do_modelo])) {
    $console -> log("Indice informado invalido", "ERROR");
    return;
  }

  // --- MONTAGEM DO COMANDO --- 
  $nome_modelo = $modelos[$escolha_do_modelo];
  $url = $repositorios[$nome_modelo];// usa o indice digitado para acessar o nome do modelo e usa o nome do modelo para acessar o seu repositorio 
  $url_download = "{$url}/resolve/main/{$nome_modelo}?download=true"; // deixa a url de resolve sem ela baixaria o codigo html da pagina 
  $ram_caminho = "/dev/shm/"; // para salva o arquivo de status na ram
  $caminho_para_models = "llama.cpp/models"; // iso ser asado para irmos para models dentro de llama.cpp la sera baixado o modelo 
  // $caminho_para_models mover para um arquivo de paths 

  $wget_cmd = "(wget -O \"{$nome_modelo}.gguf\" \"{$url_download}\" > /dev/null 2>&1 && touch \"{$ram_caminho}{$nome_modelo}.success\") &"; // > /dev/null 2>&1 & isso serve para jogar o comando para background podendo assim usar o spiner no terminal de indicação de dowload
  /* --- RESUME MENTAL --- 
    Vai pegar o modelo basedo no indice vai pegar a url baseado no nome pego com o indice, 
    vai montar o url para baixar usando wget essa url baixa o modelo joga para um arquivo gguf e depis cria um arquivo de status da operação na ram 
    mandamos isso para o terminal concatenado com cd para navegar ate a pasta dentro do llama.cpp aonde esta deve ficar os modelos para inferencia 
    por fim chamamos o spiner que ira verificar quando o dowlaod terminal rodando um spiner no terminal retornando um boolean para ver se baixou sim ou não 
  */ 

  $descritores = [
    0 => ["file", "/dev/null", "r"],  // stdin
    1 => ["file", "/dev/null", "w"],  // stdout
    2 => ["file", "/dev/null", "w"],  // stderr
  ];

  $processo = proc_open(
    "bash -c " . escapeshellarg($wget_cmd), // comando que rodara 
    $descritores, // local de entrada, saida e saida de erro no meu caso para local algum 
    $pipe, // array de indexado , resumindo um array com informação em tempo real do processo de [entrada, saida, saida de erro]
    $caminho_para_models); // local aonde rodara o processo mesma coisa que dar um cd e entrar em diretorio

  if (!is_resource($processo)) { // verifica se falhou ao tentar iniaciar o processo
    $console->log("Falha ao iniciar o processo de download", "ERROR");
    return;
  }

  $baixar = $roda_roda($nome_modelo); // o spiner para rodar ate que o processo seja finalizado recebido do parametro da função retorna um boll
  
  if (!$baixar) { // se o dowload não foi bem sucedido 
    $dados["modelo_baixado"] = false;
    $dados["nome_modelo"] = "";
    return;
  } 

  $dados["modelo_baixado"] = true; 
  $dados["nome_modelo"] = $nome_modelo;

}

// $dados = "usuario" , "data", "hora", [bool] "llama_cpp", "modelo_baixado" = [$nome_modelo => false] // array formado ate agora
