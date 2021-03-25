function selectRetiredEmployees() {
    let xmlhttp;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let selectAllRetiredEmployees = JSON.parse(this.responseText);
            let template = '';
            selectAllRetiredEmployees.forEach(employee => {
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
                            <td>${employee['end_date']}</td>
                            <td>${employee['reason_dismissal']}</td>
                            <td>
                                <div>
                                    <a href="../../src/job-certificate/certificate-retired.php?id=${employee["id"]}" type="" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-alt"></i></a>
                                    <a href="update.php?id=${employee["id"]}" type="" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i></a>
                                </div>
                            </td>
                        </tr>
                    `

            });
            document.getElementById("bodytable").innerHTML = template;
        }

    }
    xmlhttp.open("GET", "../../server/employees/select_all_disables_employees.php", true);
    xmlhttp.send();

}

function searchRetiredEmployees(value) {
    if (value) {
        let xmlhttp;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let allRetiredEmployees = JSON.parse(this.responseText);
                let template = '';

                if (allRetiredEmployees.length == 0) {
                    template = 'empleado no encontrado';
                }

                allRetiredEmployees.forEach(employee => {
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
                            <td>${employee.enddate}</td>
                            <td>${employee.reasondismissal}</td>
                            <td>
                                <div>
                                    <a href="../../src/job-certificate/certificate-retired.php?id=${employee.id}" type="" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-alt"></i></a>
                                    <a href="update.php?id=${employee["id"]}" type="" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i></a>
                                </div>
                            </td>
                        </tr>
                    `
                })
                document.getElementById("bodytable").innerHTML = template;
            }
        }
        xmlhttp.open("GET", "../../server/employees/search_disables_employees.php?p=" + value, true);
        xmlhttp.send();
    } else {
        selectRetiredEmployees();
    }
}
