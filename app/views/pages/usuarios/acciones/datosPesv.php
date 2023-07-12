<div class="tab-pane" id="pesv">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><b>Número de inscripción RUNT:</b></td>
                        <td><?php echo $data[0]->numero_runt_usuario ?></td>
                    </tr>
                    <tr>
                        <td><b>Categoría de licencia de carro:</b></td>
                        <td><?php echo $data[0]->tipo_licencia_carro_usuario ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha inscripción RUNT:</b></td>
                        <td><?php echo $data[0]->fecha_inscripcion_runt_usuario ?></td>
                    </tr>
                    <tr>
                        <td><b>Vigencia licencia de carro:</b></td>
                        <td><?php echo $data[0]->vigencia_licencia_carro_usuario ?></td>
                    </tr>
                    <tr>
                        <td><b>Categoría de licencia de moto:</b></td>
                        <td><?php echo $data[0]->tipo_licencia_moto_usuario ?></td>
                    </tr>
                    <tr>
                        <td><b>Vigencia licencia de moto:</b></td>
                        <td><?php echo $data[0]->vigencia_licencia_moto_usuario ?></td>
                    </tr>
                    <tr>
                        <td><b>Años de experiencia en conducción:</b></td>
                        <td><?php echo $data[0]->anios_experiencia_usuario ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

