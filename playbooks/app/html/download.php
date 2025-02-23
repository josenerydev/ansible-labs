<?php include 'includes/config.php';

if (isset($_GET['dir']) && isset($_GET['file']) && isset($directories[$_GET['dir']])) {
    $filepath = $directories[$_GET['dir']] . '/' . basename($_GET['file']);

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    }
}

die("Arquivo não encontrado.");
?>
