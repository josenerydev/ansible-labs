<?php
include 'includes/config.php';

$response = [];

if (isset($_GET['dir']) && isset($directories[$_GET['dir']])) {
    $dir = $directories[$_GET['dir']];
    // Verifica se o diretório existe e é legível
    if (is_dir($dir) && is_readable($dir)) {
        // Obter a lista de arquivos, excluindo os diretórios especiais "." e ".."
        $files = array_values(array_diff(scandir($dir), ['.', '..']));
        $response = $files;
    } else {
        $response = ['error' => 'Diretório não encontrado ou não é legível.'];
    }
} else {
    $response = ['error' => 'Diretório inválido.'];
}

header('Content-Type: application/json');
echo json_encode($response);
