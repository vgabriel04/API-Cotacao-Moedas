<?php

require __DIR__.'/vendor/autoload.php';

//DEPENDÊNCIAS
use \App\Awesome\Economia;

// INSTÂNCIA DA CLASSE DE API
$obEconomia = new Economia;

if(!isset($argv[2])){
  die('É necessário enviar duas moedas');
}

//MOEDAS
$moedaA = $argv[1];
$moedaB = $argv[2];

//EXECUTA A REQUISIÇÃO NA API
$dadosfechamento = $obEconomia->consultarUltimosFechamentos($moedaA, $moedaB, 7);

//IMPRIME O RETORNO DA COTAÇÃO
echo 'Moedas: '.$moedaA.' -> '.$moedaB."\n";

//ITERA OS DADOS DOS FECHAMENTOS
foreach($dadosfechamento as $fechamento){
  //OUTPUT
  $output = [
    date('Y-m-d', $fechamento['timestamp']),
    number_format($fechamento['bid'], 4, '.',''),
    number_format($fechamento['ask'], 4, '.',''),

  ];

  //IMPRIME O RESULTADO
  echo implode(' | ', $output) ."\n";

};

// echo '<pre>';
// print_r($fechamento);
// echo '</pre>';