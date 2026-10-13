<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Nota de Evolución</title>
  <style>
    @page {
      size: A4 portrait;
      margin: {{ $pdfConfig['margin_top'] }}cm {{ $pdfConfig['margin_right'] }}cm {{ $pdfConfig['margin_bottom'] }}cm {{ $pdfConfig['margin_left'] }}cm;
    }

    body {
      font-family: {!! $pdfConfig['font_family'] !!};
      font-size: {{ $pdfConfig['font_size'] }}pt;
      line-height: {{ $pdfConfig['line_height'] }};
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
      padding: 0;
      word-wrap: break-word;
      word-break: break-word;
    }

    .columna-izquierda {
      width: {{ $pdfConfig['left_column'] }}%;
      position: absolute;
      left: 0;
      top: 0;
    }

    .columna-derecha {
      width: {{ $pdfConfig['right_column'] }}%;
      margin-left: {{ $pdfConfig['left_column'] + $pdfConfig['column_gap'] }}%;
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
      margin: 0 0 {{ $pdfConfig['paragraph_spacing'] }}pt;
      text-align: justify;
    }

    .salto {
      page-break-before: always;
    }
  </style>
</head>
<body>
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
      <p><?= nl2br(e($evolucion->descripcion)) ?>:</p>

      <div class="diagnosticos">
        <?php foreach ($diagnosticos as $diagnostico): ?>
          {!! nl2br(e($diagnostico->diagnostico)) !!}
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
