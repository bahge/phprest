<?php


namespace App\Controllers\Interfaces;


interface httpValidation
{
    /**
     * @Description Interface de contrato da função que validará os métodos http
     * @return bool
     */
    public function is_method_valid(): bool;
}