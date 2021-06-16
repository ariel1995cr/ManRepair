function changeMarca(marca){
    let nombreMarca = marca;
    this.limpiarSelectModelos();
    if(nombreMarca != ''){
        this.obtenerModelos(nombreMarca);
    }
}

function limpiarSelectModelos(){
    let select = document.getElementById('modelo')
    for (let i = 0; i <= select.options.length-1; i++) {
        if(select.options[i].value != ''){
            select.options[i].remove();
        }
    }
}

async function obtenerModelos(marca, modeloSeleccionado=null){
    await axios.get('/admin/marcas/obtenerModelos/'+marca)
        .then(response=>{
            console.log(response);
            let select = document.getElementById('modelo');
            let option = document.createElement("option");
            response.data.forEach(modelo => {
                option.text = modelo.nombre;
                option.value = modelo.nombre;
                if(modelo.nombre == modeloSeleccionado){
                    option.selected = true;
                }
                select.add(option);
            })
        })
        .catch()
}

function changeDNICliente(dni){
    axios.get('/admin/clientes/campo/dni/dni/'+dni)
        .then(response=>{
            console.log(response.data);
            if(response.data == ""){
                console.log("hola");
                document.getElementById('nombre').readOnly = false;
                document.getElementById('apellido').readOnly = false;
                document.getElementById('telefono').readOnly = false;
                document.getElementById('email').readOnly = false;
            }else{
                let input = document.getElementById('nombre');
                input.readOnly = true;
                input.value = response.data.nombre;
                input = document.getElementById('apellido');
                input.readOnly = true;
                input.value = response.data.apellido;
                input = document.getElementById('telefono');
                input.readOnly = true;
                input.value = response.data.numero_de_telefono;
                input = document.getElementById('email');
                input.readOnly = true;
                input.value = response.data.email;
            }
        })
        .catch()
}

function enviarNotificacion(icon,title,text,footer=''){
    this.Swal.fire({
        icon: icon,
        title: title,
        text: text,
        footer: footer
    });
}



async function formularioCambioDeEstado(estado){
    let estadoNuevo = estado;

    let divs = await document.getElementById("divForm");

    if(estadoNuevo == ''){
        for (let i = 2; i < divs.children.length; i++) {
            if(divs.children[i].className == 'row'){
                divs.children[i].className = 'row d-none';
            }
        }
    }

    if(estadoNuevo == 'Presupuestado'){
        for (let i = 0; i < divs.children.length; i++) {
            if(divs.children[i].className == 'row d-none'){
                divs.children[i].className = 'row';
            }
        }
    }

    if (estadoNuevo != 'Presupuestado' && estadoNuevo != ''){
        for (let i = 6; i < divs.children.length; i++) {
            console.log(i);
            if(divs.children[i].className == 'row d-none'){
                divs.children[i].className = 'row';
            }
        }
    }
}

async function ordenDeServicioReingreso(nro){
    let resp = await axios.get('/admin/ordenDeServicio/reingresoValido/'+nro)
        .then(response=>{
            return true;
        })
        .catch(err=>{
            let mensaje = err.response.data.mensaje;
            enviarNotificacion('error', 'Error en el formulario', mensaje);
            return false;
        })
    return resp;
}

async function enviarFormOrdenDeServicioReingreso(){
    let nro = document.getElementById('nro_orden_anterior').value;
    if(nro == ''){
        return enviarNotificacion('error', 'Error en el formulario', 'No ingreso el número de la orden de servicio');
    }else{
        let resp = await this.ordenDeServicioReingreso(nro);
        if(resp){
            let form = document.getElementById('formCrearOrdenDeServicio');
            form.submit();
        }
    }
}


function crearInputForm(nombre,clase,label, claseDiv, inputTipo, type){
    let elemento = document.createElement('div');
    elemento.className =  claseDiv;

    let lbl = document.createElement('label');
    lbl.textContent = label;

    let input = document.createElement(inputTipo);
    input.name = nombre;
    input.id = nombre;
    input.className = clase;
    input.type = type;

    elemento.appendChild(lbl);
    elemento.appendChild(input);

    return elemento;
}

function formularioTipoDeReporte(tipoDeReporteSeleccionado){
    console.log(tipoDeReporteSeleccionado);
    let classVisible = 'row justify-content-center align-items-center mt-2'
    let classNoVisible = 'row d-none justify-content-center align-items-center mt-2'
    let divForm1 = document.getElementById('camposReporteDeServicio');
    let divForm2 = document.getElementById('camposCantidadDeReparadosyReparadosPorGarantia');
    let selectSeleccionarMarca = document.getElementById('selectSeleccionarMarca');

    divForm1.className = classNoVisible;
    divForm2.className = classNoVisible;
    selectSeleccionarMarca.className = 'row align-items-start mt-2';

    if(tipoDeReporteSeleccionado == 'reporte de servicio'){
        divForm1.className = classVisible;
        document.getElementById("btnradio1").checked = true;
    }
    if(tipoDeReporteSeleccionado == 'cantidad de reparados'){
        divForm2.className = classVisible;
        document.getElementById("btnradio2").checked = true;
    }
    if(tipoDeReporteSeleccionado == 'reparados por garantia del celular'){
        divForm2.className = classVisible;
        selectSeleccionarMarca.className = 'd-none';
        document.getElementById("btnradio3").checked = true;
    }
}

    function modalEvento(){
    var exampleModal = document.getElementById('modalBorrado');
    console.log(exampleModal);
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget
        // Extract info from data-bs-* attributes
        let idBorrar = button.getAttribute('data-id')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        let modalTitle = exampleModal.querySelector('.modal-title')

        let inputIdMarca = document.getElementById('nombreMarca');

        inputIdMarca.value = idBorrar;
        modalTitle.textContent = 'Borrar la marca ' + idBorrar;
    })
}
