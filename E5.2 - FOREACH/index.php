<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="containerTitle">
        <?php
        echo "<h1>EJERCICIOS BASICOS PHP</h1>";
        ?>
    </div>
    <div class="matriz">
        <?php
        $comunidades = [
            'Andalucía' => [
                'provincias' => [
                    'Sevilla',
                    'Cádiz',
                    'Córdoba',
                    'Granada',
                    'Málaga',
                    'Jaén',
                    'Huelva'
                ],
                'capital' => [
                    'Sevilla' => [
                        'poblacion' => 742940,
                        'informacion_adicional' => 'Capital histórica de al-Andalus.'
                    ]
                ],
            ],
            'Cataluña' => [
                'provincias' => ['Barcelona', 'Girona', 'Lleida', 'Tarragona'],
                'capital' => [
                    'Barcelona' => [
                        'poblacion' => 1620343,
                        'informacion_adicional' => 'Ciudad cosmopolita y centro económico.'
                    ]
                ],
            ],
            'Castilla y León' => [
                'provincias' => [
                    'Ávila',
                    'Burgos',
                    'León',
                    'Salamanca',
                    'Segovia',
                    'Soria',
                    'Valladolid',
                    'Zamora'
                ],
                'capital' => [
                    'Valladolid' => [
                        'poblacion' => 304875,
                        'informacion_adicional' => 'Ciudad universitaria y cuna del
            castellano.'
                    ]
                ],
            ],
            'Galicia' => [
                'provincias' => ['A Coruña', 'Lugo', 'Ourense', 'Pontevedra'],
                'capital' => [
                    'Santiago de Compostela' => [
                        'poblacion' =>
                            97185,
                        'informacion_adicional' => 'Ciudad histórica y sede del Camino
            de Santiago.'
                    ]
                ],
            ],
            'País Vasco' => [
                'provincias' => ['Álava', 'Guipúzcoa', 'Vizcaya'],
                'capital' => [
                    'Vitoria-Gasteiz' => [
                        'poblacion' => 252727,
                        'informacion_adicional' => 'Capital del País Vasco y ciudad verde.'
                    ]
                ],
            ],
        ];
        ?>
    </div>
    <div class="container">
        <!-- Ejercicio 1 -->
        <!-- Muestra los datos de las provincias -->
        <?php
        echo "<h2>Ejercicio 1</h2>";
        foreach ($comunidades as $comunidad => $datos) {
            echo "<h3>$comunidad</h3>";
            echo "<ul>";
            foreach ($datos['provincias'] as $provincia) {
                echo "<li>$provincia</li>";
            }
            echo "</ul>";
        }
        ?>

        <!-- Ejercicio 2 -->
        <!-- Mostrar todas las capitales y sus poblaciones -->
        <?php
        echo "<h2>Ejercicio 2</h2>";
        foreach ($comunidades as $comunidad => $datos) {
            foreach ($datos['capital'] as $capital => $info) {
                echo "<p>Capital de $comunidad: $capital</p>";
                echo "<p>Población: {$info['poblacion']}</p>";
                echo "<p>Información adicional: {$info['informacion_adicional']}</p>";
                echo "<hr>";
            }
        }
        ?>

        <!-- Ejercicio 3 -->
        <!-- Añadir una nueva comunidad y muestralos por pantalla -->
        <?php
        echo "<h2>Ejercicio 3</h2>";
        $comunidades['Extremadura'] = [
            'provincias' => ['Cáceres', 'Badajoz'],
            'capital' => [
                'Mérida' => [
                    'poblacion' => 58995,
                    'informacion_adicional' => 'Capital de la comunidad autónoma de Extremadura.'
                ]
            ],
        ];

        foreach ($comunidades as $comunidad => $datos) {
            echo "<h3>$comunidad</h3>";
            echo "<ul>";
            foreach ($datos['provincias'] as $provincia) {
                echo "<li>$provincia</li>";
            }
            echo "</ul>";
        }
        ?>

        <!-- Ejercicio 4 -->
        <!-- Mostrar los datos solicitados por el usuario -->
        <?php
        echo "<h2>Ejercicio 4</h2>";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['provincia'])) {
            $provinciaBuscada = $_POST['provincia'];
            $encontrado = false;

            foreach ($comunidades as $comunidad => $datos) {
                if (in_array($provinciaBuscada, $datos['provincias'])) {
                    echo "<p>La provincia $provinciaBuscada pertenece a la comunidad: $comunidad</p>";
                    $encontrado = true;
                    break;
                }
            }

            if (!$encontrado) {
                echo "<p>Provincia no encontrada.</p>";
            }
        }
        ?>

        <!-- Ejercicio 5 -->
        <!-- Calcular la población total de cada comunidad -->
        <?php
        echo "<h2>Ejercicio 5</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Comunidad</th><th>Población Total</th></tr>";

        foreach ($comunidades as $comunidad => $datos) {
            $poblacionTotal = 0;
            foreach ($datos['capital'] as $capital => $info) {
                $poblacionTotal += $info['poblacion'];
            }
            echo "<tr><td>$comunidad</td><td>$poblacionTotal</td></tr>";
        }
        echo "</table>";
        ?>

        <!-- Ejercicio 6 -->
        <!-- Sistema de búsqueda avanzado -->
        <?php
        echo "<h2>Ejercicio 6</h2>";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
            $busqueda = $_POST['buscar'];
            $resultados = [];

            foreach ($comunidades as $comunidad => $datos) {
                if (strpos($comunidad, $busqueda) !== false) {
                    $resultados[] = "Comunidad: $comunidad";
                }
                foreach ($datos['provincias'] as $provincia) {
                    if (strpos($provincia, $busqueda) !== false) {
                        $resultados[] = "Provincia: $provincia (Comunidad: $comunidad)";
                    }
                }
                foreach ($datos['capital'] as $capital => $info) {
                    if (strpos($capital, $busqueda) !== false) {
                        $resultados[] = "Capital: $capital (Comunidad: $comunidad)";
                    }
                }
            }

            if (!empty($resultados)) {
                echo "<ul>";
                foreach ($resultados as $resultado) {
                    echo "<li>$resultado</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No se encontraron resultados para '$busqueda'.</p>";
            }
        }
        ?>
    </div>

</body>

</html>