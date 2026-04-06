<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 02 - Hola Mundo</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .caja {
            background: white;
            border-radius: 16px;
            padding: 50px 60px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }
        .etiqueta {
            font-size: 0.8rem;
            color: #a0aec0;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 16px;
        }
        .mensaje {
            font-size: 2.8rem;
            font-weight: bold;
            color: #553c9a;
        }
        .nota {
            margin-top: 20px;
            font-size: 0.85rem;
            color: #718096;
            background: #f7fafc;
            padding: 8px 16px;
            border-radius: 6px;
        }
        code {
            background: #edf2f7;
            color: #e53e3e;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="caja">
    <p class="etiqueta">Actividad N° 1 — PHP funcionando ✅</p>

    <?php
        echo '<p class="mensaje">¡Hola Mundo!</p>';
    ?>

    <p class="nota">El bloque <code>&lt;?php ... ?&gt;</code> está funcionando correctamente.</p>
</div>

</body>
</html>
