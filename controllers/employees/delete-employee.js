let formDeleteEmployee = document.getElementById('form-delete-employee');

formDeleteEmployee.addEventListener('submit', function (e) {
    let valueEndDate = document.getElementById('enddate').value;
    let valueReasonDismissal = document.getElementById('reasondismissal').value;
    let id = document.getElementById('id').value;
    let xmlhttp;
    let error = "";

    if (valueEndDate === "") {
        error = " Requerido";
        document.getElementById('errorEndDate').innerHTML = error;
    }else{
        error = "";
        document.getElementById('errorEndDate').innerHTML = error;
    }

    if (valueReasonDismissal === "") {
        error = " Requerido";
        document.getElementById('errorReasonDismissal').innerHTML = error;
    } else {
        error = "";
        document.getElementById('errorReasonDismissal').innerHTML = error;
    }

    if (valueEndDate && valueReasonDismissal) {

        confirm('Estás seguro de eliminar al empleado');
        xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                window.location.assign("http://localhost/superhumans_mvc/views/employees/successful-delete.php");
            }
        }
        xmlhttp.open("POST", '../../server/employees/delete_employee.php', true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(`id=${id}&enddate=${valueEndDate}&reasondismissal=${valueReasonDismissal}`);
    }

    e.preventDefault();
});