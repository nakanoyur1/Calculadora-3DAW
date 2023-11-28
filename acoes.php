<?php
include 'conexao.php';

function listarCandidatos() {
  global $conn;
  $sql = "SELECT * FROM candidatos ORDER BY nome, sala_de_prova";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Nome: " . $row["nome"]. " - Sala de Prova: " . $row["sala_de_prova"]. "<br>";
    }
  } else {
    echo "0 results";
  }
}

function incluirFiscal($nome, $cpf, $sala_de_prova) {
  global $conn;
  $sql = "INSERT INTO fiscais (nome, cpf, sala_de_prova) VALUES ('$nome', '$cpf', $sala_de_prova)";

  if ($conn->query($sql) === TRUE) {
    echo "Fiscal incluído com sucesso";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

function alterarSalaDeProva($id, $sala_de_prova) {
  global $conn;
  $sql = "UPDATE candidatos SET sala_de_prova=$sala_de_prova WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    echo "Sala de prova alterada com sucesso";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $action = $_POST['action'];
  if ($action == 'incluirFiscal') {
    incluirFiscal($_POST['nome'], $_POST['cpf'], $_POST['sala_de_prova']);
  } elseif ($action == 'listarCandidatos') {
    listarCandidatos();
  } elseif ($action == 'alterarSalaDeProva') {
    alterarSalaDeProva($_POST['id'], $_POST['sala_de_prova']);
  }
}

$conn->close();
?>
