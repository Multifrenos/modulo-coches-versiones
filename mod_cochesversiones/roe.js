function CambioMarcas() {
	if (document.getElementById("myMarca").value != 0){
		//~ alert('Estoy en funcion Marcas y activamos modelo');
		document.getElementById("nodelo").disabled = false;
		// Ahora ejecutamos funcion de modelo.
		AddModelos()
	} else {
		// Eliminamos opciones de y Volvemos a bloquear select de modelo
		EliminarModelos();
		EliminarVersiones();
		document.getElementById("nodelo").disabled = true;
		document.getElementById("versiones").disabled = false;

	}
}


function AddModelos() {
	// Antes de nada debemos eliminar registros si tiene.
	EliminarModelos();
	// alert( 'Entramos en funcion de Modelos');
	// Bucle para crear los modelos para marca seleccionada.
	
	for (i=0;i<modelos.length;i++){
	var x = document.getElementById("nodelo");
    var option = document.createElement("option");
    option.text = modelos[i].nombre;
    option.value = modelos[i].id;
    x.add(option);
   	} 
}
function EliminarModelos() {
	// alert( 'Entramos en funcion de Modelos');
	// Bucle para crear los modelos para marca seleccionada.
	var x = document.getElementById("nodelo");
	// alert( ' Numero elementos' + x.length);
	for (i=0;i<x.length;i++){
	var x = document.getElementById("nodelo");
    x.remove(1);
   	} 
}
function CambioModelos() {
	EliminarVersiones();

	if (document.getElementById("nodelo").value != 0){
		//~ alert('Acabo de cambiar el modelo y activamos version');
		document.getElementById("versiones").disabled = false;
		// Ahora ejecutamos funcion de añadir version.
		AddVersiones()
	} else {
		// Eliminamos opciones de y Volvemos a bloquear select de modelo
		document.getElementById("versiones").disabled = true;
		
	}
}

function AddVersiones() {
	// Antes de nada debemos eliminar registros si tiene.
	// alert( 'Entramos en funcion de Modelos');
	// Bucle para crear los modelos para marca seleccionada.
	
	for (i=0;i<versiones.length;i++){
	var x = document.getElementById("versiones");
    var option = document.createElement("option");
    option.value = versiones[i].id;
    option.text = versiones[i].nombre+' '+versiones[i].cv+'cv. '+versiones[i].fecha_inicial;

    x.add(option);
   	} 
}
function EliminarVersiones() {
	// alert( 'Entramos en funcion de Modelos');
	// Bucle para crear los modelos para marca seleccionada.
	var x = document.getElementById("versiones");
	// alert( ' Numero elementos' + x.length);
	for (i=0;i<x.length;i++){
	var x = document.getElementById("versiones");
    x.remove(1);
   	} 
}
