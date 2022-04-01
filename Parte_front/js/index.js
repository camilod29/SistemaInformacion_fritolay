const urlProducto = "http://localhost/clase/SistemaInformacion_fritolay/parte_php/productos";

let listaProductos = [];
let idProductos = 0;
let Producto = null;

function indexProducto() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaProductos = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlProducto, true);
    xhttp.send();
}
indexProducto();

function asignarDatosTablaHtml() {
    let html = '';
    for(let item of listaProductos){
        
        html += '<div class="product-container">'; 
        html += '<img src="resources/example-image.jpg" alt="">';
        html += '<h3>'+ item.nombre +'</h3>';
        html += '<h1>$'+ item.precio +'</h3>';
        html += '<button class="btn btn-warning">Agregar</button>';
        html += '</div>';
    }
    if(html == ''){
        html += '<tr>';
        html += '   <td class="3">No hay datos registrados</td>';
        html += '</tr>';
    }
    const element = document.getElementById('catalogoProducto').getElementsByTagName('div')[0];
    element.innerHTML = html;
}

function crear(){
    let idProductos = 0;
    let Producto = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Registrar Producto';
    document.getElementById('nombre').value= '';
    document.getElementById('Imagen').value= '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}


function saveDataForm(event){
    event.preventDefault();
    let data = '';
    data += 'nombre=' + document.getElementById('nombre').value;
    data += '&cantidad=' + document.getElementById('cantidad').value;
    data += '&categoria=' + document.getElementById('categoria').value;
    data += '&descripcion=' + document.getElementById('descripcion').value;
    data += '&imagen=' + document.getElementById('imagen').value;
    data += '&precio=' + document.getElementById('precio').value;
    save(data);
}

function save(data) {
    let reponse = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            reponse = JSON.parse(this.response);
            indexProducto();
        }
    };
    let param = idProductos > 0 ? '/' + idProductos : '';
    let metodo = idProductos > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlProducto + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

const open= document.getElementById('open_carrito');
const carrito_container= document.getElementById('carrito_container');
const close= document.getElementById('close_carrito');

open.addEventListener('click', () => {
    carrito_container.classList.add('show');
    
});

close.addEventListener('click', () => {
    carrito_container.classList.remove('show');
});


const open_description= document.getElementById('open_description');
const description_container= document.getElementById('description_container');
const close_description= document.getElementById('close_description');

open_description.addEventListener('click', () => {
    description_container.classList.add('show');
    
});

close_description.addEventListener('click', () => {
    description_container.classList.remove('show');
});