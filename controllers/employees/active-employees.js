let searchInput = document.getElementById('value');
let valueInput = searchInput.value;

function selectAllEmployees() {
    let xhttp2;
    if (valueInput.length == 0) {
        xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let allEmployees = JSON.parse(this.responseText);
                let template = '';
                allEmployees.forEach(employee => {
                    template += `
                        <tr>
                            <td scope="row"><a href="./employee-profile.php?id=${employee["id"]}">${employee['id']}</a></td>
                            <td>${employee['first_name']}</td>
                            <td>${employee['last_name']}</td>
                            <td>${employee['cc']}</td>
                            <td>${employee['position']}</td>
                            <td>${employee['working_area']}</td>
                            <td>${employee['contract_type']}</td>
                            <td>${employee['start_of_date']}</td>
                            <td>
                                <div>
                                    <a href="../../src/pdf-certificates/certificate.php?id=${employee["id"]}" type="" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-alt"></i></a>
                                    <a href="../employees/update-employee.php?id=${employee["id"]}" type="" class="btn btn-success btn-sm"><i class="fas fa-user-edit"></i></a>
                                    <a href="../employees/delete-employee.php?id=${employee["id"]}" type="" class="btn btn-danger btn-sm"><i class="fas fa-user-times"></i></a>
                                </div>
                            </td>
                        </tr>
                    `
                })
                document.getElementById("bodytable").innerHTML = template;
            }
        };
        xhttp2.open("GET", "../../server/employees/select_all_employees.php", true);
        xhttp2.send();
    }
}



function searchEmployees(valueInput) {
    if (valueInput) {
        let xhttp2;
        xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                let allEmployees = JSON.parse(this.responseText);
                console.log(typeof (allEmployees));

                let template = '';
                if (allEmployees.length == 0) {
                    template = 'empleado no encontrado';
                }

                allEmployees.forEach(employee => {
                    template += `
                        <tr>
                            <td scope="row"><a href="./employee-profile.php?id=${employee.id}">${employee.id}</a></td>
                            <td>${employee.firstname}</td>
                            <td>${employee.lastname}</td>
                            <td>${employee.cc}</td>
                            <td>${employee.position}</td>
                            <td>${employee.area}</td>
                            <td>${employee.contract}</td>
                            <td>${employee.startdate}</td>
                            <td>
                                <div>
                                    <a href="../../src/pdf-certificates/certificate.php?id=${employee.id}" type="" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-alt"></i></a>
                                    <a href="../employees/update-employee.php?id=${employee.id}" type="" class="btn btn-success btn-sm"><i class="fas fa-user-edit"></i></a>
                                    <a href="../employees/delete-employee.php?id=${employee.id}" type="" class="btn btn-danger btn-sm"><i class="fas fa-user-times"></i></a>
                                </div>
                            </td>   
                        </tr>
                    `
                })
                document.getElementById("bodytable").innerHTML = template;
            }

        };
        xhttp2.open("GET", "../../server/employees/search_employee.php?p=" + valueInput, true);
        xhttp2.send();

    } else {
        selectAllEmployees();
    }

}