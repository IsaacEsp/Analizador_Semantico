<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analizadores de Código</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
    <div class="container">
        <h2>Analizadores de Código</h2>

        <form action="analizador.php" method="POST">
            <textarea name="codigo" required placeholder="Introduce una instrucción (ejemplo: x = 5)..."></textarea>
            <button type="submit">Analizar</button>
            <button type="button" onclick="limpiarFormulario()">Limpiar</button>
        </form>

        <!-- Recuadro para los resultados del Análisis Léxico -->
        <h3>Resultados del Analizador Léxico:</h3>
        <textarea readonly><?php if (isset($_GET['resultado_lexico']))
            echo htmlspecialchars($_GET['resultado_lexico']); ?></textarea>

        <!-- Recuadro para los resultados del Análisis Sintáctico -->
        <h3>Resultados del Analizador Sintáctico:</h3>
        <textarea readonly><?php if (isset($_GET['resultado_sintactico']))
            echo htmlspecialchars($_GET['resultado_sintactico']); ?></textarea>

        <!-- Recuadro para los resultados del Análisis Semántico -->
        <h3>Resultados del Analizador Semántico:</h3>
        <textarea readonly><?php if (isset($_GET['resultado_semantico']))
            echo htmlspecialchars($_GET['resultado_semantico']); ?></textarea>
    </div>

    <script>
        function limpiarFormulario() {
            document.querySelector("textarea[name='codigo']").value = "";
            document.querySelectorAll("textarea[readonly]").forEach((textarea) => {
                textarea.value = "";
            });
        }
    </script>
</body>

</html>