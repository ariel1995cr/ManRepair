function changeMarca(marca) {
    let nombreMarca = marca;
    this.limpiarSelectModelos();
    if (nombreMarca != '') {
        this.obtenerModelos(nombreMarca);
    }
}

function limpiarSelectModelos() {
    let select = document.getElementById('modelo')
    for (let i = 0; i <= select.options.length - 1; i++) {
        if (select.options[i].value != '') {
            select.options[i].remove();
        }
    }
}

async function obtenerModelos(marca, modeloSeleccionado = null) {
    await axios.get('/admin/marcas/obtenerModelos/' + marca)
        .then(response => {
            let select = document.getElementById('modelo');
            response.data.forEach(modelo => {
                let option = document.createElement("option");
                option.text = modelo.nombre;
                option.value = modelo.nombre;
                if (modelo.nombre == modeloSeleccionado) {
                    option.selected = true;
                }
                select.add(option);
            })
        })
        .catch()
}

function changeDNICliente(dni) {
    axios.get('/admin/clientes/campo/dni/dni/' + dni)
        .then(response => {
            console.log(response.data);
            if (response.data.encontrado == false) {
                document.getElementById('nombre').readOnly = false;
                document.getElementById('apellido').readOnly = false;
                document.getElementById('telefono').readOnly = false;
                document.getElementById('email').readOnly = false;
            } else {
                let input = document.getElementById('nombre');
                input.readOnly = true;
                input.value = response.data.cliente.nombre;
                input = document.getElementById('apellido');
                input.readOnly = true;
                input.value = response.data.cliente.apellido;
                input = document.getElementById('telefono');
                input.readOnly = true;
                input.value = response.data.cliente.numero_de_telefono;
                input = document.getElementById('email');
                input.readOnly = true;
                input.value = response.data.cliente.email;
            }
        })
        .catch()
}

function enviarNotificacion(icon, title, text, footer = '') {
    this.Swal.fire({
        icon: icon,
        title: title,
        text: text,
        footer: footer
    });
}



async function formularioCambioDeEstado(estado) {
    let estadoNuevo = estado;

    let divs = await document.getElementById("divForm");

    if (estadoNuevo == '') {
        for (let i = 2; i < divs.children.length; i++) {
            if (divs.children[i].className == 'row') {
                divs.children[i].className = 'row d-none';
            }
        }
    }

    if (estadoNuevo == 'Presupuestado') {
        for (let i = 0; i < divs.children.length; i++) {
            if (divs.children[i].className == 'row d-none') {
                divs.children[i].className = 'row';
            }
        }
    }

    if (estadoNuevo != 'Presupuestado' && estadoNuevo != '') {
        for (let i = 6; i < divs.children.length; i++) {
            console.log(i);
            if (divs.children[i].className == 'row d-none') {
                divs.children[i].className = 'row';
            }
        }
    }
}

async function ordenDeServicioReingreso(nro) {
    let informacionOrden = document.getElementById('informacionOrden');
    let resp = await axios.get('/admin/ordenDeServicio/reingresoValido/' + nro)
        .then(response => {
            let ordenDeServicio = response.data.orden;
            let date = new Date(ordenDeServicio['created_at']);
            let dateParse = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
            informacionOrden.innerHTML = `Motivo de la orden: ${ordenDeServicio['motivo_orden']} <br> Descripción estado del celular: ${ordenDeServicio['descripcion_estado_celular']} <br> Fecha ingreso: ${dateParse}`
            return true;
        })
        .catch(err => {
            informacionOrden.innerHTML = '';
            let mensaje = err.response.data.mensaje;
            enviarNotificacion('error', 'Error en el formulario', mensaje);
            let ordennro = document.getElementById('nro_orden_anterior');
            ordennro.value = '';
            return false;
        })
    return resp;
}

async function enviarFormOrdenDeServicioReingreso() {
    let nro = document.getElementById('nro_orden_anterior').value;
    if (nro == '') {
        return enviarNotificacion('error', 'Error en el formulario', 'No ingreso el número de la orden de servicio');
    } else {
        let resp = await this.ordenDeServicioReingreso(nro);
        if (resp) {
            let form = document.getElementById('formCrearOrdenDeServicio');
            form.submit();
        }
    }
}


function crearInputForm(nombre, clase, label, claseDiv, inputTipo, type) {
    let elemento = document.createElement('div');
    elemento.className = claseDiv;

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

function formularioTipoDeReporte(tipoDeReporteSeleccionado) {
    console.log(tipoDeReporteSeleccionado);
    let divForm1 = document.getElementById('todos');
    let divForm2 = document.getElementById('selectSeleccionarEstado');
    let divForm3 = document.getElementById('selectSeleccionarMarca');
    let divFormBotton = document.getElementById('BotonGenerar');

    let classVisible = 'row justify-content-center align-items-center mt-2'
    let classNoVisible = 'row d-none justify-content-center align-items-center mt-2'

    divForm1.className = classVisible;


    if (tipoDeReporteSeleccionado == 'reporte de servicio') {
        divForm2.className = 'row align-items-start mt-2';
        divForm3.className = 'd-none row align-items-start mt-2';
        document.getElementById("btnradio1").checked = true;
    }
    if (tipoDeReporteSeleccionado == 'cantidad de reparados') {
        divForm2.className = 'd-none row align-items-start mt-2';
        divForm3.className = 'row align-items-start mt-2';
        document.getElementById("btnradio2").checked = true;
    }
    if (tipoDeReporteSeleccionado == 'reparados por garantia del celular') {
        divForm2.className = 'd-none row align-items-start mt-2';
        divForm3.className = 'row align-items-start mt-2';
        document.getElementById("btnradio3").checked = true;
    }
    divFormBotton.className = "row align-items-start mt-3";
}

function modalEvento() {
    var exampleModal = document.getElementById('modalBorrado');
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget
        // Extract info from data-bs-* attributes
        let idBorrar = button.getAttribute('data-id')
        let idBorrarD = button.getAttribute('data-idModelo')

        ///
        if (idBorrar !== null) {
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            let modalTitle = exampleModal.querySelector('.modal-title')

            let inputIdMarca = document.getElementById('nombreMarca');

            inputIdMarca.value = idBorrar;

            modalTitle.textContent = 'Borrar la marca ' + idBorrar;
        } else {
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            let modalTitle = exampleModal.querySelector('.modal-title')

            let inputIdMarca = document.getElementById('nombreMarca');

            inputIdMarca.value = idBorrarD;

            modalTitle.textContent = 'Borrar el modelo ' + idBorrarD;
        }


    })

    var modalReactivar = document.getElementById('modalReactivar');
    modalReactivar.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget
        // Extract info from data-bs-* attributes
        let idBorrar = button.getAttribute('data-id')
        let idBorrarD = button.getAttribute('data-idModelo')


        if (idBorrar !== null) {
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            let modalTitle = modalReactivar.querySelector('.modal-title')

            let inputIdMarca = document.getElementById('nombreMarcaReactivar');

            inputIdMarca.value = idBorrar;
            modalTitle.textContent = 'Reactivar la marca ' + idBorrar;
        } else {
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            let modalTitle = modalReactivar.querySelector('.modal-title')

            let inputIdMarca = document.getElementById('nombreMarcaReactivar');

            inputIdMarca.value = idBorrarD;
            modalTitle.textContent = 'Reactivar el modelo ' + idBorrarD;
        }
    })
}

function eliminarFoto(valor){
   if(valor.checked){
       document.getElementById("CambiarFoto").className = "mb-3 d-none";
   }else{
       document.getElementById("CambiarFoto").className = "mb-3";
   }
}
