<?php

use App\Models\Conteudo;
use Illuminate\Support\HtmlString;

/*
 | Funções usadas nas views do site para mostrar o conteúdo editado no painel.
 | Se o campo não foi alterado, aparece o texto original (config/conteudo.php).
 */

if (!function_exists('conteudo')) {
    // Texto simples: {{ conteudo('home.agenda.titulo') }}
    function conteudo(string $chave): string
    {
        return Conteudo::valor($chave);
    }
}

if (!function_exists('conteudo_html')) {
    // Texto com destaque: *palavra* vira <em>, **palavra** vira <strong> e a quebra de linha vira <br>.
    // O resto é escapado, então ninguém consegue colocar HTML pelo painel.
    function conteudo_html(string $chave): HtmlString
    {
        $texto = e(Conteudo::valor($chave));
        $texto = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $texto);
        $texto = preg_replace('/\*(.+?)\*/s', '<em>$1</em>', $texto);

        return new HtmlString(nl2br($texto, false));
    }
}

if (!function_exists('conteudo_img')) {
    // URL da imagem: {{ conteudo_img('home.destaque.imagem') }}
    function conteudo_img(string $chave): string
    {
        $caminho = Conteudo::valor($chave);

        return preg_match('#^https?://#', $caminho) ? $caminho : asset($caminho);
    }
}

if (!function_exists('conteudo_link')) {
    // Link de botão: aceita endereço completo (https://, mailto:, tel:, #âncora) ou caminho do site (cardapio, pedidos)
    function conteudo_link(string $chave): string
    {
        $link = trim(Conteudo::valor($chave));

        return preg_match('#^([a-z]+:|\#)#i', $link) ? $link : url($link);
    }
}

if (!function_exists('conteudo_lista')) {
    // Campo de várias linhas usado como lista (uma opção por linha)
    function conteudo_lista(string $chave): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', Conteudo::valor($chave)))));
    }
}
