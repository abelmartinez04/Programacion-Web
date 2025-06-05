<?php 

include('../../libreria/main.php');
define("PAGINA_ACTUAL", "estadisticas");

$personajes  = Dbx::list("personajes");
$profesiones = Dbx::list("profesiones");

$edad_total = 0;
$excom = 0;

// Para los mayor y menor salarios
$menor_salario = null;
$mayor_salario = null;


//data para el grafico
$salarios_graph = [];

$personasxprofesion = [];
foreach($profesiones as $profesion) {
    
    $salarios_graph[] = $profesion->salario_mensual;

    if(is_null($mayor_salario) || $profesion->salario_mensual > $mayor_salario->salario_mensual) {
        $mayor_salario = $profesion;
    }

    if(is_null($menor_salario) || $profesion->salario_mensual < $menor_salario->salario_mensual) {
        $menor_salario = $profesion;
    }

    if(!isset($personasxprofesion[$profesion->idx])) {
        $personasxprofesion[$profesion->idx] = [
            'nombre' => $profesion->nombre,
            'cantidad' => 0
        ];
    }
}

foreach($personajes as $personaje) {
    $edad_total += $personaje->edad();
    $excom += $personaje->nivel_experiencia;

    if(isset($personasxprofesion[$personaje->profesion])) {
        $personasxprofesion[$personaje->profesion]['cantidad']++;
    }
}
$eprom = $edad_total / count($personajes);
$excom = $excom / count($personajes);




$data = [
    'personajes' => count($personajes),
    'profesiones' => count($profesiones),
    'edad_promedio' => $eprom,
    'nivel_experiencia_comun' => $excom,
];



plantilla::aplicar();

?>

    <!-- Font awesome para iconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>



<h1 class="text-center mb-4"> 🌸 Estadisticas del Mundo Barbie 🌸</h1>

        <!-- Indicadores-->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users"></i> Personajes</h5>
                        <p class="card-text fs-4"><?= $data['personajes']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-secondary h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-briefcase"></i> Profesiones</h5>
                        <p class="card-text fs-4"><?= $data['profesiones']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-heartbeat"></i> Edad promedio</h5>
                        <p class="card-text fs-4"><?= number_format($data['edad_promedio'], 0); ?> Años</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-star"></i> Nivel de Experiencia comun</h5>
                        <p class="card-text fs-4"><?= number_format($data['nivel_experiencia_comun'], 2); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!--detalles y distrubuciones-->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card-h-100">
                    <div class="card-body">
                        <h5 class="card-title">Distribucion de personajes por Categoria</h5>
                        <ul class="list-group">
                            <?php
                                foreach($personasxprofesion as $idx => $fila) {
                                    echo "<li class='list-group-item'>{$fila['nombre']}: {$fila['cantidad']} personajes</li>";
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Salarios destacados</h5>
                        <p><strong>Profesion con mayor salaro:</strong> <?= $mayor_salario; ?></p>
                        <p><strong>Profesion con menor salaro:</strong> <?= $menor_salario; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- grafico de salarios-->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title text-center">Distribucion de salarios por categoria de profesion</h5>
                <canvas id="salaryChart" height="100"></canvas>
            </div>
        </div>

        <?php
        $labels = array_map(fn($p) => $p->nombre, $profesiones); // Nombres de profesiones
        $datos = array_map(fn($p) => $p->salario_mensual, $profesiones); // Salarios

        ?>

        <script>
            const ctx = document.getElementById('salaryChart');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($labels); ?>,
                    datasets: [{
                        label: 'Salarios',
                        data: <?= json_encode($datos); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>


