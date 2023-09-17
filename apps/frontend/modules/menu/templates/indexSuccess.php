<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="/css/menu.css">
    <title>Doctor CRUD</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-3 mb-2">
                <a class="btn-card-custom" href="<?php echo url_for('paciente/index') ?>">
                    <div class="card card-custom">
                        <img src="/images/cardFamily.jpg" class="img-fluid img-thumbnail" alt="picture">
                        <div class="card-body card-custom-body d-flex justify-content-center">
                            <h4>Pacientes</h4>
                            <!-- <p>Administrador de estudiantes.</p>
                            <a href="/student" class="btn btn-primary">Entrar</a> -->
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3 mb-2">
                <a class="btn-card-custom" href="<?php echo url_for('doctor/index') ?>">
                    <div class="card card-custom">
                        <img src="/images/cardCalification.jpg" class="img-fluid img-thumbnail" alt="picture">
                        <div class="card-body card-custom-body d-flex justify-content-center">
                            <h4>Medicos</h4>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3 mb-2">
                <a class="btn-card-custom" href="<?php echo url_for('appointment/index') ?>">
                    <div class="card card-custom">
                        <img src="/images/cardConfig.png" class="img-fluid img-thumbnail" alt="picture">
                        <div class="card-body card-custom-body d-flex justify-content-center">
                            <h4>Citas Medicas</h4>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</body>
</html>