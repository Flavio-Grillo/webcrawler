<?php

// Obtém o conteúdo HTML da página 
$html = file_get_contents('https://www.imdb.com/chart/top/');

// Suprime possíveis erros HTML durante o processamento
libxml_use_internal_errors(true);

// Cria um novo objeto DOMDocument para analisar o HTML
$domDocument = new DOMDocument();
$domDocument->loadHTML($html);

// Obtém todos os elementos <h3> do documento HTML 
$linkTags = $domDocument->getElementsByTagName("h3");

// Inicializa uma variável vazia para armazenar dados 
$linkList = '';

// Loop que percorre cada elemento <h3>
foreach ($linkTags as $link) {

    // Verifica se o elemento <h3> possui um atributo de classe.
    if (strpos($link->getAttribute('class'), 'ipc-title__text') === 0) {
        // Se possuir, adiciona o conteúdo de texto à variável $linkList
        $linkList .= $link->textContent . "\n";
    }
}

// Salva os dados obtidos em um arquivo de texto
file_put_contents("dados_obtidos.txt", $linkList);

?>
