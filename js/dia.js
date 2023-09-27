// Obtén la fecha actual
var fechaActual = new Date();
    
// Añade un día a la fecha actual para obtener la fecha mínima
fechaActual.setDate(fechaActual.getDate() + 1);

// Formatea la fecha mínima en el formato YYYY-MM-DD requerido por el input date
var formatoFechaMinima = fechaActual.toISOString().split('T')[0];

// Establece la fecha mínima en el atributo min del input date
document.getElementById("fecha").min = formatoFechaMinima;