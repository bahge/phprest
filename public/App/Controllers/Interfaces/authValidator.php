<?php


namespace App\Controllers\Interfaces;

interface authValidator
{
    /**
     * @Description Inteface de contrato para a implementação da função de autenticação básica por http
     * @param $user
     * @param $pass
     * @return bool
     */
    public function is_authenticated($user, $pass): bool;
}