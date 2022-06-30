function agregarEliminarProducto(boton){
    if (boton.getAttribute("accion") === "agregar") {
        const rowOrigen = boton.parentElement.parentElement;
        const rowAgregar = rowTemplate.content.cloneNode(true).children[0];
        const nombreCom = rowOrigen.children[2].textContent;
        const precioUni = rowOrigen.children[6].textContent;
        const btnEliminar = rowAgregar.querySelector("#btn-eliminar")

        rowAgregar.querySelector("#nombre-com").textContent = nombreCom;
        rowAgregar.querySelector("#precio-uni").textContent = precioUni;
        
        rowsContainer.append(rowAgregar);

        boton.setAttribute("pos", rowsContainer.childElementCount - 1);
        btnEliminar.setAttribute("pos", rowsContainer.childElementCount - 1);

        boton.setAttribute("accion", "eliminar");

    } else if (boton.getAttribute("accion") === "eliminar") {
        rowEliminarIndex = boton.getAttribute("pos");
        rowsContainer.removeChild(rowsContainer.children[rowEliminarIndex]);

        boton.setAttribute("pos", rowsContainer.childElementCount - 1);

        boton.setAttribute("accion", "agregar");
    }
}