<?php 
include 'includes/config.php';

$response = ['status' => 'error', 'message' => 'Erro ao fazer upload.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_POST['dir'])) {
    $dirKey = $_POST['dir'];
    if (isset($directories[$dirKey])) {
        $uploadDir = $directories[$dirKey];
        $originalName = basename($_FILES['file']['name']);
        $uniqueName = uniqid() . '-' . $originalName;
        $targetFile = $uploadDir . '/' . $uniqueName;
        
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $response = ['status' => 'success', 'message' => "Upload feito com sucesso."];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
