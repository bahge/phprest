<?php
namespace App\Controllers;

/**
 * Class checkAutentication
 * @Description Classe responsável por verificar se foi enviada a autenticação de usuário na requisição http,
 * ela é responsável por enviar um array com o usuário e a senha se existir para a verificação de autenticidade.
 * @package App\Controllers
 */
class checkAutentication
{
    private $user;
    private errorBuilder $error;

    /**
     * @Description A função retorna se há ou não o envio da autenticação do usuário, caso exista ela envia o
     * usuário para que seja enviado para a autenticação, caso contrário um erro é criado para uso na aplicação.
     * @return bool
     */
    public function is_sent(): bool
    {
        if (isset($_SERVER['PHP_AUTH_USER']) == true){
            $this->user = ['user' => $_SERVER['PHP_AUTH_USER'], 'pass' => $_SERVER['PHP_AUTH_PW']];
            return true;
        } else {
            $this->error = new errorBuilder();
            $this->error->buildError(3, "Não foi enviada uma autenticação válida");
            return false;
        }
    }

    /**
     * @Description Captura o erro criado e disponibiliza para outras classes.
     * @return errorBuilder
     */
    public function getError(): errorBuilder
    {
        return $this->error;
    }

    /**
     * @Description Captura o usuário e senha enviado na autenticação e disponibiliza para outra classe.
     * @return array
     */
    public function getUser(): array
    {
        return $this->user;
    }
}