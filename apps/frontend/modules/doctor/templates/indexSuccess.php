<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Doctor CRUD</title>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="modalAddDoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Doctor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="formDoctor" action="<?php echo url_for('doctor/store') ?>" method="post">

                    <div class="row">
                        <label for="inputUserName" class="form-label"><?php echo $form['username']->renderLabel() ?></label>
                        <?php echo $form['username']->renderError() ?>
                        <?php echo $form['username'] ?>
                    </div>

                    <div class="row">
                        <label for="inputPassword" class="form-label"><?php echo $form['password']->renderLabel() ?></label>
                        <?php echo $form['password']->renderError() ?>
                        <?php echo $form['password'] ?>
                    </div>

                    <div class="row">
                        <label for="inputFirstNamne" class="form-label"><?php echo $form['name']->renderLabel() ?></label>
                        <?php echo $form['name']->renderError() ?>
                        <?php echo $form['name'] ?>
                    </div>

                    <div class="row">
                        <label for="inputLastName" class="form-label"><?php echo $form['lastname']->renderLabel() ?></label>
                        <?php echo $form['lastname']->renderError() ?>
                        <?php echo $form['lastname'] ?>
                    </div>

                    <div class="row">
                        <label for="inputCedula" class="form-label"><?php echo $form['cedula']->renderLabel() ?></label>
                        <?php echo $form['cedula']->renderError() ?>
                        <?php echo $form['cedula'] ?>
                    </div>

                    <div class="row">
                        <label for="inputTarejta" class="form-label"><?php echo $form['tarjeta']->renderLabel() ?></label>
                        <?php echo $form['tarjeta']->renderError() ?>
                        <?php echo $form['tarjeta'] ?>
                    </div>

                    <div class="row">
                        <label for="inputEspecialidad" class="form-label"><?php echo $form['especialidad']->renderLabel() ?></label>
                        <?php echo $form['especialidad']->renderError() ?>
                        <?php echo $form['especialidad'] ?>
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
    <div class="container">
        <div class="row mt-5">
        <button id="openModalDoctor" type="button" class="btn btn-primary">Agregar Doctor</button>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Role</th>
                        <th scope="col">Tarjeta</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="bodyTable">
                    <?php foreach ($doctor_data as $keyDoctor => $doctor): ?>
                        <tr data-id=<?php echo $doctor->getId()?>>
                        <td><?php echo $doctor->getId() ?></td>
                            <td><?php echo $doctor->getUser()->getNombre() ?></td>
                            <td><?php echo $doctor->getUser()->getApellido() ?></td>
                            <td><?php echo $doctor->getUser()->getCedula() ?></td>
                            <td><?php echo $doctor->getUser()->getRole() ?></td>
        
                            <td><?php echo $doctor->getTarjeta() ?></td>
                            <td><?php echo $doctor->getEspecialidad() ?></td>
                            <td>
                                <button type="button" class="btn btn-secondary editar">Editar</button>
                                <button type="button" class="btn btn-secondary eliminar" >Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="/js/doctor.js"></script>
</body>
</html>

