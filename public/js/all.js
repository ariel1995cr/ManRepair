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
            let select = document.getElementById('modelo')
            let option = document.createElement("option");
            response.data.forEach(modelo => {
                option.text = modelo.nombre;
                option.value = modelo.nombre +'-'+modelo.nombre_marca
                select.add(option);
            })
        })
        .catch()
}
