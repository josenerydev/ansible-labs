<?php
include 'includes/header.php';
include 'includes/server_info.php'; // Exibe informações do servidor

$dirKey = basename(__FILE__, '.php'); 
$directories = [
    'page_download' => '/download',
    'page_upload'   => '/var/upload',
    'page_eproc'    => '/var/www/eproc_tmp'
];

$dirPath = $directories[$dirKey] ?? null;
if (!$dirPath) die("Diretório inválido.");
?>

<h1 class="mb-4">Arquivos em <?= htmlspecialchars($dirPath) ?></h1>

<!-- Formulário de Upload -->
<form id="upload-form">
    <input type="file" name="file" required>
    <input type="hidden" name="dir" value="<?= htmlspecialchars($dirKey) ?>">
    <button type="submit" class="btn btn-primary">Upload</button>
</form>

<!-- Lista de Arquivos -->
<h2 class="mt-4">Lista de Arquivos</h2>
<ul id="file-list" class="list-group"></ul>

<script>
    function loadFiles() {
        fetch('list_files.php?dir=<?= $dirKey ?>')
            .then(response => response.json())
            .then(files => {
                let html = files.map(file => `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        ${file}
                        <div>
                            <a href="download.php?dir=<?= $dirKey ?>&file=${file}" class="btn btn-sm btn-success">Download</a>
                            <a href="delete.php?dir=<?= $dirKey ?>&file=${file}" class="btn btn-sm btn-danger" onclick="return confirm('Deletar?')">Deletar</a>
                        </div>
                    </li>
                `).join('');
                document.getElementById('file-list').innerHTML = html;
            });
    }

    document.getElementById('upload-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        fetch('upload.php', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                loadFiles();
            });
    });

    loadFiles();
</script>

<?php include 'includes/footer.php'; ?>
