<?php

namespace Assuncaovictor\Leilao\Helper;

trait RenderizaHtml
{
    /**
     * @param string $caminho recebe o nome do arquivo contino na pasta paginas localizada dentro da view
     * @param array $dados recebe todos os dados PHP que a página vai carregar, impedindo que dados indesejados sejam vistos pelo usuário
     * @return string Responsavel por passar todo o HTML da página
     */
    public function renderizaHtml(string $caminho, array $dados): string
    {
        extract($dados);
        ob_start();
        require __DIR__ . "/../view/paginas/$caminho";
        $html = ob_get_clean();
        return $html;
    }
}
