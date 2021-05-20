<?php


namespace App\Controllers;


use App\Models\error;

class errorBuilder implements Interfaces\errorMessage
{
    private $error;
    /**
     * @Description Funcão de construção do erro da aplicação leva o número do erro e a mensagem de erro.
     * @return void
     */
    public function buildError(int $numerror, string $strerror): void
    {
        $this->error = new error();
        $this->error->numError = $numerror;
        $this->error->strError = $strerror;
    }

    /**
     * @Description Funcão de retorno do parâmetro erro privado.
     * @return error
     */
    public function getError(): error
    {
        return $this->error;
    }
}