<?php
    session_start();
    $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : null;
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
    $sexo = isset($_SESSION['sexo']) ? $_SESSION['sexo'] : null;
    $peso = isset($_SESSION['peso']) ? $_SESSION['peso'] : null;
    $altura = isset($_SESSION['altura']) ? $_SESSION['altura'] : null;
    $edad = isset($_SESSION['edad']) ? $_SESSION['edad'] : null;
    $actividad = isset($_SESSION['actividad']) ? $_SESSION['actividad'] : null;
    $tmb = isset($_SESSION['tmb']) ? $_SESSION['tmb'] : null;
    $ajuste = isset($_SESSION['ajuste']) ? $_SESSION['ajuste'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Proteinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container-md mt-4">
        <?php if($msg != null): ?>
            <div class="alert alert-success" role="alert">
                <?= $msg ?>
                <?php unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>
        <?php if($error != null): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
    
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Completa el formulario
                    </div>
                    <div class="card-body">
                        <p>Utilizaremos la fórmula de <strong>Harris Benedict</strong>, una de las más usadas en todo el mundo.</strong></p>
                        <form action="process.php" method="post">
                            <div class="mb-sm-3">
                                <label for="sexo" class="form-label">Sexo <span style="color:red;">*</span></label>
                                <select class="form-select" name="sexo" id="sexo">
                                    <option value="F" selected>Femenino</option>
                                    <option value="M">Masculino</option>
                                  </select>
                            </div>
                            <div class="mb-sm-3">
                                <label for="peso" class="form-label">Tu peso en kilogramos <span style="color:red;">*</span></label>
                                <input step="0.01" type="number" class="form-control" name="peso" id="peso">
                            </div>
                            <div class="mb-sm-3">
                                <label for="altura" class="form-label">Tu alltura en centimetros <span style="color:red;">*</span></label>
                                <input type="number" class="form-control" name="altura" id="altura">
                            </div>
                            <div class="mb-sm-3">
                                <label for="edad" class="form-label">Tu edad en años <span style="color:red;">*</span></label>
                                <input type="number" class="form-control" name="edad" id="edad">
                            </div>
                            <div class="mb-sm-3">
                                <label for="actividad" class="form-label">Nivel de actividad <span style="color:red;">*</span></label>
                                <select class="form-select" name="actividad" id="actividad">
                                    <option value="Sedentario" selected>Sedentario</option>
                                    <option value="Ligero">Ejercicio Ligero</option>
                                    <option value="Moderado">Ejercicio Moderado</option>
                                    <option value="Intenso">Ejercicio Intenso</option>
                                    <option value="MIntenso">Ejercicio Muy Intenso</option>
                                  </select>
                            </div>
                            <button type="submit" class="btn btn-success">Calcular</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Resultados
                    </div>
                    <div class="card-body">
                        <?php if ($tmb == null): ?>
                            <h5 class="mt-xl-5 mb-xl-5 text-center">No hay resultados.</h5>
                        <?php else: ?>
                            <p>Tus calorias calucladas para mantener peso son:</p>
                            <h4 class="mb-3"><?=$ajuste; ?></h4>
                            <p class="mb-3">Metabolismo Basal:</p>
                            <h5 class="mb-3 text-secondary"><?=$tmb; ?></h5>
                            <a href="restart.php" class="btn btn-danger">Reiniciar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>