<?php
// stand/index.php
session_start();
include("includes/db_conn.php");


$sql = "SELECT * FROM automoveis";
$query = $conn->prepare($sql);
$query->execute();
$result= $query->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    }
} else {
    echo "Nenhum automóvel encontrado.";
}
var_dump($row);

?>



<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stand de Automóveis</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Topo -->
  <header>
    <div class="logo">STAND AUTO</div>
  </header>

  <!-- Estrutura principal -->
  <div class="container">
    <!-- Menu lateral -->
    <aside class="filtros">
      <h2>Filtros</h2>

      <label for="marca">Marca</label>
      <select id="marca">
        <option>Escolha uma marca</option>
        <option value=""></option>
      </select>

      <label for="combustivel">Combustível</label>
      <select id="combustivel">
        <option>Escolha um combustível</option>
      </select>

      <label for="preco">Preço</label>
      <div class="range">
        <input type="number" placeholder="Desde">
        <input type="number" placeholder="Até">
      </div>

      <label for="ano">Ano</label>
      <div class="range">
        <input type="number" placeholder="Desde">
        <input type="number" placeholder="Até">
      </div>

      <label for="km">Quilómetros</label>
      <div class="range">
        <input type="number" placeholder="Desde">
        <input type="number" placeholder="Até">
      </div>

      <label for="estado">Estado</label>
      <select id="estado">
        <option>Usado</option>
        <option>Novo</option>
      </select>
    </aside>

    <!-- Área principal -->
    <main class="listagem">
      <h2>Carros disponíveis</h2>

      <div class="carro-box">
        <!-- Todos os carros -->
        <p>CARRO</p>
      </div>
    </main>
  </div>
</body>
</html>