<?php include("../template/cabecera.php"); ?>

<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtprimerApellido = (isset($_POST['txtprimerApellido'])) ? $_POST['txtprimerApellido'] : "";
$txtsegundoApellido = (isset($_POST['txtsegundoApellido'])) ? $_POST['txtsegundoApellido'] : "";
$txtDni = (isset($_POST['txtDni'])) ? $_POST['txtDni'] : "";
$txtTelefono = (isset($_POST['txtTelefono'])) ? $_POST['txtTelefono'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../configuracion/conexion.php");

switch ($accion) {
    case "Perfil":
        // echo "Presiono boton visitar perfil usuario";
        header("Location:../cliente/index.php");
        break;
    case "Mensaje":
        header("Location:mensaje.php");
        // echo "Presiono boton mensaje";
        break;
    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM usuarios WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        // echo "Presiono boton borrar";
        header("Location:usuarios.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios");
$sentenciaSQL->execute();
$listaUsuarios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="col-md-8">
    Tabla de usuarios
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Ape.Paterno</th>
                <th>Ape.Materno</th>
                <th>DNI</th>
                <th>Telefono</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaUsuarios as $usuario) { ?>
            <tr>
                <td>
                    <?php echo $usuario['id']; ?>
                </td>
                <td>
                    <?php echo $usuario['nombre']; ?>
                </td>
                <td>
                    <?php echo $usuario['primer_apellido']; ?>
                </td>
                <td>
                    <?php echo $usuario['segundo_apellido']; ?>
                </td>

                <td>
                    <?php echo $usuario['dni']; ?>
                </td>
                <td>
                    <?php echo $usuario['telefono']; ?>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $usuario['id']; ?>">
                        <input type="submit" name="accion" value="Perfil" class="btn btn-primary">
                        <input type="submit" name="accion" value="Mensaje" class="btn btn-secondary">
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                    </form>
                </td>
                <?php } ?>
            </tr>
        </tbody>
    </table>
</div>

<?php include("../template/footer.php"); ?>