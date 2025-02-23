<?php include 'includes/config.php';

$response = ['status' => 'error', 'message' => 'Erro ao fazer upload.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_POST['dir'])) {
    $dirKey = $_POST['dir'];
    if (isset($directories[$dirKey])) {
        $targetFile = $directories[$dirKey] . '/' . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $response = ['status' => 'success', 'message' => "Upload feito com sucesso."];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
