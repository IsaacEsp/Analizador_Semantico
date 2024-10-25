<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];

    // Añadimos un punto y coma al final del código si no lo tiene
    $codigo = trim($codigo);
    if (substr($codigo, -1) !== ';') {
        $codigo .= ';';
    }

    $filename = 'HacerArchivo.txt';

    // Guardamos el código en un archivo temporal para analizar
    file_put_contents($filename, $codigo);

    // Inicializamos las variables de resultados
    $resultado_lexico = '';
    $resultado_sintactico = '';
    $resultado_semantico = '';

    // Ejecutamos el analizador léxico
    $output_lexico = [];
    $return_var_lexico = 0;
    exec('test.exe < ' . $filename, $output_lexico, $return_var_lexico);
    if ($return_var_lexico === 0) {
        $resultado_lexico = implode("\n", $output_lexico);
    } else {
        $resultado_lexico = "Error al ejecutar el analizador léxico.";
    }

    // Ejecutamos el analizador sintáctico
    $output_sintactico = [];
    $return_var_sintactico = 0;
    exec('test_sintactico.exe < ' . $filename, $output_sintactico, $return_var_sintactico);
    if ($return_var_sintactico === 0) {
        $resultado_sintactico = implode("\n", $output_sintactico);
    } else {
        $resultado_sintactico = "Error al ejecutar el analizador sintáctico.";
    }

    // Ejecutamos el analizador semántico
    $output_semantico = [];
    $return_var_semantico = 0;
    exec('test_semantico.exe < ' . $filename, $output_semantico, $return_var_semantico);
    if ($return_var_semantico === 0) {
        $resultado_semantico = implode("\n", $output_semantico);
    } else {
        $resultado_semantico = "Error al ejecutar el analizador semántico.";
    }

    // Redirigimos los resultados a la interfaz
    header("Location: index.php?resultado_lexico=" . urlencode($resultado_lexico) . "&resultado_sintactico=" . urlencode($resultado_sintactico) . "&resultado_semantico=" . urlencode($resultado_semantico));
}
?>