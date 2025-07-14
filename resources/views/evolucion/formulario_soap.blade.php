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
            <form action="{{ route('evolucion.store_temp_internos') }}" method="POST" autocomplete="off" novalidate>
                @csrf
                 @method('POST')
                <div class="row">
                    <div class="col-md-10">
                        <label><b>Registro de diagnosticos de la evolucion</b></label>
                        <input type="text" class="form-control" name="diagnostico" value="{{ old('diagnostico') }}" required>
                    </div>
                    <div class="col-md-2">
                        <br>
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button>
                    </div>
                </div>
            </form>
            <br>
            <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                <thead style="background-color:rgb(183, 207, 231);">
                    <tr class="text-center">
                        <th>Diagnostico</th>
                        <th width="10%">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $diagnosticos as $diagnostico)
                    <tr class="align-middle">
                        <td>{{ $diagnostico->diagnostico}}</td>
                        <td class="text-center">
                            <form action="{{ route('evolucion.delete_internos',$diagnostico->id_temporal)}}" method="POST" style="display: inline-block" onsubmit="return confirm('DESEA ELIMINAR EL REGISTRO')">
                                @csrf
                                @method('DELETE')
                                <button class=" btn btn-danger" type="submite"><i class="fa fa-trash "></i></button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Finalizar</button>
        </div>


        <!-- Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-end vh-100 w-100" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Registro SOAP</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="{{ route('evolucion.store_internos') }}" method="POST" autocomplete="off" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label><b>Descripcion</b></label>
                            <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required>
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
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>

                    <button type="button" class="btn btn-danger text-reset text-white" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa fa-reply"></i>Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection