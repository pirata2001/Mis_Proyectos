<style type="text/css">
    h3 {
        text-align: center;
    }
</style>
<link rel="stylesheet" href="css/bootstrap.min.css">
<div class="container">
    <div class="caja_popup" id="formregistrar">
        <div class="bd-example">

            <form action="aggpersonas.php" class="row g-3" method="POST">
                <h3>Agregar Persona</h3>

                <div class="col-md-3">
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control"
                        placeholder="Primer Nombre" id="validationServer05" name="txtnombre" maxlength="20" required>
                </div>

                <div class="col-md-3">
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control"
                        placeholder="Segundo Nombre" id="validationServer05" name="txtnombredos" maxlength="20">

                </div>

                <div class="col-md-3">
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control"
                        placeholder="Primer Apellido" id="validationServer05" name="txtapellido" maxlength="20"
                        required>

                </div>

                <div class="col-md-3">
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control"
                        placeholder="Segundo Apellido" id="validationServer05" name="txtapellidodos" maxlength="20">

                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" id="validationServer05" placeholder="Cedula"
                        name="txtcedula" onkeyUp="return ValNumero(this);" maxlength="20" size="20" required>
                </div>

                <div class="col-md-3">
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control"
                        id="validationServer05" placeholder="Dirección" name="txtdireccion" maxlength="100">

                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" id="validationServer05" placeholder="Teléfono"
                        name="txttelefono" onkeyUp="return ValNumero(this);" maxlength="11">
                </div>

                <div class="col-md-3">
                    <input class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        id="validationServer05" placeholder="Correo Electronico" type="email" name="txtcorreo"
                        maxlength="50">
                </div>

                <div class="col-md-3">
                    <input class="form-control" id="validationServer05" placeholder="Peso en KG" class="form-control"
                        type="text" name="txtpeso" onkeyUp="return ValNumero(this);" maxlength="3">
                </div>

                <div class="col-md-3">
                    <input class="form-control" id="validationServer05" type="text" placeholder="Talla de Calzado"
                        name="txtcalzado" onkeyUp="return ValNumero(this);" maxlength="2">
                </div>

                <div class="col-md-3">
                    <input class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        id="validationServer05" placeholder="Profesión" type="text" name="txtprofesion" maxlength="20"
                        required>
                </div>
                <div class="col-md-3">
                    Estado Civil
                    <select class="form-select" name="txtcivil"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        <option>Soltero</option>
                        <option>Casado</option>
                        <option>Divorciado</option>
                        <option>Viudo</option>
                        <option>Concubinato</option>
                    </select>

                </div>

                <div class="col-md-3">
                    Fecha de Nacimiento
                    <input class="form-control" type="date" id="validationServer05" name="txtfnacimiento" required>

                </div>

                <div class="col-md-3">

                    Sexo
                    <select class="form-select" name="txtsexo" required>
                        <option selected>M</option>
                        <option>F</option>
                    </select>
                </div>

                <div class="col-md-3">
                    Grado de Instrucción
                    <select class="form-select" name="txtgrado" required>
                        <option selected>Ninguno</option>
                        <option>Básica</option>
                        <option>Bachiller</option>
                        <option>Técnico Medio</option>
                        <option>Universitario</option>
                        <option>Post Grado</option>
                        <option>Doctorado</option>
                        <option>PhD</option>
                    </select>
                </div>

                <div class="col-md-3">
                    Tiene alguna discapacidad
                    <select class="form-select" name="txtdiscapacidad" required>
                        <option>No</option>
                        <option>Autismo</option>
                        <option>Síndrome de Asperger</option>
                        <option>Trastorno de Desarrollo </option>
                        <option>Deficiencia visual</option>
                        <option>Discapacidad física</option>
                        <option>Transtorno del lenguaje</option>
                        <option>Dificultades del aprendizaje</option>
                        <option>Discapacidad adutiva</option>
                        <option>Síndrome de Down</option>
                        <option>Síndromede Rett</option>
                        <option>Síndromede Asperger</option>
                        <option>Pérdida de memoria</option>
                        <option>Deterioro cognitivo</option>
                        <option>Discapacidad múltiple</option>
                    </select>
                </div>

                <div class="col-md-3">
                    Sufre alguna Enfermedad crónica
                    <select class="form-select" name="txtenfermedad" required>
                        <option>No</option>
                        <option>Hipertensión</option>
                        <option>Colesterol alto</option>
                        <option>Artritis</option>
                        <option>Cardiopatía isquémica</option>
                        <option>Diabetes</option>
                        <option>Enfermedad renal crónica</option>
                        <option>Insuficiencia cardiaca</option>
                        <option>Depresión</option>
                        <option>Enfermedad de Alzheimer</option>
                        <option>Otras formas de demencia</option>
                        <option> Enfermedad pulmonar</option>
                        <option>Enfermedad crónica múltiple</option>
                    </select>
                </div>
                <div class="col-md-3">
                    Posee vivienda propia
                    <select class="form-select" name="txtposeevivienda" id="poseevivienda" required>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-md-3">
                    Indique el tipo de vivienda
                    <select class="form-select" name="txttipovivienda" id="tipovivienda">
                        <option>Ninguna</option>
                        <option>Casa</option>
                        <option>Chalet</option>
                        <option>Tienda</option>
                        <option>Choza</option>
                        <option>Piso</option>
                        <option>Rancho</option>
                        <option>Departamento</option>
                        <option>Quinta</option>
                    </select>
                </div>

                <div class="botones">

                    <a class="btn btn-danger " href="people.php">Cancelar</a>

                    <input type="submit" class="btn btn-primary " name="btnregistrar" value="Registrar"
                        onClick="javascript: return confirm('¿Deseas registrar a este usuario?');">

                </div>

            </form>

        </div>

    </div>
</div>

<script>
    function Solo_Numerico(variable) {
        Numer = parseInt(variable);
        if (isNaN(Numer)) {
            return "";
        }
        return Numer;
    }

    function ValNumero(Control) {
        Control.value = Solo_Numerico(Control.value);
    }
</script>
<script>
    const poseeViviendaSelect = document.getElementById('poseevivienda');
    const tipoViviendaSelect = document.getElementById('tipovivienda');
    poseeViviendaSelect.addEventListener('change', () => {
        if (poseeViviendaSelect.value === 'SI') {
            tipoViviendaSelect.style.display = 'block'; // mostrar el tipo de vivienda
        } else {
            tipoViviendaSelect.style.display = 'none'; // ocultar el tipo de vivienda
        }
    });
</script>