<?php 
require_once "./fonte/util/logger.php";
  // precisa ter o CMAKE intalado para este scrip funcionar 
function download_e_build_llama(callable $llama_cpp_existe) {
  /*
    verifica se o llama existe dentro do array de dados se não existir ele clona o repositorio para o root 
    apos ele cria a pasta build dentro do llama cpp e builda ele apenas deixando pronto para uso

    depende do array de dados para funcionar 

                                --- IMPORTANTE ---
    deve ser rodado sempre em um arquivo no root para funcionar da forma correta
  */

  global $dados;
  $console = new Logger("download_e_build_llama");

  if(!$dados["llama_cpp"]) { // verifica se o llama existe no root 
    shell_exec("git clone https://github.com/ggml-org/llama.cpp"); // clona o repositorio
    $llama_cpp_existe();
    if (!$dados["llama_cpp"]){
      $console -> log("não foi possivel clonar o repositorio algo de errado não esta certo", "ERROR");
      return false; // retorna false para causo eu queira usar em um if de verificação no futuro 
    }
  }
  // algo de errado não esta certo o que é ????? falta do cmake ?? 
  shell_exec("cd llama.cpp 
  \ mkdir -p build && cd build 
  \ cmake .. -DCMAKE_BUILD_TYPE=Release 
  \ cmake --build . --config Release -j$(nproc)"); // comando para navegar nas pasta e buildar o llama.cpp


}


// $dados = "usuario" , "data", "hora", [bool] "llama_cpp", "modelo_baixado" = [$nome_modelo => false] // array formado ate agora
