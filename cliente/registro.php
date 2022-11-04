<?php include("template/cabecera.php"); ?>

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
    case "Registrarme":
        $sentenciaSQL = $conexion->prepare("INSERT INTO usuarios(nombre,primer_apellido,segundo_apellido,dni,telefono) 
            VALUES (:nombre,:primer_apellido,:segundo_apellido,:dni,:telefono);");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':primer_apellido', $txtprimerApellido);
        $sentenciaSQL->bindParam(':segundo_apellido', $txtsegundoApellido);
        $sentenciaSQL->bindParam(':dni', $txtDni);
        $sentenciaSQL->bindParam(':telefono', $txtTelefono);
        $sentenciaSQL->execute();
        header("Location:../seccion/usuarios.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios");
$sentenciaSQL->execute();
$listaUsuarios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<form method="POST">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Registrate!
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombres">
                            </div>
                            <div class="form-group">
                                <label>Apellido Paterno</label>
                                <input type="text" class="form-control" name="txtprimerApellido" id="txtprimerApellido" placeholder="Apellido Paterno">
                            </div>
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input type="text" class="form-control" name="txtsegundoApellido" id="txtsegundoApellido" placeholder="Apellido Materno">
                            </div>
                            <div class="form-group">
                                <label>Dni</label>
                                <input type="number" class="form-control" name="txtDni" id="txtDni" placeholder="Dni">
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="number" class="form-control" name="txtTelefono" id="txtTelefono" placeholder="Telefono">
                            </div>
                            <br>
                            <button type="submit" name="accion" value="Registrarme" class="btn btn-info"
                                onclick="alert('Mensaje enviado! Muchas gracias por contactar con nosostros!');">Registrarme</button>
                            <button type="submit" class="btn btn-warning">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<?php include("template/footer.php"); ?>