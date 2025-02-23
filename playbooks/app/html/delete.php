<?php include 'includes/config.php';

$response = ['status' => 'error', 'message' => 'Erro ao deletar arquivo.'];

if (isset($_GET['dir']) && isset($_GET['file']) && isset($directories[$_GET['dir']])) {
    $filepath = $directories[$_GET['dir']] . '/' . basename($_GET['file']);
    if (file_exists($filepath) && unlink($filepath)) {
        $response = ['status' => 'success', 'message' => "Arquivo deletado com sucesso."];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
