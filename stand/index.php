<?php
include("includes/db_conn.php"); // Inclui o ficheiro de ligação à base de dados

// Função segura para puxar dados da base
function get_data($conn, $table, $column = null) {
    // Tabelas permitidas
    $allowed_tables = ['automoveis'];
    // Colunas permitidas
    $allowed_columns = ['marca', 'caixa', 'modelo', 'ano_lancamento', 'condicao', 'tipo_combustivel', 'preco'];

    // Verifica se a tabela é válida
    if (!in_array($table, $allowed_tables)) {
        die("Tabela inválida!");
    }

    // Se foi passada uma coluna específica
    if ($column !== null) {
        // Verifica se a coluna é válida
        if (!in_array($column, $allowed_columns)) {
            die("Coluna inválida!");
        }
        // Seleciona valores distintos dessa coluna e ordena
        $sql = "SELECT DISTINCT $column FROM $table ORDER BY $column ASC";
    } else {
        // Se não for coluna específica, seleciona todos os dados
        $sql = "SELECT * FROM $table";
    }

    $query = $conn->prepare($sql); // Prepara a query
    $query->execute(); // Executa a query
    return $query->get_result(); // Retorna os resultados
}

// Puxar dados distintos para preencher os selects do filtro
$marcas = get_data($conn, 'automoveis', 'marca');
$caixas = get_data($conn, 'automoveis', 'caixa');
$combustiveis = get_data($conn, 'automoveis', 'tipo_combustivel');
$modelos = get_data($conn, 'automoveis', 'modelo');

// Puxar todos os carros para mostrar na listagem
$carros = get_data($conn, 'automoveis');
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stand de Automóveis</title>
  <link rel="stylesheet" href="assets/css/style.css"> <!-- Ligação ao CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <!-- Cabeçalho do site -->
  <header>
    <div class="logo">STAND AUTO</div>
  </header>

  <div class="container">
    <!-- Menu lateral com filtros -->
    <aside class="filtros">
      <h2>Filtros</h2>

      <!-- Select Marca -->
      <label for="marca">Marca</label>
      <select id="marca" name="marca">
        <option value="">Escolha uma marca</option>
        <?php while($row = $marcas->fetch_assoc()): ?>
          <option value="<?= htmlspecialchars($row['marca']) ?>"><?= htmlspecialchars($row['marca']) ?></option>
        <?php endwhile; ?>
      </select>

      <!-- Select Caixa -->
      <label for="caixa">Caixa</label>
      <select id="caixa" name="caixa">
        <option value="">Escolha a caixa</option>
        <?php while($row = $caixas->fetch_assoc()): ?>
          <option value="<?= htmlspecialchars($row['caixa']) ?>"><?= htmlspecialchars($row['caixa']) ?></option>
        <?php endwhile; ?>
      </select>

      <!-- Select Combustível -->
      <label for="combustivel">Combustível</label>
      <select id="combustivel" name="combustivel">
        <option value="">Escolha um combustível</option>
        <?php while($row = $combustiveis->fetch_assoc()): ?>
          <option value="<?= htmlspecialchars($row['tipo_combustivel']) ?>"><?= htmlspecialchars($row['tipo_combustivel']) ?></option>
        <?php endwhile; ?>
      </select>

      <!-- Select Modelo -->
      <label for="modelo">Modelo</label>
      <select id="modelo" name="modelo">
        <option value="">Escolha o modelo</option>
        <?php while($row = $modelos->fetch_assoc()): ?>
          <option value="<?= htmlspecialchars($row['modelo']) ?>"><?= htmlspecialchars($row['modelo']) ?></option>
        <?php endwhile; ?>
      </select>

      <!-- Inputs de preço -->
      <label for="preco">Preço</label>
      <div class="range">
        <input type="number" placeholder="Desde">
        <input type="number" placeholder="Até">
      </div>

      <!-- Inputs de ano -->
      <label for="ano">Ano</label>
      <div class="range">
        <input type="number" placeholder="Desde">
        <input type="number" placeholder="Até">
      </div>

      <!-- Inputs de quilómetros -->
      <label for="km">Quilómetros</label>
      <div class="range">
        <input type="number" placeholder="Desde">
        <input type="number" placeholder="Até">
      </div>

      <!-- Select Condição -->
      <label for="condicao">Condição</label>
      <select id="condicao" name="condicao">
        <option value="Usado">Usado</option>
        <option value="Novo">Novo</option>
      </select>

      <!-- Botão para aplicar filtros -->
      <button type="button">Aplicar Filtros</button>
    </aside>

    <!-- Área principal para mostrar os carros -->
    <main class="listagem">
      <h2>Carros disponíveis</h2>

      <?php if($carros->num_rows > 0): ?>
        <?php while($row = $carros->fetch_assoc()): ?>

              <div class="carro-box">
            <div class="carro-img">
              <img src="assets/carros/<?= htmlspecialchars($row['img']) ?>" alt="<?= htmlspecialchars($row['modelo']) ?>">
            </div>

            <div class="carro-info">
              <div class="carro-topo">
                <div class="carro-titulos">
                  <h3><?= htmlspecialchars($row['marca']) ?> <?= htmlspecialchars($row['modelo']) ?></h3>
                  <p class="versao"><?= htmlspecialchars($row['caixa']) ?> 
                </div>
                <div class="carro-preco">
                  €<?= number_format($row['preco'], 0, ',', '.') ?>
                </div>
              </div>

              <div class="carro-detalhes">
                <div class="item">
                  <i class="fa-solid fa-gas-pump"></i>
                  <span><?= htmlspecialchars($row['tipo_combustivel']) ?></span>
                </div>
                <div class="item">
                  <i class="fa-solid fa-calendar"></i>
                  <span><?= htmlspecialchars($row['ano_lancamento']) ?></span>
                </div>
                <div class="item">
                  <i class="fa-solid fa-road"></i>
                  <span><?= number_format($row['quilometros'], 0, ',', '.') ?> km</span>
                </div>
              </div>
            </div>
          </div>

        <?php endwhile; ?>
      <?php else: ?>
        <p>Nenhum automóvel encontrado.</p>
      <?php endif; ?>
    </main>
  </div>
</body>
<script src="assets/js/scripts.js"></script>
</html>
