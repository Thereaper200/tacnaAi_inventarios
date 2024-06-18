function comparacion(inventario_esperado, inventario_total) {
    if (inventario_esperado == inventario_total[0].textContent) {
        return new Notification(
            'INVENTARIO',{
                icon: '././img/logopl.png',
                body: 'El inventario esta correcto'
            }
        );
    }
}



const inventario_total = document.querySelectorAll('#inventario_total');

const boton_notificacion = document.querySelector('#notificacion_boton');

boton_notificacion.addEventListener('click', () => {
    Notification.requestPermission()
        .then(resultado => console.log(`El resultado es: ${resultado}`))
})

comparacion(2, inventario_total);