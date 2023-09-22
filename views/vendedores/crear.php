<main class="contenedor seccion">
        <h1>Registrar Vendedor</h1>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        
        <?php endforeach; ?>


        <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
            <?php include 'formulario.php'; ?>
            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
    </main>