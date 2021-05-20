<?php


namespace App\Controllers\Interfaces;

use App\Models\error;

interface errorMessage
{
    /**
     * @Description Interface para manipulação de erros, ela cria um modelo de erro e é instanciada para retornar
     * erros em funções com retornam booleano.
     * @param int $numerror
     * @param string $strerror
     */
    public function buildError(int $numerror, string $strerror): void;

    /**
     * @Description Retorna um error model que pode verificar o número do erro e a mensagem personalizada.
     * @return error
     */
    public function getError(): error;
}