<?php 

namespace App\Helpers\Pix;

class Api{
    /**
     * URL Base do PSP
     * @var string
     */
    private $baseUrl;

    /**
     * Client id do oauth2 do PSP
     * @var string
     */
    private $clientId;

    /**
     * Client secret do oauth2 PSP
     * @var string
     */
    private $clientSecret;

    /**
     * Caminho absoluto até do arquivo do certificado
     * @var string
     */
    private $cetificate;

    /**
     * Define os dados iniciais da classe
     * @param string @baseUrl
     * @param string @clientId
     * @param string @clientSecret
     * @param string @cetificate
     */
    public function __construct($baseUrl, $clientId, $clientSecret, $cetificate){
        $this->baseUrl = $baseUrl;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->cetificate = $cetificate;
    }
}