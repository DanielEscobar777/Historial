<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Nota de Evolución</title>
  <style>
    body {
      font-family: 'DejaVu Sans', Arial, sans-serif;
      font-size: 13px;
      margin: 0;
      padding: 0;
    }



    .columna {
      float: right; 
      direction: ltr;
      box-sizing: border-box;
      padding: 10px;
      overflow-wrap: break-word;
      word-wrap: break-word;
      word-break: break-word;
      display: block;
      min-height: 100px;
      margin-top: <?= $espaciado ?? 7 ?>cm;
    }

    .izquierda {
      width: 70%;
    }
    .derecha {
      width: 25%;
      margin-left: 4%;
      margin-right: 1%;          
    }

    h4 {
      text-align: center;
      margin: 5px 0 10px;
    }

    .diagnosticos {
      margin-left: 15px;
    }
    @media print {
      .pagina-extra {
        page-break-before: always;
        display: block;
      }

      .print-only {
        display: block;
      }
    }

    @media screen {
      .pagina-extra,
      .print-only {
        display: none;
      }
    }
    @media print {
  .columna {
    page-break-inside: avoid;
  }
}

  </style>
</head>
<body>
  <div class="espaciado1"></div>

    <!-- Columna izquierda (aparecerá a la derecha visualmente) -->
    <div class="columna izquierda">
      <h4>NOTA DE EVOLUCIÓN</h4>
      <p><?= $evolucion->descripcion ?>:</p>

      <div class="diagnosticos">
        <?php foreach ($diagnosticos as $diagnostico) { ?>
          • <?= $diagnostico->diagnostico ?><br>
        <?php } ?>
      </div>


        <p><strong>S.</strong> <?= $evolucion->s ?></p>
        <p><strong>O.</strong> <?= $evolucion->o ?></p>
        <p><strong>A.</strong> <?= $evolucion->a ?></p>
        <p><strong>P.</strong> <?= $evolucion->p ?></p>
     
    </div>

    <!-- Columna derecha (aparecerá a la izquierda visualmente) -->
    <div class="columna derecha">
      <p><strong>Fecha:</strong> <?= $evolucion->fecha_registro ?></p>
      <p><strong>Hora:</strong> <?= $evolucion->hora_registro ?></p>
      <p>
        <strong>PA:</strong> <?= $evolucion->pa ?> mmHg<br>
        <strong>FC:</strong> <?= $evolucion->fc ?> lpm<br>
        <strong>FR:</strong> <?= $evolucion->fr ?> rpm<br>
        <strong>Sat:</strong> <?= $evolucion->sat ?>% s/a<br>
        <strong>Sat2:</strong> <?= $evolucion->sat_2 ?>%<br>
        <strong>FiO2:</strong> <?= $evolucion->FiO2 ?><br>
        <strong>Peso:</strong> <?= $evolucion->peso ?> kg<br>
        <strong>Diuresis:</strong> <?= $evolucion->diuresis ?> ml<br>
        <strong>DH:</strong> <?= $evolucion->dh ?> ml/kg/hr
      </p>
    </div>

</body>
</html>
