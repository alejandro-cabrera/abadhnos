const formulario = document.querySelector("#barra-busqueda");
const mensajeBusqueda = document.querySelector("#mensaje-busqueda");
const resultado = document.querySelector("#resultado");


function fetchgo() {
    let data = new URLSearchParams();
    data.append("filtro", document.querySelector("#filtro").value);
    data.append("keywords", document.querySelector("#keywords").value);

    fetch("http://localhost/abadhnos/dll/busqueda.php", {
        method: "post",
        body: data
    })
    .then(function(response){
        return response.text();
    })
    .then(function(text){
        console.log(text);
        resultado.innerHTML = text;
    })
    return false;
}


formulario.addEventListener("submit", () => {
    const visibilidadMensaje = mensajeBusqueda.getAttribute("visible");
    const visibilidadResultado = resultado.getAttribute("visible");

    console.log(visibilidadMensaje);
    console.log(visibilidadResultado);

    if (visibilidadMensaje === "true"){
        mensajeBusqueda.setAttribute("visible", false);
        resultado.setAttribute("visible", true);
    
        console.log(visibilidadMensaje);
        console.log(visibilidadResultado);
    }
});

const rowTemplate = document.querySelector("[row-template]")
const rowsContainer = document.querySelector("[rows-container]")

function agregarProducto(boton){
    const rowBoton = boton.parentElement.parentElement
    const id = rowBoton.children[1];
    const nombreCom = rowBoton.children[2];
    const precio = rowBoton.children[6];
    const agregar = boton.value;
    let data = new URLSearchParams();

    data.append("id", id);
    data.append("nombre", nombreCom);
    data.append("precio", precio);
    data.append("agregar", agregar);

    fetch("http://localhost/abadhnos/dll/agregarAPedido.php", {
        method: "post",
        body: data
    })
    .then(function(response){
        return response.text();
    })
    .then(function(text){
        console.log(text);
        resultado.innerHTML = text;
    })
    return false;
}