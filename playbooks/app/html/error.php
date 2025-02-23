<?php
// Força um erro fatal em tempo de execução
http_response_code(500);
echo "Erro intencional: código 500 gerado para testes!";

// Causa um erro fatal chamando uma função inexistente
non_existent_function();
?>
