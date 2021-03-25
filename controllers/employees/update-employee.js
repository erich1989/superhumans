let form = document.getElementById('form-update-employee');

// let valuePosition = position.options[position.selectedIndex].value;
form.addEventListener('submit', function (e) {

    let id = document.getElementById('id').value;
    let firstname = document.getElementById('firstname').value;
    let lastname = document.getElementById('lastname').value;
    let cc = document.getElementById('cc').value;
    let birthday = document.getElementById('birthday').value;
    let position = document.getElementById('position').value;
    let area = document.getElementById('selectarea').value;
    let contract = document.getElementById('selectcontract').value;
    let phone = document.getElementById('phonenumber').value;
    let address = document.getElementById('address').value;
    let email = document.getElementById('email').value;
    let salary = document.getElementById('salary').value;
    let arl = document.getElementById('arl').value;
    let ccf = document.getElementById('ccf').value;
    let eps = document.getElementById('eps').value;
    let startDate = document.getElementById('startdate').value;

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            window.location.assign("http://localhost/superhumans_mvc/views/employees/successful-update.php");
        }
    }

    xmlhttp.open("POST", '../../server/employees/update_employee.php', true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(`id=${id}&firstname=${firstname}&lastname=${lastname}&cc=${cc}&birthday=${birthday}&position=${position}&area=${area}&contract=${contract}&phone=${phone}&address=${address}&email=${email}&salary=${salary}&arl=${arl}&ccf=${ccf}&eps=${eps}&startdate=${startDate}`);

    e.preventDefault();
})