<?php
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="./View/css/login.css" />
  <title>Editar Usuario</title>
</head>

<body>
  <div class="login">
    <h2>Senac - Taboão da Serra</h2>
    <h1>
      <p> Editar Usuario </p>
    </h1>
    <input type="hidden" id="textID" value="<?php echo $id; ?>" />
    <label for="name">Nome
      <input type="name" name="Nome" id="textNome" />
    </label>
    <label for="dataNasc">Data de Nascimento
      <input type="date" name="dataNasc" id="dataNasc" />
    </label>
    <label for="email">E-mail
      <input type="email" name="Email" id="textEmail" />
    </label>
    <label for="Telefone">Telefone
      <input type="tel" name="Telefone" id="textTelefone" />
    </label>
    <div class="botao">
      <a href="#">
        <input type="submit" value="Cancel" id="cancelarBtn" />
      </a>
      <a href="#">
        <input type="submit" value="Editar" id="editarBtn" />
      </a>
    </div>
  </div>
</body>
<script src="View/js/jquery-3.6.0.min.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8">
  async function carregarDados(id) {
    const config = {
      method: "post",
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ textID: id })
    };

    const request = await fetch('Controller/Usuarios/listarPeloID.php', config);
    
    const response = await request.json();
    const { dados } = response;
   
    $('#textNome').val(dados[0].nome_completo);
    $('#dataNasc').val(dados[0].data_nasc);
    $('#textEmail').val(dados[0].email);
    $('#textTelefone').val(dados[0].telefone);
  }

  async function editarUsuario(e) {
    const textNome = $('#textNome').val();
    const dataNasc = $('#dataNasc').val();
    const textEmail = $('#textEmail').val();
    const textTelefone = $('#textTelefone').val();
    const textID = $('#textID').val();
    const config = {
      method: "post",
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        nome: textNome,
        dataNasc: dataNasc,
        email: textEmail,
        telefone: textTelefone,
        id: textID
      })
    };

    const request = await fetch('Controller/Usuarios/EditarUsuario.php', config);
    const resultado = await request.json();
    if (resultado.status === 1) {
      Swal.fire('dados atualizados com sucesso').then(res => window.location.href = 'usuarios.html');
    } else {
      Swal.fire('Verifique as informações');
    }
  }
  $(document).ready(async function () {
    await carregarDados(<?php echo $id; ?>);

    $('#editarBtn').on('click', async function (e) {
      await editarUsuario(e);
    });
    $('#cancelarBtn').on('click', function () {
      window.location.href = 'usuarios.html';
    });
  });


</script>

</html>