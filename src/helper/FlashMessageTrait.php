<?php

namespace Assuncaovictor\Leilao\Helper;


trait FlashMessageTrait
{
    /**
     * @param string $tipo deve receber uma classe de Bootstrap error ou success
     * @param string $mensagem deve receber a mensagem que acompanha o tipo da operação 
     * @param string $input deve receber o input se esse existir 
     */

    public function defineMensagem(string $tipo, string $mensagem, string $input = 'mensagem'): void
    {
        $_SESSION[$input] = [
            'mensagem' => $mensagem,
            'erro' => $tipo
        ];
    }
}
