let formNewEmployee = document.getElementById('form-create-employee');


// function validateValue(value, idSpan, idInput) {
//     if (value === '') {
//         error = " Requerido";
//         document.getElementById(`${idSpan}`).innerHTML = error;
//         document.getElementById(`${idInput}`).style.borderColor = 'red';
//     } else {
//         error = "";
//         document.getElementById(`${idSpan}`).innerHTML = error;
//         document.getElementById(`${idInput}`).style.borderColor = 'green';
//     }
// }

// function validateFilePdf() {
//     let value = document.getElementById('pdf');
//     if (value.value) {
//         let file = value.files[0];
//         let fileType = file.type;
//         let fileSize = file.size;

//         if (fileType != "application/pdf") {
//             document.getElementById('errorpdf').innerHTML = " Solo se admiten archivos pdf";
//             console.log(fileType);
//         } else {
//             if (fileSize >= 1000000) {
//                 document.getElementById('errorpdf').innerHTML = " El archivo debe pesar menos de una mega";
//             } else {
//                 document.getElementById('errorpdf').innerHTML = "";
//             }
//         }

//     }

// }

// function validateFileImage() {
//     let value = document.getElementById('photo');
//     if (value.value) {
//         let file = value.files[0];
//         let fileType = file.type;
//         let fileSize = file.size;

//         if (fileType === "image/jpeg") {
//             document.getElementById('errorphoto').innerHTML = "";
//             console.log(fileSize);
//             if (fileSize >= 100000) {
//                 document.getElementById('errorphoto').innerHTML = " El archivo debe pesar menos de una megas";
//             } else {
//                 document.getElementById('errorphoto').innerHTML = "";
//             }
//         } else {

//             document.getElementById('errorphoto').innerHTML = " Solo se admiten imagenes jpeg, jpg o png";

//         }

//     }

// }

function submitForm () {
    let firstName = document.getElementById('firstname').value;
    let lastName = document.getElementById('lastname').value;
    let cc = document.getElementById('cc').value;
    let birthday = document.getElementById('birthday').value;
    let position = document.getElementById('position').value;
    let area = document.getElementById('area').value;
    let contract = document.getElementById('contracttype').value;
    let phone = document.getElementById('phonenumber').value;
    let address = document.getElementById('address').value;
    let email = document.getElementById('email').value;
    let salary = document.getElementById('salary').value;
    let arl = document.getElementById('arl').value;
    let ccf = document.getElementById('ccf').value;
    let eps = document.getElementById('eps').value;
    let startDate = document.getElementById('startdate').value;
    let photo = document.getElementById('photo').value;
    let namePhoto = photo.replace(/^.*[\\\/]/, '');
    let pdf = document.getElementById('pdf').value;
    var namePdf = pdf.replace(/^.*[\\\/]/, '');


    // validateValue(firstName, 'errorfirstname', 'firstname');
    // validateValue(lastName, 'errorlastname', 'lastname');
    // validateValue(cc, 'errorcc', 'cc');
    // validateValue(birthday, 'errorbirthday', 'birthday');
    // validateValue(position, 'errorposition', 'position');
    // validateValue(area, 'errorarea', 'area');
    // validateValue(contract, 'errorcontract', 'contract');
    // validateValue(phone, 'errorphone', 'phone');
    // validateValue(address, 'erroraddress', 'address');
    // validateValue(email, 'erroremail', 'email');
    // validateValue(salary, 'errorsalary', 'salary');
    // validateValue(arl, 'errorarl', 'arl');
    // validateValue(ccf, 'errorccf', 'ccf');
    // validateValue(eps, 'erroreps', 'eps');
    // validateValue(startDate, 'errorstartdate', 'startdate');
    // validateValue(namePhoto, 'errorphoto', 'photo');
    // validateValue(namePdf, 'errorpdf', 'pdf');

    // validateFilePdf();
    // validateFileImage();

        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                window.location.assign("http://localhost/superhumans_mvc/views/employees/successful-create.php"); 
            }
        }

        xmlhttp.open("POST", '../../server/employees/create_new_employee.php', true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(`firstname=${firstName}&lastname=${lastName}&cc=${cc}&birthday=${birthday}&position=${position}&area=${area}&contract=${contract}&phone=${phone}&address=${address}&email=${email}&salary=${salary}&arl=${arl}&ccf=${ccf}&eps=${eps}&startdate=${startDate}&namephoto=${namePhoto}&namepdf=${namePdf}`);
    

    e.preventDefault();
};





