<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\Historial;
use Illuminate\Http\Request;
use App\Models\Anamnesis_sistemas;
use App\Models\Antecedentes_alimentarios;
use App\Models\Antecedentes_familiares;
use App\Models\Antecedentes_gineco_obstetricos;
use App\Models\Antecedentes_heredofamiliares;
use App\Models\Antecedentes_inmunizacion;
use App\Models\Antecedentes_patologicos;
use App\Models\Antecedentes_no_patologicos;
use App\Models\Antecedentes_perinatologicos;
use App\Models\Desarrollo_psicomotor;
use App\Models\Motivo_de_internacion;
use App\Models\Examen_obstetrico;
use App\Models\Examen_ginecologico;
use App\Models\Examen_cardiovascular;
use App\Models\Examen_genito_urinario;
use App\Models\Ganglios_linfaticos;
use App\Models\Examen_extremidades_inferiores;
use App\Models\Examen_extremidades_superiores;
use App\Models\Dermatologia;
use App\Models\Paciente;
use App\Models\Sistema_sensitivo;
use App\Models\Sistema_motor;
use App\Models\Sistema_nervioso;
use App\Models\Examenes_complementarios;
use App\Models\Examen_fisico_segmentado;
use App\Models\Impresion_diagnostica;
use App\Models\Diagnostico_sindromatico;
use App\Models\Comentarios;
use App\Models\Interpretacion_laboratorios;
use App\Models\HistorialSection;
use App\Models\EspecialidadSection;
use App\Models\Examen_fisico_general;
use App\Models\historia_enfermedad_actual;
use App\Models\Permisos_historia;
use App\Models\Servicios;
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Schema\Column;
use Illuminate\Support\Facades\Log;
use ReflectionClass;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $servicios = DB::table('servicios as s')
            ->join('servicio_user as su', 's.id_servicio', '=', 'su.servicio_id')
            ->where('su.user_id', $userId)
            ->get();
        return view('historial.index', compact('servicios'));
    }

    public function show($id_servicio)
    {

        $historiales = Historial::paciente($id_servicio);
        
        $historiaRN =Historial::where('nombre_recien_necido','<>', 'null')->get();
        $servicio = Servicios::where('id_servicio', $id_servicio)->first();
        return view('historial.index_servicio', compact('historiales', 'historiaRN','id_servicio', 'servicio'));
    }

    public function formulario($id_servicio)
    {
        $email = Auth::user()->email;
        $user = Auth::user();

        // Inicializar token
        $token = null;

        if ($user && $user->validador == 2) {
            $tokenPath = storage_path('app/token_sesion_' . $user->id . '.json');
            if (file_exists($tokenPath)) {
                $tokenData = json_decode(file_get_contents($tokenPath), true);
                $token = $tokenData['access_token'] ?? null;
            }
        }
        $n_ser = Servicios::where('id_servicio', $id_servicio)->first();
        $usuario = Auth::id();
        $permisos = DB::table('users as u')
            ->join('servicio_user as su', 'su.user_id', '=', 'u.id')
            ->join('servicios as s', 's.id_servicio', '=', 'su.servicio_id')
            ->join('detalle_servicio_permisos as dsp', 'dsp.id_servicio', '=', 's.id_servicio')
            ->join('permisos_historias as ph', 'ph.id_permisos_historia', '=', 'dsp.id_permisos_historia')
            ->where('s.id_servicio', $id_servicio)
            ->where('u.id', $usuario)
            ->select('ph.id_permisos_historia', 'ph.nombre_permiso', 'ph.nivel', 'ph.modulo', 's.nombre_servicio')
            ->orderBy('ph.nivel')
            ->orderBy('ph.modulo')
            ->orderBy('ph.id_permisos_historia')
            ->get();

        $campos_temporales = [];
        $servicio_nombre = null;
        $mapa_modulos = [

            'ap' => 'antecedentes_perinatologicos',
            'ai' => 'antecedentes_inmunizacions',
            'aai' => 'antecedentes_alimentarios',
            'afi' => 'antecedentes_familiares',
            'dp' => 'desarrollo_psicomotors',
            'ah' => 'antecedentes_heredofamiliares',
            'app' => 'antecedentes_patologicos',
            'apnp' => 'antecedentes_no_patologicos',
            'ag' => 'antecedentes_gineco_obstetricos',

            'mi' => 'motivo_de_internacion',
            'hea' => 'historia_enfermedad_actual',
            'as' => 'anamnesis_sistemas',

            'efg' => 'examen_fisico_generals',
            'efs' => 'examen_fisico_segmentado',
            'eo' => 'examen_obstetrico',
            'eg' => 'examen_ginecologico',
            'efsca' => 'examen_cardiovascular',
            'efsg' => 'examen_genito_urinario',
            'efses' => 'examen_extremidades_superiores',
            'efsei' => 'examen_extremidades_inferiores',
            'd' => 'dermatologia',
            'gl' => 'ganglios_linfaticos',
            'sn' => 'sistema_nervioso',
            'sm' => 'sistema_motor',
            'ss' => 'sistema_sensitivo',

            'ilg' => 'interpretacion_laboratorios_de_estudio_y_gabinetes',
            'ec' => 'examenes_complementarios',
            'id' => 'impresion_diagnostica',
            'ds' => 'diagnostico_sindromatico',
            'dsn' => 'diagnostico_sindromatico',

            'c' => 'comentarios'
        ];

        foreach ($permisos as $permiso) {
            $servicio_nombre = $permiso->nombre_servicio;

            if ($permiso->nivel == 1) {
                $clave = strtolower($permiso->nombre_permiso);

                 /*logger()->info('Modulo recibido:', [
                    'original' => $permiso->nombre_permiso,
                    'clave' => $clave
                ]);*/

                $campos_temporales[$clave] = [
                    'slug' => $clave,
                    'nombre' => $permiso->nombre_permiso,
                    'subcampos' => []
                ];
            }
        }
        foreach ($permisos as $permiso) {
            if ($permiso->nivel == 2) {
                $grupo_clave_corto = strtolower($permiso->modulo);
                if (isset($mapa_modulos[$grupo_clave_corto])) {
                    $grupo_clave = $mapa_modulos[$grupo_clave_corto];
                } else {
                    $grupo_clave = $grupo_clave_corto; // por si acaso no está en el mapa
                }
                /*logger()->info('Procesando subcampo', [
                    'nombre_permiso' => $permiso->nombre_permiso,
                    'modulo' => $permiso->modulo,
                    'grupo_clave' => $grupo_clave,
                    'existe_grupo' => isset($campos_temporales[$grupo_clave])
                ]);*/
                if (isset($campos_temporales[$grupo_clave])) {
                    $subcampo_nombre = strtolower(str_replace(' ', '_', $permiso->nombre_permiso));

                    /*logger()->info('Agregando subcampo', [
                        'a_grupo' => $grupo_clave,
                        'etiqueta' => $permiso->nombre_permiso,
                        'nombre' => $subcampo_nombre
                    ]);*/
                    $campos_temporales[$grupo_clave]['subcampos'][] = [
                        'etiqueta' => $permiso->nombre_permiso,
                        'nombre' => $subcampo_nombre
                    ];
                } else {
                    /*logger()->warning('No se encontró grupo para subcampo', [
                        'grupo_clave' => $grupo_clave,
                        'nombre_permiso' => $permiso->nombre_permiso
                    ]);*/
                }
            }
        }
        $campos_organizados = [];
        foreach ($mapa_modulos as $clave_corta => $clave_larga) {
            if (isset($campos_temporales[$clave_larga])) {
                $campos_organizados[$clave_larga] = $campos_temporales[$clave_larga];
            }
        }

        $faltantes = array_diff(array_values($mapa_modulos), array_keys($campos_temporales));

        return view('historial.formulario', [
            'campos_organizados' => $campos_organizados,
            'mostrarCamposRN' => strtolower($servicio_nombre) === 'NEONATOLOGIA',
            'modulos_faltantes' => $faltantes,
            'n_ser' => $n_ser,
            'access_token' => $token
        ]);
    }
    public function editSecciones($id_servicio)
    {
        $secciones = HistorialSection::all();
        $seleccionadas = EspecialidadSection::where('id_servicio', $id_servicio)->pluck('id_section')->toArray();

        $servicio = Servicios::findOrFail($id_servicio); // <-- aquí traes el nombre

        return view('historial.secciones', compact('secciones', 'seleccionadas', 'id_servicio', 'servicio'));
    }
    public function updateSecciones(Request $request, $id_servicio)
    {
        // Eliminar los accesos actuales
        EspecialidadSection::where('id_servicio', $id_servicio)->delete();

        // Insertar nuevas relaciones si hay seleccionadas
        if ($request->has('secciones')) {
            foreach ($request->secciones as $id_section) {
                EspecialidadSection::create([
                    'id_servicio' => $id_servicio,
                    'id_section' => $id_section,
                ]);
            }
        }
        return redirect()->route('servicios.index')->with('success', 'Secciones actualizadas correctamente.');
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $usuario = Auth::user();
            $email = $usuario->email;

            $servicio = DB::table('users as u')
                ->join('servicio_user as su', 'su.user_id', '=', 'u.id')
                ->join('servicios as s', 's.id_servicio', '=', 'su.servicio_id')
                ->where('u.email', $email)
                ->select('s.id_servicio', 's.nombre_servicio')
                ->first();

            if (!$servicio) {
                throw new \Exception('Servicio no asignado al usuario.');
            }
            $esObstetrico = $request->nombre_servicio;
            // Validación básica de los campos fijos (historial)
            if ($esObstetrico == 'NEONATOLOGIA') {
                $request->merge([
                    'nombres' => $request->nombre_recien_necido,
                    'p_apellido' => $request->nombre_recien_necido,
                    'fecha_nacimiento' => $request->fecha_recien_necido
                ]);
                $validated = $request->validate([
                    'cama' => 'nullable|string|max:50',
                    'nombrenum_referencia' => 'nullable|string|max:255',
                    'nombre_recien_necido' => 'required|string|max:255',
                    'fecha_recien_necido' => 'required|date',
                    'hora_recien_necido' => 'required|date_format:H:i',
                    'sexo' => 'required',
                    'campos_dinamicos' => 'required|array',
                    'campos_dinamicos.*' => 'required',
                ], [
                    'cama.required' => 'El campo cama es obligatorio.',
                    'nombrenum_referencia.required' => 'El campo nombre y numero de referencia es obligatorio.',
                    'nombre_recien_necido.required' => 'El campo nombre de recien nacido es obligatorio.',
                    'fecha_recien_necido.required' => 'El campo fecha de nacimiento es obligatorio.',
                    'hora_recien_necido.required' => 'El campo hora de nacimiento es obligatorio.',
                    'sexo.required' => 'El campo sexo es obligatorio',
                    'campos_dinamicos.required' => 'Debe agregar al menos un campo dinámico',
                    'campos_dinamicos.*.required' => 'El valor del campo es obligatorio',
                ]);
            } else {
                $validated = $request->validate([
                    'grado_instruccion' => 'required|string|max:255',
                    'religion' => 'required|string|max:255',
                    'cama' => 'required|string|max:50',
                    'fuente_informacion' => 'required|string|max:255',
                    'ocupacion' => 'required|string|max:255',
                    'estado_civil' => 'required|string|max:255',
                    'nombrenum_referencia' => 'required|string|max:255',
                    'grado_confiabilidad' => 'required|string|max:255',
                    'grupo_sanguineo_facto' => 'required|string|max:100',
                    'nombre_recien_necido' => 'nullable|string|max:255',
                    'fecha_recien_necido' => 'nullable|date',
                    'hora_recien_necido' => 'nullable|date_format:H:i',
                    'campos_dinamicos' => 'required|array',
                    'campos_dinamicos.*' => 'required',
                ], [
                    'id_paciente.required' => 'El campo paciente es obligatorio.',
                    'grado_instruccion.max' => 'El grado de instrucción no puede superar los 255 caracteres.',
                    'religion.required' => 'El campo religion es obligatorio.',
                    'cama.required' => 'El campo cama es obligatorio.',
                    'ocupacion.required' => 'El campo cama es obligatorio.',
                    'estado_civil.required' => 'El campo cama es obligatorio.',
                    'fuente_informacion.required' => 'El campo fuente_informacion es obligatorio.',
                    'nombrenum_referencia.required' => 'El campo nombre y numero de referencia es obligatorio.',
                    'grado_confiabilidad.required' => 'El campo grado_confiabilidad es obligatorio.',
                    'grupo_sanguineo_facto.required' => 'El campo grupo_sanguineo_facto es obligatorio.',
                    'campos_dinamicos.required' => 'Debe agregar al menos un campo dinámico',
                    'campos_dinamicos.*.required' => 'El valor del campo es obligatorio',
                ]);
            }
            $id_servicio = $request->id_servicio;
            // Validar campos dinámicos para que no estén vacíos
            $datosFormulario = $request->input('campos_dinamicos', []);
            $erroresCamposDinamicos = [];
            foreach ($datosFormulario as $campo => $valor) {
                if (is_null($valor) || (is_string($valor) && trim($valor) === '')) {
                    $erroresCamposDinamicos["campos_dinamicos.{$campo}"] = "El campo '{$campo}' no puede estar vacío.";
                }
            }
            if (!empty($erroresCamposDinamicos)) {
                return back()->withErrors($erroresCamposDinamicos)->withInput();
            }
            // Guardar en tabla pacientes (crear o actualizar)
            $datosPaciente = [
                'ci' => $request->ci,
                'nombres' => $request->nombres,
                'p_apellido' => $request->p_apellido,
                's_apellido' => $request->s_apellido,
                'sexo' => $request->sexo,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'telefono' => $request->telefono,
                'complemento' => $request->complemento,
                'nacionalidad' => $request->nacionalidad,
                'matricula_seguro' => $request->matricula_seguro,
                'residencia' => $request->residencia,
                'updated_at' => now()
            ];

            // Verificar si el paciente ya existe
            $paciente = DB::table('pacientes')->where('ci', $request->ci)->first();

            if ($paciente) {
                // Actualizar datos si ya existe
                DB::table('pacientes')->where('ci', $request->ci)->update($datosPaciente);
                if ($esObstetrico != 'NEONATOLOGIA') {
                    $idPaciente = $paciente->id;
                } else {
                    $idPaciente = '0';
                }
            } else {
                // Insertar nuevo paciente
                $datosPaciente['created_at'] = now();
                  if ($esObstetrico != 'NEONATOLOGIA') {
                    $idPaciente = DB::table('pacientes')->insertGetId($datosPaciente);
                } else {
                    $idPaciente = '0';
                }
                
            }
            // Insertar en historial
            $historialId = DB::table('historials')->insertGetId([
                'id_servicio' => $request->id_servicio,
                'id_paciente' => $esObstetrico ? $idPaciente : null,
                'grado_instruccion' => $request->grado_instruccion,
                'religion' => $request->religion,
                'ocupacion' => $request->ocupacion,
                'estado_civil' => $request->estado_civil,
                'fecha_registro' => now()->toDateString(),
                'hora_registro' => now()->toTimeString(),
                'cama' => $request->cama,
                'fuente_informacion' => $request->fuente_informacion,
                'nombrenum_referencia' => $request->nombrenum_referencia,
                'grado_confiabilidad' => $request->grado_confiabilidad,
                'grupo_sanguineo_facto' => $request->grupo_sanguineo_facto,
                'nombre_recien_necido' => $esObstetrico ? $request->nombre_recien_necido : null,
                'fecha_recien_necido' => $esObstetrico ? $request->fecha_recien_necido : null,
                'hora_recien_necido' => $esObstetrico ? $request->hora_recien_necido : null,
                'sexo' => $esObstetrico ? $request->sexo : null,
                'id_usuario' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ], 'id_historia');

            $permisos = DB::table('permisos_historias as ph')
                ->select(
                    DB::raw('LOWER(ph.nombre_permiso) as nombre_permiso'),
                    'ph.nivel',
                    'ph.modulo'
                )
                ->get();

            $modulos = [];

            foreach ($permisos as $permiso) {
                if ($permiso->nivel == 1) {
                    $modulos[$permiso->nombre_permiso] = [];
                }
            }

            foreach ($permisos as $permiso) {
                if ($permiso->nivel == 2 && isset($modulos[$permiso->modulo])) {
                    $modulos[$permiso->modulo][] = $permiso->nombre_permiso;
                }
            }

            // Configuración DBAL
            $config = new \Doctrine\DBAL\Configuration();
            $connectionParams = [
                'dbname' => env('DB_DATABASE'),
                'user' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'host' => env('DB_HOST'),
                'driver' => 'pdo_pgsql',
                'port' => env('DB_PORT', 5432),
                'charset' => 'UTF8',
            ];
            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
            $schemaManager = $conn->createSchemaManager();
            \Log::info('Campos dinámicos recibidos:', $datosFormulario);

            foreach ($modulos as $tabla => $camposPermitidos) {
                \Log::info("Procesando tabla dinámica: $tabla");
                if (!\Schema::hasTable($tabla)) {
                    \Log::warning("La tabla $tabla no existe en la base de datos.");
                    echo $tabla;
                    die();

                    continue;
                }
                $data = [
                    'id_historial' => $historialId,
                    'id_usuario' => $usuario->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                try {
                    $columns = $schemaManager->listTableColumns($tabla);

                    \Log::info("Columnas encontradas en tabla $tabla:", array_keys($columns));

                    foreach ($columns as $columna => $colInfo) {
                        if ($colInfo->getAutoincrement()) continue;
                        if (in_array($columna, [
                            'id_historial',
                            'id_usuario',
                            'created_at',
                            'updated_at',
                            'id_anamnesis_sistema',
                            'id_antecedentes_alimentarios',
                            'id_antecedentes_familiares',
                            'id_antecedentes_gineco',
                            'id_antecedentes_heredofamiliares',
                            'id_antecedentes_inmunizacion',
                            'id_antecedentes_nopatologicos',
                            'id_antecedentes_patologicos',
                            'id_antecedentes_perinatologicos',
                            'id_au_anamnesis',
                            'id_au_ant_alimentario',
                            'id_au_ant_perinatologicos',
                            'id_au_ant_familiares',
                            'id_au_ant_heredofamiliares',
                            'id_au_ant_inmunizacion',
                            'id_au_ant_patologicos',
                            'id_au_comentarios',
                            'id_au_desarrollo',
                            'id_au_diagnostico',
                            'id_au_diagnostico_soaps',
                            'id_au_evolucions',
                            'id_au_exm_cardiovascular',
                            'id_au_exm_extremisades_i',
                            'id_au_exm_extremisades_s',
                            'id_au_exm_general',
                            'id_au_exm_segmentado',
                            'id_au_exm_genitourinario',
                            'id_au_exm_ginecologico',
                            'id_au_exm_obstetrico',
                            'id_au_examenes',
                            'id_au_ganglios',
                            'id_au_enfermedas_actual',
                            'id_au_impresion_diagnostica',
                            'id_au_sistema_nervioso',
                            'id_au_sistema_sensitivo',
                            'key',
                            'id_comentarios',
                            'id_dermatologia',
                            'id_desarrollo_psicomotor',
                            'id_detalle_servicio_permiso',
                            'id_diagnostico',
                            'id_diagnostico_soaps',
                            'id_temporal',
                            'id_evolucion',
                            'id_examen_cardiovascular',
                            'id_examen_extremidades_inferiores',
                            'id_examen_extremidades_superiores',
                            'id_examen_general',
                            'id_examen_fisico_segmentado',
                            'id_examen_genitourinario',
                            'id_examen_ginecologico',
                            'id_examen_obstetrico',
                            'id_examenes_complementarios',
                            'id',
                            'id_ganglios',
                            'id_historia_enfermedad',
                            'id_historia',
                            'id_impresion_diagnostica',
                            'id_interpretacion',
                            'id_motivo_internacion',
                            'email',
                            'role_id',
                            'user_id',
                            'servicio_id',
                            'id_sistema_motor',
                            'id_sistema_nervioso',
                            'id_sistema_sensitivo'
                        ])) continue;

                        if (array_key_exists($columna, $datosFormulario)) {
                            $valor = $datosFormulario[$columna];
                            $data[$columna] = $valor !== '' ? $valor : 'N/A';
                        } else {
                            /*$tipo = strtolower((new \ReflectionClass($colInfo->getType()))->getShortName());
                            $data[$columna] = 'N/A';*/
                            $tipo = strtolower((new \ReflectionClass($colInfo->getType()))->getShortName());
                            switch ($tipo) {
                                case 'integer':
                                case 'smallint':
                                case 'bigint':
                                    $data[$columna] = 0;
                                    break;
                                case 'boolean':
                                    $data[$columna] = false;
                                    break;
                                case 'datetime':
                                case 'date':
                                    $data[$columna] = now();
                                    break;
                                default:
                                    $data[$columna] = 'N/A';
                            }
                        }
                    }
                    \Log::debug("Preparando para insertar o actualizar en $tabla:", $data);

                    // Aquí verificamos si ya existe un registro con el id_historial
                    $existe = DB::table($tabla)->where('id_historial', $historialId)->exists();

                    if ($existe) {
                        // Si existe, actualizamos
                        DB::table($tabla)->where('id_historial', $historialId)->update($data);
                        \Log::info("Registro en $tabla actualizado con id_historial = $historialId");
                    } else {
                        // Si no existe, insertamos
                        DB::table($tabla)->insert($data);
                        \Log::info("Registro en $tabla insertado con id_historial = $historialId");
                    }
                } catch (\Throwable $e) {
                    \Log::error("Error al insertar o actualizar en tabla {$tabla}: " . $e->getMessage(), [
                        'tabla' => $tabla,
                        'datos_procesados' => $data,
                        'exception' => $e,
                    ]);
                    if (!\Schema::hasTable($tabla)) {
                        \Log::warning("La tabla $tabla no existe en la base de datos.");
                        continue;
                    }
                }
            }
            DB::commit();
            $historiales = Historial::where('id_servicio', $id_servicio)->get();
            return redirect()->route('historial.show', ['id_servicio' => $request->id_servicio])
                ->with('success', 'Historia registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()])->withInput();
        }
    }
    public function edit($id_historial)
{
    $historial = Historial::where('id_historia', $id_historial)->first();
    $id_paciente = $historial->id_paciente;
    $paciente = DB::table('pacientes as p')
        ->where('p.id', $id_paciente)
        ->first();

    // Cargar todas las entidades relacionadas (igual que ya lo tienes)
    $antecedentes_perinatologicos = Antecedentes_perinatologicos::where('id_historial', $id_historial)->first();
    $antecedentes_inmunizacion = Antecedentes_inmunizacion::where('id_historial', $id_historial)->first();
    $antecedentes_alimenticios = Antecedentes_alimentarios::where('id_historial', $id_historial)->first();
    $antecedentes_familiares = Antecedentes_familiares::where('id_historial', $id_historial)->first();
    $desarrollo_psicomotor = Desarrollo_psicomotor::where('id_historial', $id_historial)->first();
    $antecedentes_heredofamiliares = Antecedentes_heredofamiliares::where('id_historial', $id_historial)->first();
    $antecedentes_patologicos = Antecedentes_patologicos::where('id_historial', $id_historial)->first();
    $antecedentes_no_patologicos = Antecedentes_no_patologicos::where('id_historial', $id_historial)->first();
    $Antecedentes_gineco_obsteticos = Antecedentes_gineco_obstetricos::where('id_historial', $id_historial)->first();
    $Anamnesis_sistema = Anamnesis_sistemas::where('id_historial', $id_historial)->first();
    $Motivo_de_internacion = Motivo_de_internacion::where('id_historial', $id_historial)->first();
    $historia_enfermedad_actual = historia_enfermedad_actual::where('id_historial', $id_historial)->first();
    $Examen_fisico_general = Examen_fisico_general::where('id_historial', $id_historial)->first();
    $examen_obstetrico = Examen_obstetrico::where('id_historial', $id_historial)->first();
    $examen_ginecologico = Examen_ginecologico::where('id_historial', $id_historial)->first();
    $examen_cardiovascular = Examen_cardiovascular::where('id_historial', $id_historial)->first();
    $examen_genito_urinario = Examen_genito_urinario::where('id_historial', $id_historial)->first();
    $Examen_extremidades_superiores = Examen_extremidades_superiores::where('id_historial', $id_historial)->first();
    $Examen_extremidades_inferiores = Examen_extremidades_inferiores::where('id_historial', $id_historial)->first();
    $Ganglios_linfaticos = Ganglios_linfaticos::where('id_historial', $id_historial)->first();
    $dermatologia = Dermatologia::where('id_historial', $id_historial)->first();
    $Sistema_nervioso = Sistema_nervioso::where('id_historial', $id_historial)->first();
    $Sistema_sensitivo = Sistema_sensitivo::where('id_historial', $id_historial)->first();
    $Sistema_motor = Sistema_motor::where('id_historial', $id_historial)->first();
    $examenes_complementarios = Examenes_complementarios::where('id_historial', $id_historial)->first();
    $comentarios = Comentarios::where('id_historial', $id_historial)->first();
    $impresion_diagnostica = Impresion_diagnostica::where('id_historial', $id_historial)->first();
    $diagnostico_sindromatico = Diagnostico_sindromatico::where('id_historial', $id_historial)->first();
    $Examen_fisico_segmentado = Examen_fisico_segmentado::where('id_historial', $id_historial)->first();
    $interpretacion_laboratorios = Interpretacion_laboratorios::where('id_historial', $id_historial)->first();

    $id_servicio = $historial->id_servicio;
    $n_ser = Servicios::where('id_servicio', $id_servicio)->first();
    $permisos = Permisos_historia::traer_permisos_2($id_servicio);

    $usuarios_encontrados = [];

    // Buscar en el archivo cache si es NEONATOLOGÍA y el nombre del RN tiene el formato esperado
    if (
        $n_ser->nombre_servicio === 'NEONATOLOGIA' &&
        preg_match('/^RN_(\d{4})(\d{2})(\d{2})_\d{4}_\d+$/', $historial->nombre_recien_necido, $matches)
    ) {
        $fecha_nacimiento = "{$matches[1]}-{$matches[2]}-{$matches[3]}";

        $afiliados = $this->obtenerTodosLosAfiliados();

        if (is_array($afiliados) && empty($afiliados['error'])) {
            $usuarios_encontrados = array_filter($afiliados, function ($usuario) use ($fecha_nacimiento) {
                return isset($usuario['fecha_nacimiento']) && $usuario['fecha_nacimiento'] === $fecha_nacimiento;
            });

            $usuarios_encontrados = array_values($usuarios_encontrados); // Reindexar
        }
    }

    return view('historial.formulario_editar', [
        'historial' => $historial,
        'permisos' => $permisos,
        'n_ser' => $n_ser,
        'id_historial' => $id_historial,
        'antecedentes_perinatologicos' => $antecedentes_perinatologicos,
        'antecedentes_inmunizacion' => $antecedentes_inmunizacion,
        'antecedentes_alimentarios' => $antecedentes_alimenticios,
        'antecedentes_familiares' => $antecedentes_familiares,
        'desarrollo_psicomotor' => $desarrollo_psicomotor,
        'antecedentes_heredofamiliares' => $antecedentes_heredofamiliares,
        'antecedentes_patologicos' => $antecedentes_patologicos,
        'antecedentes_no_patologicos' => $antecedentes_no_patologicos,
        'Antecedentes_gineco_obsteticos' => $Antecedentes_gineco_obsteticos,
        'anamnesis_sistema' => $Anamnesis_sistema,
        'motivo_de_internacion' => $Motivo_de_internacion,
        'historia_enfermedad_actual' => $historia_enfermedad_actual,
        'examen_fisico_general' => $Examen_fisico_general,
        'examen_obstetrico' => $examen_obstetrico,
        'examen_ginecologico' => $examen_ginecologico,
        'examen_cardiovascular' => $examen_cardiovascular,
        'examen_genito_urinario' => $examen_genito_urinario,
        'comentarios' => $comentarios,
        'impresion_diagnostica' => $impresion_diagnostica,
        'diagnostico_sindromatico' => $diagnostico_sindromatico,
        'examenes_complementarios' => $examenes_complementarios,
        'ganglios_linfaticos' => $Ganglios_linfaticos,
        'examen_extremidades_superiores' => $Examen_extremidades_superiores,
        'examen_extremidades_inferiores' => $Examen_extremidades_inferiores,
        'dermatologia' => $dermatologia,
        'sistema_motor' => $Sistema_motor,
        'sistema_sensitivo' => $Sistema_sensitivo,
        'sistema_nervioso' => $Sistema_nervioso,
        'examen_fisico_segmentado' => $Examen_fisico_segmentado,
        'interpretacion_laboratorios' => $interpretacion_laboratorios,
        'paciente' => $paciente,
        'usuarios_encontrados' => $usuarios_encontrados,
    ]);
}


public function update(Request $request, $id_historial)
{
    $nombreServicio = $request->nombre_servicio;

    $historial = Historial::findOrFail($id_historial);

    if ($nombreServicio === 'NEONATOLOGIA') {
        // Validación para recién nacidos
        $validated = $request->validate([
            'cama' => 'nullable|string|max:50',
            'nombrenum_referencia' => 'nullable|string|max:255',
            'nombre_recien_necido' => 'required|string|max:255',
            'fecha_recien_necido' => 'required|date',
            'hora_recien_necido' => 'required',
            'sexo' => 'required',
        ], [
            'nombre_recien_necido.required' => 'El campo nombre de recien nacido es obligatorio.',
            'fecha_recien_necido.required' => 'El campo fecha de nacimiento es obligatorio.',
            'hora_recien_necido.required' => 'El campo hora de nacimiento es obligatorio.',
            'sexo.required' => 'El campo sexo es obligatorio',
        ]);

        // Actualizar campos pero manteniendo los valores anteriores si no vienen en el request
        $nombreCompleto = trim(
            ($request->filled('nombres') ? $request->input('nombres') : $historial->nombre_recien_necido) . ' ' .
            ($request->filled('p_apellido') ? $request->input('p_apellido') : '') . ' ' .
            ($request->filled('s_apellido') ? $request->input('s_apellido') : '')
        );

        // Decidir el valor de nombrenum_referencia
        if ($request->filled('nombrenum_referencia')) {
            $nombrenum_referencia = $request->input('nombrenum_referencia');
        } elseif ($request->filled('telefono') && $request->input('telefono') != '0') {
            $nombrenum_referencia = $request->input('telefono');
        } else {
            $nombrenum_referencia = $historial->nombrenum_referencia;
        }

        $historial->update([
            'nombre_recien_necido' => $nombreCompleto ?: $historial->nombre_recien_necido,
            'sexo' => $request->filled('sexo_api') ? $request->input('sexo_api') : $historial->sexo,
            'fecha_recien_necido' => $request->filled('fecha_nacimiento') ? $request->input('fecha_nacimiento') : $historial->fecha_recien_necido,
            'hora_recien_necido' => $request->filled('hora_recien_necido') ? $request->input('hora_recien_necido') : $historial->hora_recien_necido,
            'cama' => $request->filled('cama') ? $request->input('cama') : $historial->cama,
            'nombrenum_referencia' => $nombrenum_referencia,
        ]);

        // Si se seleccionó un paciente desde la lista
        if ($request->filled('id_usuario_seleccionado')) {
            // Verificar si ya existe un paciente en la base
            $paciente = Paciente::find($historial->id_paciente);

            $datosPaciente = [
                'nombres' => $request->input('nombres'),
                'p_apellido' => $request->input('p_apellido'),
                's_apellido' => $request->input('s_apellido'),
                'sexo' => $request->input('sexo_api'),
                'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                'matricula_seguro' => $request->input('matricula_seguro'),
                'complemento' => $request->input('complemento'),
                'nacionalidad' => $request->input('nacionalidad'),
                'telefono' => $request->input('telefono') != '0' ? $request->input('telefono') : null,
                'residencia' => $request->input('residencia'),
                'updated_at' => now(),
            ];

            if ($paciente) {
                // Ya existe, solo actualizamos
                $paciente->update($datosPaciente);
            } else {
                // No existe -> lo creamos
                $datosPaciente['created_at'] = now();
                $paciente = Paciente::create($datosPaciente);

                // Asociamos el nuevo paciente al historial
                $historial->update(['id_paciente' => $paciente->id]);
            }
        }

    } else {
        // Validación para otros servicios
        $validated = $request->validate([
            'grado_instruccion' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'cama' => 'required|string|max:50',
            'ocupacion' => 'required|string|max:50',
            'estado_civil' => 'required|string|max:50',
            'fuente_informacion' => 'required|string|max:255',
            'nombrenum_referencia' => 'required|string|max:255',
            'grado_confiabilidad' => 'required|string|max:255',
            'grupo_sanguineo_facto' => 'required|string|max:100',
        ], [
            'grado_instruccion.max' => 'El grado de instrucción no puede superar los 255 caracteres.',
            'religion.required' => 'El campo religión es obligatorio.',
            'cama.required' => 'El campo cama es obligatorio.',
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'estado_civil.required' => 'El campo estado civil es obligatorio.',
            'fuente_informacion.required' => 'El campo fuente de información es obligatorio.',
            'nombrenum_referencia.required' => 'El campo nombre y número de referencia es obligatorio.',
            'grado_confiabilidad.required' => 'El campo grado de confiabilidad es obligatorio.',
            'grupo_sanguineo_facto.required' => 'El campo grupo sanguíneo y factor es obligatorio.',
        ]);

        $historial->update([
            'grado_instruccion' => $request->filled('grado_instruccion') ? $request->input('grado_instruccion') : $historial->grado_instruccion,
            'religion' => $request->filled('religion') ? $request->input('religion') : $historial->religion,
            'cama' => $request->filled('cama') ? $request->input('cama') : $historial->cama,
            'ocupacion' => $request->filled('ocupacion') ? $request->input('ocupacion') : $historial->ocupacion,
            'estado_civil' => $request->filled('estado_civil') ? $request->input('estado_civil') : $historial->estado_civil,
            'fuente_informacion' => $request->filled('fuente_informacion') ? $request->input('fuente_informacion') : $historial->fuente_informacion,
            'nombrenum_referencia' => $request->filled('nombrenum_referencia') ? $request->input('nombrenum_referencia') : $historial->nombrenum_referencia,
            'grado_confiabilidad' => $request->filled('grado_confiabilidad') ? $request->input('grado_confiabilidad') : $historial->grado_confiabilidad,
            'grupo_sanguineo_facto' => $request->filled('grupo_sanguineo_facto') ? $request->input('grupo_sanguineo_facto') : $historial->grupo_sanguineo_facto,
        ]);
    }

    return redirect()->back()->with('success', 'Historia actualizada correctamente.');
}

protected function obtenerTodosLosAfiliados()
{
    try {
        $cachePath = storage_path('app/afiliados_cache.json');

        if (!file_exists($cachePath)) {
            \Log::warning("⚠️ El archivo no existe: {$cachePath}");
            return ['error' => 'El archivo de afiliados aún no ha sido generado.'];
        }

        $contenido = file_get_contents($cachePath);
        $afiliados = json_decode($contenido, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            \Log::error('❌ Error de JSON: ' . json_last_error_msg());
            return ['error' => 'Error de formato JSON: ' . json_last_error_msg()];
        }

        if (!is_array($afiliados)) {
            \Log::error('❌ El JSON no es un array válido.');
            return ['error' => 'El formato del archivo de afiliados es inválido.'];
        }

        \Log::info('✅ Archivo de afiliados leído con éxito. Total: ' . count($afiliados));
        return $afiliados;
    } catch (\Throwable $e) {
        \Log::error('❌ Error al leer afiliados_cache.json: ' . $e->getMessage());
        return ['error' => 'Error interno al leer el archivo de afiliados.'];
    }
}

}
