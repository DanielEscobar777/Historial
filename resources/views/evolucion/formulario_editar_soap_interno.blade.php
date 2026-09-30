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
        @if(session('success'))
        <div style="color: green; background-color: #d4edda; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
        @endif

        <div class="panel-body">
            <h4 class="text-center" style="color:rgba(11, 107, 185, 0.65);">ACTUALIZAR NOTA DE EVOLUCION</h4>
            <form action="{{ route('evolucion.update',$evoluciones->id_evolucion) }}" method="POST" autocomplete="off" novalidate>
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <label><b>Descripcion</b></label>
                        <input type="text" class="form-control" name="descripcion" value="{{ $evoluciones->descripcion}}" required>
                    </div>
                    <div class="col-md-12">
                        <label><b>S</b></label>
                        <textarea class="form-control" rows="3" name="s">{{ $evoluciones->s}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label><b>O</b></label>
                        <textarea class="form-control" rows="3" name="o">{{ $evoluciones->o}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label><b>A</b></label>
                        <textarea class="form-control" rows="3" name="a">{{ $evoluciones->a}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label><b>P</b></label>
                        <textarea class="form-control" rows="3" name="p">{{ $evoluciones->p}}</textarea>
                    </div>

                    <h5 style="color:rgba(11, 107, 185, 0.65);">Signos vitales (solo ingrese numeros)</h5>
                    <div class="col-md-2">
                        <label><b>PA (mmHg)</b></label>
                        <input type="text" class="form-control" name="pa" value="{{$evoluciones->pa}}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>FC (Ipm)</b></label>
                        <input type="text" class="form-control" name="fc" value="{{$evoluciones->fc}}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>FR (rpm)</b></label>
                        <input type="text" class="form-control" name="fr" value="{{$evoluciones->fr}}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>Sat (s/a)</b></label>
                        <input type="text" class="form-control" name="sat" value="{{$evoluciones->sat}}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>Sat (%)</b></label>
                        <input type="text" class="form-control" name="sat_2" value="{{$evoluciones->sat_2}}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>FiO2</b></label>
                        <input type="text" class="form-control" name="FiO2" value="{{$evoluciones->fio2}}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>Peso (Kg)</b></label>
                        <input type="text" class="form-control" name="peso" value="{{$evoluciones->peso}}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>Diuresis (ml)</b></label>
                        <input type="text" class="form-control" name="diuresis" value="{{$evoluciones->diuresis}}" required>
                    </div>

                    <div class="col-md-2">
                        <label><b>DH (ml/kg/hr)</b></label>
                        <input type="text" class="form-control" name="dh" value="{{$evoluciones->dh}}" required>
                    </div>
                </div>

                <br>
                <a href="{{ route('evolucion.index')}}" class="btn btn-danger "><i class="fa fa-reply"></i> Cancelar</a>

                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Actualizar</button>

            </form><br>
            <h4 class="text-center" style="color:rgba(11, 107, 185, 0.65);">ACTUALIZAR DIAGNOSTICOS</h4>

            <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                <thead style="background-color:rgb(183, 207, 231);">
                    <tr class="text-center">
                        <th>Diagnostico</th>
                        <th width="10%">Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $diagnosticos as $diagnostico)
                    <form action="{{ route('diagnostico.update',$diagnostico->id_diagnostico_soaps) }}" method="POST" autocomplete="off" novalidate>
                        @csrf @method('PUT')
                        <tr class="align-middle">
                            <td>
                                <textarea class="form-control" rows="7" name="diagnostico">{{$diagnostico->diagnostico }}</textarea>

                            </td>
                            <td class="text-center"> <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Actualizar</button></td>
                        </tr>

                    </form>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>

@endsection