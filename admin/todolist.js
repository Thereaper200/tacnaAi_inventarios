const fecha = document.querySelector('#fecha') 
const lista = document.querySelector('#lista') 
const input = document.querySelector('#input') 
const enter = document.querySelector('#enter') 
const check = 'fa-check-circle'
const uncheck = 'fa-circle'
const lineThrough = 'line-through'
let id
let LIST

//CREACION DE FECHA
const FECHA = new Date()
fecha.innerHTML=FECHA.toLocaleDateString('es-MX', {weekday:'long',month:'long',day:'numeric'})
// FUNCION AGREGAR TAREA
function agregarTarea(tarea, id, realizado, eliminado){
    if(eliminado){return}

    const REALIZADO = realizado ?check:uncheck
    const LINE = realizado ?lineThrough:''

    const elemento = `<li>
                        <i class="far ${REALIZADO}" data="realizado" id=${id}></i>
                        <p class="text ${LINE}">${tarea}</p>
                        <i class="fas fa-trash de" data="eliminado" id=${id}></i>
                        </li>
                       `
                       lista.insertAdjacentHTML("afterbegin", elemento)
}
// FUNCION TAREA REALIZADA
function tareaRealizada(element){
    element.classList.toggle(check)
    element.classList.toggle(uncheck)
    element.parentNode.querySelector('.text').classList.toggle(lineThrough)
    LIST[element.id].realizado = LIST[element.id].realizado ?false :true
}
// FUNCION TAREA ELIMINADA
function tareaEliminada(element){
    element.parentNode.parentNode.removeChild(element.parentNode)
    LIST[element.id].eliminado = true
}
//EVENTO DE CLICK PARA AGREGAR DATOS CON EL ICONO
enter.addEventListener('click',()=>{
    const tarea= input.value
    if(tarea){
        agregarTarea(tarea,id,false,false)
        LIST.push({
            nombre:tarea,
            id:id,
            realizado:false,
            eliminado:false
        })
    }
    localStorage.setItem('TODO',JSON.stringify(LIST))
    input.value=''
    id++
})
//EVENTO QUE HACE QUE EL ENTER PUEDA SER USADO AL IGUAL QUE EL ICONO PARA AGREGAR
document.addEventListener('keyup', function(event){
    if(event.key=='Enter'){
        const tarea = input.value
        if(tarea){
            agregarTarea(tarea,id,false,false)
            LIST.push({
                nombre:tarea,
                id:id,
                realizado:false,
                eliminado:false
            })
        }
    localStorage.setItem('TODO',JSON.stringify(LIST))
    input.value
    id++
    }
})

lista.addEventListener('click', function(event){
    const element = event.target
    const elementData = element.attributes.data.value
    if(elementData==='realizado'){
        tareaRealizada(element)
    }
    if(elementData==='eliminado'){
        tareaEliminada(element)
    }
    localStorage.setItem('TODO',JSON.stringify(LIST))
})
// LOCAL STORAGE
let data = localStorage.getItem('TODO')
if(data){
    LIST=JSON.parse(data)
    id = LIST.length
    cargarLista(LIST)
}
else{
    LIST= []
    id=0
}
// CARGA LA INFORMACION DE LAS TAREAS QUE QUEDARON
function cargarLista(DATA){
    DATA.forEach(function(i){
        agregarTarea(i.nombre,i.id,i.realizado,i.eliminado)
    })
}