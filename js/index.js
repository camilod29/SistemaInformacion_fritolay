const open= document.getElementById('open');
const carrito_container= document.getElementById('carrito_container');
const close_carrito= document.getElementById('close_carrito');

open.addEventListener('click', () => {
    carrito_container.classList.add('show');
    alert('pene');
});

close.addEventListener('click', () => {
    carrito_container.classList.remove('show');
});