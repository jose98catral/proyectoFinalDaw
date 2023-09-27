var dateInput = document.getElementById("fecha");

// Escuchar el evento de cambio en el valor seleccionado
dateInput.addEventListener("change", function() {
  // Obtener la fecha seleccionada
  var selectedDate = new Date(this.value);

  // Verificar si la fecha seleccionada es un sábado, domingo o lunes
  if (selectedDate.getDay() === 0 || selectedDate.getDay() === 6 || selectedDate.getDay() === 1) {
    // Restringir la selección estableciendo el valor en vacío
    this.value = "";
    alert("No se pueden seleccionar sábados, domingos o lunes.");
  }
});