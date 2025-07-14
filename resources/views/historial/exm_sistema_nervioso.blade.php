   <h5>SISTEMA NERVIOSO</h5>
   <h5>Funciones cerebrales superiores</h5>
   <div class="row">

       <div class="col-12 col-md-6">
           <label><b>CONCIENCIA </b></label>
           <input type="text" class="form-control" name="exam_nervioso_conciencia" value="{{ old('exam_nervioso_conciencia') ?? ''}}" placeholder="Escriba....." required>
       </div>


       <div class="col-12 col-md-6">
           <label><b>GNOSIA</b></label>
           <input type="text" class="form-control" name="exam_nervioso_gnosia" value="{{ old('exam_nervioso_gnosia') ?? ''}}" placeholder="Escriba....." required>
       </div>


       <div class="col-12 col-md-6">
           <label><b>PRAXIA</b></label>
           <input type="text" class="form-control" name="exam_nervioso_praxia" value="{{ old('exam_nervioso_praxia') ?? ''}}" placeholder="Escriba....." required>
       </div>


       <div class="col-12 col-md-6">
           <label><b>LENGUAJE</b></label>
           <input type="text" class="form-control" name="exam_nervioso_lenguaje" value="{{ old('exam_nervioso_lenguaje') ?? ''}}" placeholder="Escriba....." required>
       </div>


       <div class="col-12 col-md-6">
           <label><b>MEMORIA</b></label>
           <input type="text" class="form-control" name="exam_nervioso_memoria" value="{{ old('exam_nervioso_memoria') ?? ''}}" placeholder="Escriba....." required>
       </div>


       <div class="col-12 col-md-6">
           <label><b>CALCULO</b></label>
           <input type="text" class="form-control" name="exam_nervioso_calculo" value="{{ old('exam_nervioso_calculo') ?? ''}}" placeholder="Escriba....." required>
       </div>


       <div class="col-12 col-md-6">
           <label><b>INTELIGENCIA</b></label>
           <input type="text" class="form-control" name="exam_nervioso_inteligencia" value="{{ old('exam_nervioso_inteligencia') ?? ''}}" placeholder="Escriba....." required>
       </div>

       <div class="col-12 col-md-6">
           <label><b>ATENCION</b></label>
           <input type="text" class="form-control" name="exam_nervioso_atencion" value="{{ old('exam_nervioso_atencion') ?? ''}}" placeholder="Escriba....." required>
       </div>

       <div class="col-12 col-md-6">
           <label><b>EMOTIVIDAD</b></label>
           <input type="text" class="form-control" name="exam_nervioso_emotividad" value="{{ old('exam_nervioso_emotividad') ?? ''}}" placeholder="Escriba....." required>
       </div>

       <div class="col-12 col-md-6">
           <label><b>PLANIFICACION</b></label>
           <input type="text" class="form-control" name="exam_nervioso_planificacion" value="{{ old('exam_nervioso_planificacion') ?? ''}}" placeholder="Escriba....." required>
       </div>

       <div class="col-12 col-md-6">
           <label><b>DECISION</b></label>
           <input type="text" class="form-control" name="exam_nervioso_decision" value="{{ old('exam_nervioso_decision') ?? ''}}" placeholder="Escriba....." required>
       </div>

       <div class="col-12 col-md-6">
           <label><b>PERCEPCION</b></label>
           <input type="text" class="form-control" name="exam_nervioso_percepcion" value="{{ old('exam_nervioso_percepcion') ?? ''}}" placeholder="Escriba....." required>
       </div>

   </div>
   <h5>Paredes craneales</h5>

   <table id="table" class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">

       <tbody>
           <tr class="align-middle">
               <th style="width: 10%" rowspan="2">I</th>
               <th style="width: 40%"> Percepcion</th>
               <th style="width: 50%"> <input type="text" class="form-control" name="exam_pc_percepcion" value="{{ old('exam_pc_percepcion') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">

               <th> Identificacion</th>
               <th><input type="text" class="form-control" name="exam_pc_identificacion" value="{{ old('exam_pc_identificacion') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th rowspan="4">II</th>
               <th> Agudez visual</th>
               <th><input type="text" class="form-control" name="exam_pc_agudez" value="{{ old('exam_pc_agudez') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th> Vision de color</th>
               <th><input type="text" class="form-control" name="exam_pc_vesion" value="{{ old('exam_pc_vesion') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th> Campo visula</th>
               <th><input type="text" class="form-control" name="exam_pc_campov" value="{{ old('exam_pc_campov') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th> Pupilas</th>
               <th><input type="text" class="form-control" name="exam_pc_pupilas" value="{{ old('exam_pc_pupilas') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>III</th>
               <th> Motilidad del globo ocular</th>
               <th><input type="text" class="form-control" name="exam_pc_motilidad" value="{{ old('exam_pc_motilidad') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>IV</th>
               <th> Reflejos fotomotor</th>
               <th><input type="text" class="form-control" name="exam_pc_reflejos_f" value="{{ old('exam_pc_reflejos_f') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>V</th>
               <th> Reflejos de acomodacion</th>
               <th><input type="text" class="form-control" name="exam_pc_reflejos_a" value="{{ old('exam_pc_reflejos_a') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th rowspan="4">VI</th>
               <th>Sensitivo</th>
               <th><input type="text" class="form-control" name="exam_pc_sensitivos" value="{{ old('exam_pc_sensitivos') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>Reflejos corneales</th>
               <th><input type="text" class="form-control" name="exam_pc_reelejos_c" value="{{ old('exam_pc_reelejos_c') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>Motor</th>
               <th><input type="text" class="form-control" name="exam_pc_motor" value="{{ old('exam_pc_motor') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>Reflejos maseteros</th>
               <th><input type="text" class="form-control" name="exam_pc_reflejos_m" value="{{ old('exam_pc_reflejos_m') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>VII</th>
               <th>Valoracion muscular de la expresion facial</th>
               <th><input type="text" class="form-control" name="exam_pc_valoracion_m" value="{{ old('exam_pc_valoracion_m') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th rowspan="2">VIII</th>
               <th>Audicion (prueba de Rinne, Weber)</th>
               <th><input type="text" class="form-control" name="exam_pc_audicion" value="{{ old('exam_pc_audicion') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>Vestibular</th>
               <th><input type="text" class="form-control" name="exam_pc_vestibular" value="{{ old('exam_pc_vestibular') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>IX</th>
               <th>Reflejos nauseoso</th>
               <th><input type="text" class="form-control" name="exam_pc_reflejos_n" value="{{ old('exam_pc_reflejos_n') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th rowspan="2">X</th>
               <th>Tos debil o disfonia</th>
               <th><input type="text" class="form-control" name="exam_pc_tos_d" value="{{ old('exam_pc_tos_d') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>Asimetria paladar blando/trapecio reflejos nauseoso</th>
               <th><input type="text" class="form-control" name="exam_pc_asimetria_p" value="{{ old('exam_pc_asimetria_p') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>XI</th>
               <th>Valor fuerza de esternocleidomastoideo/trapecio</th>
               <th><input type="text" class="form-control" name="exam_pc_valor_f" value="{{ old('exam_pc_valor_f') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
           <tr class="align-middle">
               <th>XII</th>
               <th>Desviacion de la lengua/fasciculacion de la lengua</th>
               <th><input type="text" class="form-control" name="exam_pc_desviacion_l" value="{{ old('exam_pc_desviacion_l') ?? ''}}" placeholder="Escriba....." required></th>
           </tr>
       </tbody>

   </table>