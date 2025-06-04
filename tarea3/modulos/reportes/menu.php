<?php 

include('../../libreria/main.php');
define("PAGINA_ACTUAL", "estadisticas");

$personajes  = Dbx::list("personajes");
$profesiones = Dbx::list("profesiones");

$edad_total = 0;
$excom = 0;

foreach($personajes as $personaje) {
    $edad_total += $personaje->edad();
    $excom += $personaje->nivel_experiencia;
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



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

