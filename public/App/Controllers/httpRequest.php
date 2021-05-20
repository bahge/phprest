<?php

namespace App\Controllers;

use App\Controllers\Interfaces\errorMessage;
use App\Controllers\Interfaces\httpValidation;
use App\Controllers\Interfaces\authValidator;
use App\Models\error;

class httpRequest implements httpValidation
{
    private string $httpMethod;
    private errorBuilder $error;
    private array $enabledmethods;
    private httpResponse $httpResponse;

    public function __construct($param, $methods)
    {
        $this->setHttpMethod($param);
        $this->enabledmethods = $methods;
        $this->error = new errorBuilder();
        $this->httpResponse = new httpResponse();
    }

    /**
     * @Description Função que implementa o contrato de validação dos métodos
     * @return bool
     */
    public function is_method_valid(): bool
    {
        return $this->enabledmethods[$this->getHttpMethod()];
    }


    /**
     * @Description  Função que verifica a autenticação da usuário, após verificar que o método é válido e que foi
     * enviaao um usuário na requisição http
     * @param $credentials
     */
    public function verify_authentication($credentials)
    {
        if ($this->is_method_valid() == true) {

            $checkAutentication = new checkAutentication();

            if ($checkAutentication->is_sent() == true) {
                $user = $checkAutentication->getUser();
                $httpAutentication = new httpAutentication($credentials);

                if ($httpAutentication->is_authenticated($user['user'], $user['pass'])) {
                    // Checar o e-mail e construir
                    echo "Usuário existe";
                    exit;

                } else {
                    $this->error = $httpAutentication->getError();
                    $ret = $this->httpResponse->is_invalid_user(
                        true,
                        ["Erro" => $this->error->getError()->strError]
                    );
                }

            } else {
                $this->error = $checkAutentication->getError();
                $ret = $this->httpResponse->is_invalid_user(
                    true,
                    ["Erro" => $this->error->getError()->strError]);
            }

        } else {
            $ret = $this->httpResponse->is_invalid_method(
                true,
                ["Erro" => "O método solicitado não está disponível."]);
        }
        header($ret['header']);
        echo json_encode($ret['Mensagem']);
    }

    /**
     * @return String
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * @param String $httpMethod
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * @return errorBuilder
     */
    public function getError(): errorBuilder
    {
        return $this->error;
    }
}
