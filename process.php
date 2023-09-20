<?php
    session_start();

     try {
         if (empty($_REQUEST['peso']) || empty($_REQUEST['altura']) || empty($_REQUEST['edad'])) {
             throw new Exception("Hace falta información, complete el formulario.");
         }
         $sexo = trim($_REQUEST['sexo']);
         $peso = trim($_REQUEST['peso']);
         $altura = trim($_REQUEST['altura']);
         $edad = trim($_REQUEST['edad']);
         $actividad = trim($_REQUEST['actividad']);
         //validar informacion
         validar($peso,$altura,$edad);
         //Calcular la TMB
         $tmb = calcularTMB($sexo,$peso,$altura,$edad);
         echo "calculo tmb: " .$tmb."<br>";
         //Calcular el ajuste para mantener el peso
         $ajuste = calcularAjuste($tmb,$actividad);
         $msg = "Hemos calculado tus calorias con éxito";
         //asignar variables de sesion calculadas
         $_SESSION['msg'] = $msg;
         $_SESSION['tmb'] = $tmb;
         $_SESSION['ajuste'] = $ajuste;
         //Regresar a index
         header('Location: index.php');
     }  catch (\Throwable $th) {
         $_SESSION['error']  = $th->getMessage();
         header('Location: index.php');
     }
//     header('Location: index.php');

     //validacion de valores edad,altura y peso
     function validar($peso,$altura,$edad) {
         if ($peso > 700 || $peso < 0) {
             throw new Exception("Un ser humano no puede tener este peso");
         }
         if ($altura > 300 || $altura < 0) {
             throw new Exception("Un ser humano no puede tener esta altura");
         }
         if ($edad > 150 || $edad < 0) {
             throw new Exception("Un ser humano no puede tener esta edad");
         }
     }

     //calcular la TMB
     function calcularTMB($sexo,$peso,$altura,$edad) {
         if ($sexo == 'F') {
             $valor = 655.1 + (9.563 * $peso) + (1.850 * $altura) - (4.676 * $edad);
         } else {
             $valor = 66.5 + (13.75 * $peso) + (5.003 * $altura) - (6.755 * $edad);
         }
         return $valor;
     }

     //calcular el ajuste del TMB
     function calcularAjuste($tmb,$actividad) {
        $ajuste=0.0;
        if ($actividad == 'Sedentario') {
            $ajuste = $tmb * 1.2; 
        } else if ($actividad == 'Ligero') {
            $ajuste = $tmb * 1.375; 
        } else if ($actividad == 'Moderado') {
            $ajuste = $tmb * 1.55; 
        } else if ($actividad =='Intenso') {
            $ajuste = $tmb * 1.725; 
        } else if ($actividad =='MIntenso') {
            $ajuste = $tmb * 1.9; 
        }
        return $ajuste;
    }
 ?>