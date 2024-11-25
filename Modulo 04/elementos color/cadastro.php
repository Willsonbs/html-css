<?php
// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os valores enviados pelo formulário
    $cor = $_POST['color'] ?? null;
    $range = $_POST['range'] ?? null;
    
    // Verifica se o arquivo foi enviado
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto'];

        // Diretório onde o arquivo será salvo
        $diretorioDestino = 'uploads/';
        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0777, true);
        }

        // Caminho completo para salvar o arquivo
        $caminhoArquivo = $diretorioDestino . basename($foto['name']);

        // Move o arquivo enviado para o diretório destino
        if (move_uploaded_file($foto['tmp_name'], $caminhoArquivo)) {
            echo "<p>Arquivo enviado com sucesso: <a href='$caminhoArquivo'>" . htmlspecialchars($foto['name']) . "</a></p>";
        } else {
            echo "<p>Erro ao salvar o arquivo.</p>";
        }
    } else {
        echo "<p>Nenhum arquivo enviado ou houve um erro.</p>";
    }

    // Exibe os valores
    echo "<p>Cor escolhida: " . htmlspecialchars($cor) . "</p>";
    echo "<p>Valor do range: " . htmlspecialchars($range) . "</p>";
} else {
    echo "<p>Método inválido. Acesse a página pelo formulário.</p>";
}
?>