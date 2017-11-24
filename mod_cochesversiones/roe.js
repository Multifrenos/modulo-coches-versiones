function CambioMarcas() {
	// Limpiamos siempre el contenido de marcas
	//~ EliminarModelos();
	EliminarVersiones();
	if (document.getElementById("myMarca").value != 0){
		//~ alert('Estoy en funcion Marcas y activamos modelo');
		AddModelos()
		document.getElementById("nodelo").disabled = false;
		document.getElementById("versiones").disabled = true;

		// Ahora ejecutamos funcion de modelo.
		
	} else {
		// Eliminamos opciones de y Volvemos a bloquear select de modelo
		
		document.getElementById("nodelo").disabled = true;
		document.getElementById("versiones").disabled = false;

	}
}


function AddModelos() {
	// Antes de nada debemos eliminar registros si tiene.
	// alert( 'Entramos en funcion de Modelos');
	// Bucle para crear los modelos para marca seleccionada.
	
	for (i=0;i<modelos.length;i++){
	var x = document.getElementById("nodelo");
    var option = document.createElement("option");
    option.text = modelos[i].nombre;
    option.value = modelos[i].id;
    x.add(option);
   	} 
   	document.getElementById("Numero_modelos").innerHTML="("+i+")";
}
function EliminarModelos() {
	// alert( 'Entramos en funcion de Modelos');
	// Bucle para crear los modelos para marca seleccionada.
	//~ $('select[name=Minodelo]').remove();
	var xOption = document.getElementById("nodelo");
	var y =  xOption.options.length;
	 //~ alert( ' Numero elementos:' + x.options.length);
    //~ x.options.remove();

	for (i=0;i<y;i++){
	//~ // //~ var x = document.getElementById("nodelo");
    xOption.remove(0);
   	} 
   	console.log('I='+i+' options= '+y);
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
   	document.getElementById("Numero_versiones").innerHTML="("+i+")";

}
function EliminarVersiones() {
	// alert( 'Entramos en funcion de Modelos');
	// Bucle para crear los modelos para marca seleccionada.
	var xOption = document.getElementById("versiones");
	// alert( ' Numero elementos' + x.length);
	var y =  xOption.options.length;
	 //~ alert( ' Numero elementos:' + x.options.length);
    //~ x.options.remove();

	for (i=0;i<y;i++){
	//~ // //~ var x = document.getElementById("nodelo");
    xOption.remove(0);
   	} 
   	console.log('I='+i+' options= '+y);
}
