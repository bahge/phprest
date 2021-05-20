<?php


namespace App\Controllers;


class httpResponse
{
    private string $header;

    /**
     * @Description Função que monta o retorno da resposta http para métodos desabilitados
     * @param bool $is_invalid
     * @param array $message => mensagem que será encodada para o json
     * @return array
     */
    public function is_invalid_method(bool $is_invalid, array $message): array
    {
        $this->header = 'WWW-Authenticate: Basic';
        $this->header .= 'Content-Type: application/json';
        if ($is_invalid == true) $this->header .= 'HTTP/1.0 405 Method Not Allowed';
        return ['header' => $this->header, 'Mensagem' => [$message]];
    }

    /**
     * @Description Função que monta o retorno da resposta http para usuários inválidados
     * @param bool $is_invalid
     * @param array $message => mensagem que será encodada para o json
     * @return array
     */
    public function is_invalid_user(bool $is_invalid, array $message): array
    {
        $this->header = 'WWW-Authenticate: Basic';
        $this->header .= 'Content-Type: application/json';
        if ($is_invalid == true) $this->header .= 'HTTP/1.0 401 Unauthorized';
        return ['header' => $this->header, 'Mensagem' => [$message]];
    }

    /**
     * @Description Função que monta o retorno da resposta http para methodos válidos
     * @param array $message => mensagem que será encodada para o json
     * @return array
     */
    public function is_valid_method(string $message): array
    {
        $this->header = 'WWW-Authenticate: Basic';
        $this->header .= ' Content-Type: application/json';
        return ['header' => $this->header, 'msg' => [$message]];
    }
}