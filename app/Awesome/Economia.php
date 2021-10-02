<?php

namespace App\Awesome;

class Economia{

    /**
     * URL base da API de Economia
     * @var string
     */
    const BASE_URL = 'http://economia.awesomeapi.com.br/json';

    /**
     * Método responsável por consultar a cotação das moedas
     *
     * @param string $moedaA
     * @param string $moedaB
     * @return array
     */
    public function consultarCotacao($moedaA, $moedaB){
        return $this->get('/last/'.$moedaA.'-'.$moedaB);
    }

    /**
     * Método responsável por retornar  os últimos fechamentos das moedas
     *
     * @param string $moedaA
     * @param string $moedaB
     * @param integer $dias
     * @return array
     */
    public function consultarUltimosFechamentos($moedaA, $moedaB, $dias = 1){
        return $this->get('/daily/'.$moedaA.'-'.$moedaB.'/'.$dias);
    }
    
    /**
     * Método responsável por executar a requisição na API de Economia do Awesome
     *
     * @param string $resource
     * @return array
     */
    public function get($resource){ 
        //ENDPOINT 
        $endpoint = self::BASE_URL.$resource;

        //INICIA O CURL
        $curl = curl_init();

        //CONFIGURAÇÕES DO CURL
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        //RESPONSE
        $response = curl_exec($curl);
        
        //FECHA A CONEXÃO DO CURL
        curl_close($curl);

        //RETORNA O RESULTADO EM ARRAY
        return json_decode($response, true);
        
    }
}