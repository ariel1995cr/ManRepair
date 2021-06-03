function changeMarca(){
    let nombreMarca = event.target.value;
    this.limpiarSelectModelos();
    if(event.target.value != ''){
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

function obtenerModelos(marca){
    axios.get('/admin/marcas/obtenerModelos/'+marca)
        .then(response=>{
            console.log(response);
            let select = document.getElementById('modelo');
            let option = document.createElement("option");
            response.data.forEach(modelo => {
                option.text = modelo.nombre;
                option.value = modelo.nombre;
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
