<?php 

function baixar_sn(callable $baixar_modelo, callable $roda_roda ) {
  
  $baixar = strtolower(trim(readline("baixar modelo? S/N: ")));
  if (is_numeric($baixar))return false;

  if ($baixar === "s") {
    $baixar_modelo($roda_roda(...));
    return true;
  }

  if ($baixar === "s" || $baixar === "n") return true;
  echo "digite apenas S/N\n";
  return false;
}
