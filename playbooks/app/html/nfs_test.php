<?php
// Processamento do upload
$uploadMsg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_POST['path'])) {
    $uploadPath = rtrim($_POST['path'], '/');
    $targetFile = $uploadPath . '/' . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        $uploadMsg = "Upload feito com sucesso para {$uploadPath}";
    } else {
        $uploadMsg = "Erro ao fazer upload para {$uploadPath}";
    }
}

// Processamento do download
if (isset($_GET['download']) && isset($_GET['path']) && isset($_GET['file'])) {
    $downloadPath = rtrim($_GET['path'], '/');
    $filename = basename($_GET['file']);
    $filepath = $downloadPath . '/' . $filename;
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "Arquivo não encontrado!";
        exit;
    }
}

// Processamento do delete
$deleteMsg = '';
if (isset($_GET['delete']) && isset($_GET['path']) && isset($_GET['file'])) {
    $deletePath = rtrim($_GET['path'], '/');
    $filename = basename($_GET['file']);
    $filepath = $deletePath . '/' . $filename;
    if (file_exists($filepath)) {
        if (unlink($filepath)) {
            $deleteMsg = "Arquivo '{$filename}' deletado com sucesso de {$deletePath}";
        } else {
            $deleteMsg = "Erro ao deletar arquivo '{$filename}' de {$deletePath}";
        }
    } else {
        $deleteMsg = "Arquivo '{$filename}' não encontrado!";
    }
}

// Função para listar os arquivos de um diretório
function listFiles($dir) {
    $files = [];
    if (is_dir($dir)) {
        $dirFiles = scandir($dir);
        foreach ($dirFiles as $file) {
            if ($file !== '.' && $file !== '..' && is_file($dir . '/' . $file)) {
                $files[] = $file;
            }
        }
    }
    return $files;
}

// Lista de diretórios para teste
$directories = [
    '/download',
    '/var/upload',
    '/var/www/eproc_tmp'
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFS Volume Test</title>
    <!-- Inclusão do Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar de navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Ansible Labs</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
         aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" href="index.php">Request Debug</a>
             </li>
             <li class="nav-item active">
                 <a class="nav-link" href="nfs_test.php">NFS Test <span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="error.php">Error</a>
             </li>
         </ul>
      </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar com informações do servidor -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Informações do Servidor
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Server IP:</strong> <?= htmlspecialchars($_SERVER['SERVER_ADDR'] ?? 'Not Available') ?>
                        </li>
                        <li class="list-group-item">
                            <strong>Server Name:</strong> <?= htmlspecialchars($_SERVER['SERVER_NAME'] ?? 'Not Available') ?>
                        </li>
                        <li class="list-group-item">
                            <strong>Server Port:</strong> <?= htmlspecialchars($_SERVER['SERVER_PORT'] ?? 'Not Available') ?>
                        </li>
                        <li class="list-group-item">
                            <strong>Document Root:</strong> <?= htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? 'Not Available') ?>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Conteúdo principal -->
            <div class="col-md-9">
                <h1 class="mb-4">Teste de Volumes NFS</h1>

                <!-- Mensagens de upload e delete -->
                <?php if (!empty($uploadMsg)): ?>
                    <div class="alert alert-info" role="alert">
                        <?= htmlspecialchars($uploadMsg) ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($deleteMsg)): ?>
                    <div class="alert alert-warning" role="alert">
                        <?= htmlspecialchars($deleteMsg) ?>
                    </div>
                <?php endif; ?>

                <!-- Verificação dos diretórios -->
                <div class="card mb-4">
                    <div class="card-header">
                        Verificando Diretórios
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($directories as $dir): ?>
                            <li class="list-group-item">
                                <?= htmlspecialchars($dir) ?>: <?= is_dir($dir) ? '<span class="text-success">✅ Existe</span>' : '<span class="text-danger">❌ Não encontrado</span>' ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Para cada diretório, formulário de upload e listagem de arquivos -->
                <?php foreach ($directories as $dir): ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            Upload para <?= htmlspecialchars($dir) ?>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="path" value="<?= htmlspecialchars($dir) ?>">
                                <div class="form-group">
                                    <label for="file_<?= md5($dir) ?>">Selecione o arquivo:</label>
                                    <input type="file" class="form-control-file" id="file_<?= md5($dir) ?>" name="file" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <h5>Arquivos em <?= htmlspecialchars($dir) ?></h5>
                            <ul class="list-group">
                                <?php
                                $files = listFiles($dir);
                                if (count($files) > 0):
                                    foreach ($files as $file):
                                        $downloadUrl = "?download=1&path=" . urlencode($dir) . "&file=" . urlencode($file);
                                        $deleteUrl = "?delete=1&path=" . urlencode($dir) . "&file=" . urlencode($file);
                                ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= htmlspecialchars($file) ?>
                                        <div>
                                            <a href="<?= $downloadUrl ?>" class="btn btn-sm btn-success mr-2">Download</a>
                                            <a href="<?= $deleteUrl ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar este arquivo?');">Deletar</a>
                                        </div>
                                    </li>
                                <?php endforeach; else: ?>
                                    <li class="list-group-item">Nenhum arquivo encontrado.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Inclusão do Bootstrap JS e dependências (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
