<?php include_once '../app/views/inc/header.php'?>

<div class="container mt-5">
  <h1>Administradores</h1>
  <table class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombres</th>
        <th scope="col">DNI</th>
        <th scope="col">Dirección</th>
        <th scope="col">Telefono</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['administradores'] as $admin) : ?>
        <tr>
          <td><?=$admin['idAdm']?></td>
          <td><?=$admin['nombres']?></td>
          <td><?=$admin['dni']?></td>
          <td><?=$admin['direccion']?></td>
          <td><?=$admin['telefono']?></td>
        </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>

<?php include_once '../app/views/inc/footer.php' ?>