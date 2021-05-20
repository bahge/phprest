<?php


namespace App\Controllers;

use App\Models\error;

class httpAutentication implements Interfaces\authValidator
{
    protected $users;
    private errorBuilder $error;

    public function __construct($credenciais)
    {
        $this->setUsers($credenciais);
        $this->error = new errorBuilder();
    }

    /**
     * @Description Função que verifica se o usuário e senha enviados pode ser autenticado, implementa uma mensagem
     * de erro se esse usuário está cadastrado e se sua senha está correta.
     * @param $user => nome do usuário
     * @param $pass => senha do usuário
     * @return bool
     */
    public function is_authenticated($user, $pass): bool
    {
        if (array_key_exists($user, $this->getUsers())) {
            if ($this->getUsers()[$user] == $pass) {
                return true;
            } else {
                $this->error->buildError(1, "A senha está incorreta");
                return false;
            }
        } else {
            $this->error->buildError(2, "O usuário não existe");
            return false;
        }
    }

    /**
     * @Description Função Getter que retorna os parâmetros do usuário.
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @Description Função Setter que aplica os parâmetros do usuário
     * @param array $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }

    /**
     * @Description Função Getter de retorno do erro.
     * @return errorBuilder
     */
    public function getError(): errorBuilder
    {
        return $this->error;
    }
}