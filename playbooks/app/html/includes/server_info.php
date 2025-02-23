<div class="card mb-4">
    <div class="card-header bg-info text-white">
        Informações do Servidor
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>Server IP:</strong> <?= htmlspecialchars($_SERVER['SERVER_ADDR'] ?? 'Not Available') ?></li>
        <li class="list-group-item"><strong>Server Name:</strong> <?= htmlspecialchars($_SERVER['SERVER_NAME'] ?? 'Not Available') ?></li>
        <li class="list-group-item"><strong>Server Port:</strong> <?= htmlspecialchars($_SERVER['SERVER_PORT'] ?? 'Not Available') ?></li>
        <li class="list-group-item"><strong>Client IP:</strong> <?= htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? 'Not Available') ?></li>
        <li class="list-group-item"><strong>Forwarded For:</strong> <?= htmlspecialchars($_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'Not Available') ?></li>
        <li class="list-group-item"><strong>Document Root:</strong> <?= htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? 'Not Available') ?></li>
    </ul>
</div>
