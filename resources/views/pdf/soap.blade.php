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

    .contenedor {
      width: 100%;
      display: block;
      position: relative;
    }

    .columna {
      display: inline-block;
      vertical-align: top;
      box-sizing: border-box;
      padding: 10px;
      word-wrap: break-word;
      word-break: break-word;
      margin-top: <?= $espaciado ?? 7 ?>cm;
    }

    .columna-izquierda {
      width: 25%;
      position: absolute;
      left: 0;
      top: 0;
    }

    .columna-derecha {
      width: 70%;
      margin-left: 30%;
      page-break-inside: auto;
    }

    h4 {
      text-align: center;
      margin: 5px 0 10px;
    }

    .diagnosticos {
      margin-left: 15px;
    }

    p {
      margin: 4px 0;
      text-align: justify;
    }

    .salto {
      page-break-before: always;
    }
  </style>
</head>
<body>
  <div class="espaciado1"></div>
  <div class="contenedor">
    
    <!-- Columna izquierda (signos vitales) -->
    <div class="columna columna-izquierda">
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

    <!-- Columna derecha (nota de evolución) -->
    <div class="columna columna-derecha">
      <h4>NOTA DE EVOLUCIÓN</h4>
      <p><?= $evolucion->descripcion ?>:</p>

      <div class="diagnosticos">
        <?php foreach ($diagnosticos as $diagnostico): ?>
          • <?= $diagnostico->diagnostico ?><br>
        <?php endforeach; ?>
      </div>

      <div class="evolucion">
        <p><strong>S.</strong> <?= nl2br(e($evolucion->s)) ?></p>
        <p><strong>O.</strong> <?= nl2br(e($evolucion->o)) ?></p>
        <p><strong>A.</strong> <?= nl2br(e($evolucion->a)) ?></p>
        <p><strong>P.</strong> <?= nl2br(e($evolucion->p)) ?></p>
      </div>
    </div>

  </div>

</body>
</html>
