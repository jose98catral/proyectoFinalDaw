function handleCheckboxChange(checkbox) {
    var checkboxes = document.querySelectorAll('.cortes input[type="checkbox"]');
    var checkedCount = 0;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            checkedCount++;
        }
    }

    if (checkedCount > 1) {
        checkbox.checked = false;
        alert("Solo se puede seleccionar un corte");
    }
}