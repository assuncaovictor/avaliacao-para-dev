<?php

namespace Assuncaovictor\Leilao\Helper;


trait RetornaInput
{
    /**
     * @param string $tipo deve receber uma classe de Bootstrap error ou success
     * @param string $mensagem deve receber a mensagem que acompanha o tipo da operação 
     */
    public function retornaInput(string $input, string $valor): void
    {
        $_SESSION['input'][$input] = $valor;
    }
}
