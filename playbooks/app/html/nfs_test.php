<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFS Volume Test</title>
</head>
<body>
    <h1>Teste de Volumes NFS</h1>

    <h2>Verificando Diretórios</h2>
    <ul>
        <li>/download: <?= is_dir('/download') ? '✅ Existe' : '❌ Não encontrado' ?></li>
        <li>/var/upload: <?= is_dir('/var/upload') ? '✅ Existe' : '❌ Não encontrado' ?></li>
        <li>/var/www/eproc_tmp: <?= is_dir('/var/www/eproc_tmp') ? '✅ Existe' : '❌ Não encontrado' ?></li>
    </ul>

    <h2>Testando Escrita</h2>
    <?php
    $testFiles = [
        '/download/teste_nfs.txt',
        '/var/upload/teste_nfs.txt',
        '/var/www/eproc_tmp/teste_nfs.txt'
    ];

    foreach ($testFiles as $file) {
        $result = @file_put_contents($file, "Arquivo de teste NFS - " . date("Y-m-d H:i:s") . "\n");
        echo "<p>" . htmlspecialchars($file) . ": " . ($result ? "✅ Criado com sucesso" : "❌ Falha ao escrever") . "</p>";
    }
    ?>
</body>
</html>
