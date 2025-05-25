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
                                <th scope="col">Tipo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Año</th>
                                <th scope="col">País</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Serie</td>
                                <td>Breaking Bad</td>
                                <td>2008</td>
                                <td>USA</td>
                                <td>
                                    <a href="editar.php?id=1" class="btn btn-outline-dark">Editar</a>
                                    <a href="detalle.php?id=1" class="btn btn-outline-info">Detalles</a>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>

