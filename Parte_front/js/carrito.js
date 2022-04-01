const urlProductos = "http://localhost/clase/SistemaInformacion_fritolay/parte_php/productos";
const urlCarrito = "http://localhost/clase/SistemaInformacion_fritolay/parte_php/carrito";


let listaCarrito = [];
let idCarrito = 0;
let Carrito = null;

let listaProducto = [];

function indexCarrito() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaCarrito = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlCarrito, true);
    xhttp.send();
}
indexCarrito();

function indexProducto() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaProducto = response.data;
        }
    };
    xhttp.open("GET", urlProductos, true);
    xhttp.send();
}


function asignarDatosTablaHtml() {
    indexProducto();
    let html = '';
    for(let item of listaCarrito){
        
        html += '<tr>';
        let producto_name = buscarProducto(item.producto_id);
        html += '<td class="tabla__th">'+ producto_name +'</td>';
        html += '<td class="tabla__th">'+ item.cantidad +'</td>';
        html += '<td class="tabla__th">';
        html += '   <div class = "contentButtons">';
        html += '       <button class = "contentButtons__button contentButtons__button-verde" onclick="detalle('+ item.id +')"><img src="resources/clipboard.svg" alt="detalle"></button>';
        html += '       <button class = "contentButtons__button contentButtons__button-azul" onclick="modificar('+ item.id +')"><img src="resources/gear.svg" alt="modificar"></button>';
        html += '       <button class = "contentButtons__button contentButtons__button-rojo" onclick="eliminar('+ item.id +')"><img src="resources/trash.svg" alt="eliminar"></button>';
        html += '   </div>';
        html += '</td>';
        html += '</tr>';
    }
    if(html == ''){
        html += '<tr>';
        html += '   <td class="3">No hay datos registrados</td>';
        html += '</tr>';
    }
    const element = document.getElementById('carrito').getElementsByTagName('tbody')[0];
    element.innerHTML = html;
}

function buscarProducto(item){
    let producto = '';
        for(let a=0;a<listaProducto.length;a++){
            if(listaProducto[a].id == item){
                producto = listaProducto[a].nombre;
                return producto;
            }
        }      
}
function saveDataFormCart(event, id){
    event.preventDefault();
    let data = '';
    data += 'producto_id=' +id;
    data += '&cantidad=' + document.getElementById('cantidad_compra'+id).value;
    console.log(data);
    saveC(data);
}

function saveC(data) {
    let reponse = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            reponse = JSON.parse(this.response);
            indexCarrito();
        }
    };
    let param = idProductos > 0 ? '/' + idProductos : '';
    let metodo = idProductos > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlCarrito + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

function onClickCarrito(){
    indexCarrito();
}