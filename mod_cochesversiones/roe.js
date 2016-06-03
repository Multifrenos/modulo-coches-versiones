function myFunction() {
    var x = document.getElementById("mySelect").value;
    document.getElementById("demo").innerHTML = "You selected: " + x;
}
function cambioModelo() {
		var value = document.getElementById("Minodelo").value;
		 alertaNueva(value);
		//~ var fRecuperar = { 
			 //~ init: function(val) {
				//~ var value   = '1',
				//~ request = {
						//~ 'option' : 'com_ajax',
						//~ 'module' : 'versioncoche',
						//~ 'data'   : value,
						//~ 'format' : 'raw'
					//~ };
			//~ .ajax({
				//~ type   : 'POST',
				//~ data   : request,
				//~ success: function (response) {
					//~ $('.status').html(response);
				//~ }
			//~ });
			//~ return false;
			//~ }
		//~ };
		//~ (document).ready(fRecuperar.init(value));
		var value= ' Segunda vez';
		alertaNueva(value);

}


function alertaNueva(val){
	var value = 'Ahora deberíamos caragar Modelos:' + val;

	alert(value);
	return;
	}
	
