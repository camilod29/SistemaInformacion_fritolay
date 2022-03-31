const open= document.getElementById('open_carrito');
const carrito_container= document.getElementById('carrito_container');
const close= document.getElementById('close_carrito');

open.addEventListener('click', () => {
    carrito_container.classList.add('show');
    
});

close.addEventListener('click', () => {
    carrito_container.classList.remove('show');
});