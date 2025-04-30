<?php
require 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$carrinho = json_decode($_POST['carrinho_json'], true);

if (!$carrinho || count($carrinho) == 0) {
    die("Carrinho vazio.");
}

try {
    $pdo->beginTransaction();

    // Inserir cliente
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, email) VALUES (?, ?)");
    $stmt->execute([$nome, $email]);
    $cliente_id = $pdo->lastInsertId();

    // Inserir itens do carrinho
    $stmt = $pdo->prepare("INSERT INTO pedidos (cliente_id, produto, preco) VALUES (?, ?, ?)");
    foreach ($carrinho as $item) {
        $stmt->execute([$cliente_id, $item['produto'], $item['preco']]);
    }

    $pdo->commit();

    echo "<h1>Compra finalizada com sucesso!</h1>";
    echo "<p>Obrigado, $nome! Seus dados foram salvos.</p>";

} catch (Exception $e) {
    $pdo->rollBack();
    die("Erro ao salvar: " . $e->getMessage());
}
?>
