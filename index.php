<?php
session_start();
if (!isset($_SESSION['nombre'])) {
  header('Location:login.php');
} elseif (isset($_SESSION['nombre'])) {
  include './config/conexion.php';
  $sentencia = $bd->query(("SELECT * FROM usuario"));
  $usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);

  $sentencia = $bd->query("SELECT * FROM vehiculos");
  $vehiculos = $sentencia->fetchAll(PDO::FETCH_OBJ);

  $sentencia = $bd->query("SELECT * FROM marca");
  $marcas = $sentencia->fetchAll(PDO::FETCH_OBJ);
} else {
  echo "ERROR DEL SISTEMA";
}
?>

<DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="./img/icon.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Vehículos</title>
  </head>

  <body>
    <nav class="navbar bg-dark " data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Bienvenido:
          <?php echo $_SESSION['nombre'] ?>
        </a>

        <!--  CERRAR SESSION -->

        <form action="salir.php" method="post">
          <button class="navbar-toggler" type="submit" name="salir" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="bi bi-box-arrow-right"></span>
            cerrar
          </button>
        </form>
      </div>
    </nav>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <h3>Registro de Vehículos</h3>
        <hr>
        <!--  MENSAJES DE ALERTA -->
        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado') {
          ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Vehiculo Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php
        }
        ?>
        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado') {
          ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Datos Actualizados!</strong> Se Modificaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php
        }
        ?>
        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {
          ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php
        }
        ?>

        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado') {
          ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php
        }
        ?>

        <!--  MODAL DE AGREGAR -->
        <section>
          <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"><i class="bi bi-plus"></i>
            Nuevo registro
          </button>
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar registro</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="insertar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label class="form-label">Modelo</label>
                      <input type="text" class="form-control" name="modelo" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Valor</label>
                      <input type="number" class="form-control" placeholder="$ precio" name="valor" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Marca</label>
                      <select class="form-select" aria-label="Default select example" name="marca">
                        <?php foreach ($marcas as $marca): ?>
                          <option selected>
                            <?php echo $marca->marcaNombre; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Foto</label>
                      <br>
                      <img id="preview" src="#" style="max-width: 150px; max-height: 150px;">
                      <br><br>
                      <input type="file" class="form-control" id="inputGroupFile04" name="foto"
                        aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </section>

        <!--  TABLA DE DATOS -->

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Modelo</th>
              <th scope="col">Valor</th>
              <th scope="col">Marca</th>
              <th scope="col">Foto</th>
              <th scope="col" colspan="2">Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($vehiculos as $vehiculo): ?>
              <tr>
                <td scope="row">
                  <?php echo $vehiculo->id ?>
                </td>
                <td>
                  <?php echo $vehiculo->modelo ?>
                </td>
                <td>
                  $<?php echo number_format($vehiculo->valor, 0, ',', '.') ?>
                </td>
                <td>
                  <?php echo $vehiculo->marca ?>
                </td>
                <td><img class="float-justify" src="<?php echo $vehiculo->foto ?>"
                    style="max-width: 130px; max-height: 130px;" alt="Foto"></td>

                <td>
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditar"
                    onclick="cargarRegistro('<?php echo $vehiculo->id; ?>', '<?php echo $vehiculo->modelo; ?>', '<?php echo $vehiculo->valor; ?>', '<?php echo $vehiculo->marca; ?>', '<?php echo $vehiculo->foto; ?>')">
                    <i class="bi bi-pencil-square"></i> Editar
                  </button>

                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaleliminar"><i
                      class="bi bi-trash3-fill" data-id="<?php echo $vehiculo->id ?>"></i> Eliminar</button>
                </td>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <!--  MODAL DE EDITAR -->

        <section>
          <div class="modal fade" id="modaleditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5">Editar registro para registro: #<span id="registroId"></span></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="editar.php" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $vehiculo->id; ?>">
                    <div class="mb-3">
                      <label class="form-label">Modelo</label>
                      <input type="text" class="form-control" name="modelo" value="<?php echo $vehiculo->modelo; ?>"
                        required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Valor</label>
                      <input type="number" class="form-control" placeholder="$ precio" name="valor"
                        value="<?php echo $vehiculo->valor; ?>" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Marca</label>
                      <select class="form-select" aria-label="Default select example" name="marca">
                        <option value="<?php echo $vehiculo->modelo; ?>" selected><?php echo $vehiculo->marca; ?>
                        </option>
                        <?php foreach ($marcas as $marca): ?>
                          <option value="<?php echo $marca->marcaNombre; ?>">
                            <?php echo $marca->marcaNombre; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Foto</label>
                      <br>
                      <img src="<?php echo $vehiculo->foto ?>" style="max-width: 100px; max-height: 100px;" alt="Foto">
                      </td><br><br>
                      <input type="file" class="form-control" id="inputGroupFile04" name="foto"
                        aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="editarBtn">Guardar Cambios</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- MODAL DE ELIMINAR -->
        <div class="modal fade" id="modaleliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5">Eliminar registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ¿Desea eliminar este registro?
                <span id="registroId"></span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                <a id="eliminarBtn" href="#"><button type="button" class="btn btn-danger">Eliminar Registro</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <br><br>
  </body>
  <?php include 'template/footer.php' ?>

  <script>
    document.getElementById("inputGroupFile04").addEventListener("change", function (event) {
      var selectedFile = event.target.files[0];
      var objectURL = URL.createObjectURL(selectedFile);
      // Miniatura de la imagen
      var previewImage = document.getElementById("preview");
      previewImage.src = objectURL;
    });
  </script>

  <script>
    function cargarRegistro(id, modelo, valor, marca, foto) {
      var modal = $('#modaleditar');
      modal.find('#registroId').text(id);
      modal.find('input[name="id"]').val(id);
      modal.find('input[name="modelo"]').val(modelo);
      modal.find('input[name="valor"]').val(valor);
      modal.find('select[name="marca"]').val(marca);
      modal.find('img').attr('src', foto);
    }
  </script>

  <script>
    $(document).ready(function () {
      $('#modaleliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var registroId = button.find('i').data('id');
        var modal = $(this);
        modal.find('#registroId').text(registroId);
        modal.find('#eliminarBtn').attr('href', 'eliminar.php?id=' + registroId);
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

  </html>