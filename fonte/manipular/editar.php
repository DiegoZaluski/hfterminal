<?php 

function editar() {
  /* 
    função muda o nome de usuario do  
  */
  global $dados_organizado;
  $nome = strtolower(trim(readline("digite o nome de qual usuario quer editar: "))); // NOME DO USUARIO 

  if(!isset($dados_organizado[$nome]))  {
    echo "nome invalido: \n";
    return false;
  }

  $editar = strtolower(trim(readline("EDITAR [usuario] | [prompt]: digite o nome de qual: "))); // CAMPO QUE IRA ACESSAR

  if(!isset($dados_organizado[$nome][$editar]))  {
    echo "campo invalido: \n";
    return false;
  }

  $valor = trim(readline("novo valor: "));// NOVO VALOR QUE SERA INSERIDO 

  if ($editar === "usuario" && is_numeric($valor)) {
    echo "usuario deve ser um nome e não apenas numeros";
    return false;
  }

  if ($editar === "usuario" || $editar === "prompt") { // apenas dois campos são permitos edição
    $dados_organizado[$nome][$editar] = $valor ;
    if ($editar === "usuario") {
      if (strlen($valor) === 0) { // com base no comprimento verifica se o valor foi digitado ou não
        echo "o novo nome não foi digitado";
        return false;
      }
      $dados_organizado[$valor] = $dados_organizado[$nome];
      unset($dados_organizado[$nome]); // copia para um nova chave os dados anterior e add o nova valor essa novo usuario 
    }
    
    return true;
  }

  echo "algum valor foi digitado errado ";
  return false;

}