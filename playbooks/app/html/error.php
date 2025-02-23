<?php
// error.php - Página de erro intencional para testes
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error Page</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- Navbar de navegação -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Ansible Labs</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Request Debug</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="nfs_test.php">NFS Test</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="error.php">Error <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="container mt-5">
    <h1 class="text-center mb-4">Error Page</h1>
    <div class="alert alert-danger" role="alert">
      Erro intencional: código 500 gerado para testes!
    </div>
  </div>
  
  <!-- Bootstrap JS Bundle CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  
  <?php
  // Força um erro fatal para testes (após exibir o menu e a mensagem)
  non_existent_function();
  ?>
</body>
</html>
