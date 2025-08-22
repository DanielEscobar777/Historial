@extends('layouts.header')
@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="panel-body">
            <h4 class="text-center" style="color:rgba(11, 107, 185, 0.65);">NOTA DE EVOLUCION</h4>

            <form action="{{ route('evolucion.store') }}" method="POST" autocomplete="off" novalidate>
                @csrf
                <input type="hidden" class="form-control" name="id_historial" value="{{ $id_historial}}" required>

                <div class="row">
                    <div class="col-md-12">
                        <label><b>Descripcion</b></label>
                        <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required>
                    </div>
                    <div class="col-md-12">
                        <label ><b>Diagnosticos</b></label>
                        <textarea class="form-control" rows="7" placeholder="Escribe tu texto aquí..." name="diagnostico">{{ old('diagnostico') }}</textarea>

                    </div>
                    <div class="col-md-12">
                        <label><b>S</b></label>
                        <textarea class="form-control" rows="3" placeholder="Escribe tu texto aquí..." name="s">{{ old('s') }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label><b>O</b></label>
                        <textarea class="form-control" rows="3" placeholder="Escribe tu texto aquí..." name="o">{{ old('o') }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label><b>A</b></label>
                        <textarea class="form-control" rows="3" placeholder="Escribe tu texto aquí..." name="a">{{ old('a') }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label><b>P</b></label>
                        <textarea class="form-control" rows="3" placeholder="Escribe tu texto aquí..." name="p">{{ old('p') }}</textarea>
                    </div>

                    <h5 style="color:rgba(11, 107, 185, 0.65);">Signos vitales (solo ingrese numeros)</h5>
                    <div class="col-md-2">
                        <label><b>PA (mmHg)</b></label>
                        <input type="text" class="form-control" name="pa" value="{{ old('pa') }}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>FC (Ipm)</b></label>
                        <input type="text" class="form-control" name="fc" value="{{ old('fc') }}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>FR (rpm)</b></label>
                        <input type="text" class="form-control" name="fr" value="{{ old('fr') }}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>Sat (s/a)</b></label>
                        <input type="text" class="form-control" name="sat" value="{{ old('sat') }}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>Sat (%)</b></label>
                        <input type="text" class="form-control" name="sat_2" value="{{ old('sat_2') }}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>FiO2</b></label>
                        <input type="text" class="form-control" name="FiO2" value="{{ old('FiO2') }}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>Peso (Kg)</b></label>
                        <input type="text" class="form-control" name="peso" value="{{ old('peso') }}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>Diuresis (ml)</b></label>
                        <input type="text" class="form-control" name="diuresis" value="{{ old('diuresis') }}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>DH (ml/kg/hr)</b></label>
                        <input type="text" class="form-control" name="dh" value="{{ old('dh') }}" required>
                    </div>
                </div>

                <br>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>

                <a href="{{ route('historial.show', $historial->id_servicio)}}" class="btn btn-danger"><i class="fa fa-reply"></i> Cancelar</a>
            </form>


        </div>

    </div>
</div>

@endsection