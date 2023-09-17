<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Appointment CRUD</title>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="modalAddAppointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cita medica</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formAppointment" action="<?php echo url_for('appointment/store') ?>" method="post">

                        <div class="row">
                            <label for="inputPaciente" class="form-label"><?php echo $form['paciente_id']->renderLabel() ?></label>
                            <?php echo $form['paciente_id']->renderError() ?>
                            <?php echo $form['paciente_id'] ?>
                        </div>

                        <div class="row">
                            <label for="inputDoctor" class="form-label"><?php echo $form['doctor_id']->renderLabel() ?></label>
                            <?php echo $form['doctor_id']->renderError() ?>
                            <?php echo $form['doctor_id'] ?>
                        </div>

                        <div class="row">
                            <label for="inputDoctor" class="form-label"><?php echo $form['fecha']->renderLabel() ?></label>
                            <?php echo $form['fecha']->renderError() ?>
                            <?php echo $form['fecha'] ?>
                        </div>

                        <div class="row mt-5">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary" value="Enviar">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container mt-5">
        <div class="row">
            <button id="openModalAppointment" type="button" class="btn btn-primary">Agregar Cita Medica</button>
        </div>
        <div class="row">
        <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Paciente</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody id="bodyTable">
                    <?php foreach ($appointments as $keyAppo => $Appo): ?>
                        <tr data-id=<?php echo $Appo->getId()?>>
                            <td><?php echo $Appo->getId() ?></td>
                            <td><?php echo $Appo->getPaciente()->getUser()->getNombre() ?></td>
                            <td><?php echo $Appo->getMedico()->getUser()->getNombre() ?></td>
                            <td><?php echo $Appo->getFecha() ?></td>
                            <td>
                                <button type="button" class="btn btn-secondary eliminar" >Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="/js/appointment.js"></script>
</body>

</html>