$(document).ready(function(){
	$('.modal').modal();
	$('select').material_select();
	$(".button-collapse").sideNav();
	$('.tooltipped').tooltip({delay: 50});
	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15, // Creates a dropdown of 15 years to control year,
	    today: 'Hoy',
	    clear: 'Limpiar',
	    close: 'Ok',
	  });
	
});