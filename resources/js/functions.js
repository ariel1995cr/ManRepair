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

function changeDNICliente(){
    let dni = event.target.value;
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

function crearInputForm(nombre,clase,label, claseDiv, inputTipo, type){
    let elementoPadre = document.createElement('div');
    elementoPadre.className =  'row';

    let elemento = document.createElement('div');
    elemento.className =  claseDiv;

    let lbl = document.createElement('label');
    lbl.textContent = label;

    let input = document.createElement(inputTipo);
    input.name = nombre;
    input.id = nombre;
    input.className = clase;
    input.type = type;
    if(nombre == 'importe_reparacion'){
        input.step = "0.01"
        input.min = "0"

    }

    elemento.appendChild(lbl);
    elemento.appendChild(input);
    elementoPadre.appendChild(elemento);
    return elementoPadre;


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

