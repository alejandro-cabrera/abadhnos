const formulario = document.querySelector("#barra-busqueda");
const mensajeBusqueda = document.querySelector("#mensaje-busqueda");
const resultado = document.querySelector("#resultado");


function fetchgo() {
    let data = new URLSearchParams();
    data.append("filtro", document.querySelector("#filtro").value);
    data.append("keywords", document.querySelector("#keywords").value);

    fetch("http://localhost/www/dll/busqueda.php", {
        method: "post",
        body: data
    })
    .then(function(response){
        return response.text();
    })
    .then(function(text){
        resultado.innerHTML = text;
    })
    return false;
}


formulario.addEventListener("submit", () => {
    const visibilidadMensaje = mensajeBusqueda.getAttribute("visible");
    const visibilidadResultado = resultado.getAttribute("visible");

    if (visibilidadMensaje === "true"){
        mensajeBusqueda.setAttribute("visible", false);
        resultado.setAttribute("visible", true);
    }
});

const rowTemplate = document.querySelector("[row-template]");
//const rowAgregar = rowTemplate.content.cloneNode(true).children[0];
const rowsContainer = document.querySelector("[rows-container]")

function agregarProducto(boton){
    const rowBoton = boton.parentElement.parentElement
    const id = rowBoton.children[1].textContent;
    const nombreCom = rowBoton.children[2].textContent;
    const precio = rowBoton.children[6].textContent;
    const agregar = boton.value;
    let data = new FormData();

    data.append("id", id);
    data.append("nombre", nombreCom);
    data.append("precio", precio);
    data.append("añadir", agregar);

    const XHR = new XMLHttpRequest();
    
    XHR.addEventListener( 'load', function( event ) {
        if(XHR.responseText === "ya-existente"){
            console.log(XHR.responseText);
        } else {
            verPedido(XHR.responseText, true);
        }
    });
    
    XHR.open('POST', "http://localhost/www/dll/agregarAPedido.php");
    XHR.send(data);
}


function comprobarPedidos() {
    let data = new FormData;
    const comprobar = true;
    data.append("comprobar", comprobar);
    const XHR = new XMLHttpRequest();
    XHR.open('POST', "http://localhost/www/dll/agregarAPedido.php");
    XHR.send(data);

    XHR.addEventListener( 'load', function( event ) {
        if(XHR.responseText){
            verPedido(XHR.responseText, false);
        }
    });

}

window.onload = comprobarPedidos();


function verPedido(pedido, i) {
    pedido = JSON.parse(pedido);
    if (i===true) {
      pedido = {"": pedido};  
    } 
    console.log(pedido);

    for(var key in pedido) {
        const rowAgregar = rowTemplate.content.cloneNode(true).children[0];
        rowAgregar.querySelector(".entrada-cantidad").setAttribute("id", "cantidad".pedido[key]["item_id"]);
        for(var key1 in pedido[key]){
            if(key1 === "item_id") rowAgregar.querySelector("#item-id").textContent = pedido[key][key1];
            if(key1 === "item_nombre") rowAgregar.querySelector("#nombre-com").textContent = pedido[key][key1];
            if(key1 === "item_precio") rowAgregar.querySelector("#precio-uni").textContent = pedido[key][key1];
            rowsContainer.append(rowAgregar);
        }
    }
}


function borrarPedido(){
    let data = new FormData;
    const borrar = true;
    data.append("borrar", borrar);
    const XHR = new XMLHttpRequest();
    XHR.open('POST', "http://localhost/www/dll/agregarAPedido.php");
    XHR.send(data);

}

function quitarProducto(boton){
    let data = new FormData;
    const rowEliminar = boton.parentElement.parentElement;
    const idItem = boton.parentElement.nextElementSibling.textContent;
    const quitar = true;
    
    data.append("item-id", idItem);
    data.append("quitar", quitar);
    const XHR = new XMLHttpRequest();
    XHR.open('POST', "http://localhost/www/dll/agregarAPedido.php");
    XHR.send(data); 


    XHR.addEventListener( 'load', function( event ) {
        if(XHR.responseText === "item-quitado"){
            rowEliminar.remove();
        }
    });
}

/*
const entradaCantidad = document.querySelector(".entrada-cantidad");

entradaCantidad.addEventListener('input', calcularPrecioFinal());

calcularPrecioFinal(cantidad) {
    let precioFinal;
      
}*/