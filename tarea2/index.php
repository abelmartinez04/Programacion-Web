<?php
include('libreria/main.php');
plantilla::aplicar()
?>
                    <div class="text-end mb-3">
                        <a href="editar.php" class="btn btn-primary">Agregar</i></a>

                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Foto</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Autor</th>
                                <th scope="col">País</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>                            
                            </tr>
                                <?php 

                                    if(is_dir('datos')){
                                        $archivos = scandir('datos');

                                        foreach($archivos as $archivo){
                                            $ruta = 'datos/'.$archivo;
                                            if(is_file($ruta)){
                                                $json = file_get_contents($ruta);
                                                $obra = json_decode($json);
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?=$obra->foto_url ?>" alt="<?=$obra->nombre ?>" height="100">
                                                        </td>
                                                        <td><?=Datos::Tipos_de_Obra()[$obra->tipo]?></td>
                                                        <td><?= $obra->nombre ?></td>
                                                        <td><?= $obra->autor ?></td>
                                                        <td><?= $obra->pais ?></td>
                                                        <td>
                                                            <a href="editar.php?id=<?= $obra->codigo ?>" class="btn btn-outline-warning">Editar</a>
                                                            <a href="personajes.php?id=<?= $obra->codigo ?>" class="btn btn-outline-info">Personajes</a>
                                                            <a href="detalle.php?id=<?= $obra->codigo ?>" class="btn btn-outline-danger">Detalle</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }

                                        }
                                    }
                                ?>
                        </tbody>
                    </table>

