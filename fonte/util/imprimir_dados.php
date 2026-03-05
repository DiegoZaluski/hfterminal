<?php
function imprimir_dados($d) {
  echo "\n--- DADOS DISPONIVEIS ---\n";
  foreach($d as $k => $v ) {
    echo "$k: $v\n";
  }
}  