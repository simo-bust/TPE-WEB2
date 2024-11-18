<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>templates/css/style.css">
    <title>Argonauta Libreria</title>
</head>
<body>
<header class="header">
    <div class="logo">
        <img src="<?= BASE_URL ?>image/elementos/logo.png" alt="Logo" class="logo">
    </div>
    <nav class="navbar">
        <ul class="menu" id="menu">
            <li><a href="<?= BASE_URL ?>home"><strong>Catalogo Completo</strong></a></li>
            <li><a href="<?= BASE_URL ?>editorial"><strong>Editoriales</strong></a></li>

            
            <?php if (isset($_SESSION['ID_USER'])): ?>
                
                <li><a href="<?= BASE_URL ?>logout">Cerrar Sesión</a></li>
            <?php else: ?>
                
                <li><a href="<?= BASE_URL ?>login">Iniciar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
