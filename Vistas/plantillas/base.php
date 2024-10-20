<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="./Publico/css/estilos.css" />
    <link href="./Publico/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <?php include "./Vistas/plantillas/menu.php"; ?>
    <div class="container-fluid">
    <?php echo $contenido; ?>
    </div>
    <script src="./Publico/js/popper.min.js" ></script>
    <script src="./Publico/js/bootstrap.bundle.min.js" ></script>
</body>
</html>