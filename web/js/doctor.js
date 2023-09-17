$(document).ready(function(){
    let dataDoctors = []
    let addModalDoctor = new bootstrap.Modal(document.getElementById('modalAddDoctor'), {
        keyboard: false
    });

    let modeHttp = false;
    let doctor_id = null;

    getDataInit();

    //agregamos un controlador de eventos para el boton eliminar en la tabla
    $("#bodyTable").on('click', '.eliminar', function() {
        let fila = $(this).closest('tr');
        let peopleId = fila.data('id');

        var formData = new FormData();
        formData.append('id', peopleId)

        axios.post('doctor/delete', formData)
        .then(function (response) {
            console.log(response)
            if(response.status == 200) {
                location.reload();
            }
        })
        .catch(function (error) {
            console.log(error);
        });
        
    });

    //Agregamos un controlador de eventos para el boton editar en la tabla
    $("#bodyTable").on('click', '.editar', function() {
        let fila = $(this).closest('tr');
        doctor_id = fila.data('id');
        let celdas = fila.find('td');

        console.log("celdas: ", celdas)

        //seteamos la informacion en el modal
        /* $("#f_firstName").val(celdas[0].textContent);
        $("#f_lastName").val(celdas[1].textContent);
        $("#f_emal").val(celdas[2].textContent); */
        let formulario = document.getElementById("formDoctor");

        let username = formulario.elements["userdoctor[username]"];
        let password = formulario.elements["userdoctor[password]"];
        let name = formulario.elements["userdoctor[name]"];
        let lastname = formulario.elements["userdoctor[lastname]"];
        let cedula = formulario.elements["userdoctor[cedula]"];
        let tarjeta = formulario.elements["userdoctor[tarjeta]"];
        let especialidad = formulario.elements["userdoctor[especialidad]"];

        name.value = celdas[1].textContent;
        lastname.value = celdas[2].textContent;

        username.value = "****";
        password.value = "****";
        cedula.value = celdas[3].textContent;
        
        
        tarjeta.value = celdas[5].textContent;
        especialidad.value = celdas[6].textContent;


        modeHttp = true;
        addModalDoctor.show();

    })

    document.getElementById('formDoctor').addEventListener('submit', function(event) {
        event.preventDefault();

        //
        var formData = new FormData(this);

        if(!modeHttp) {
            axios.post('doctor/store', formData).then(function (response) {
                    console.log(response)
                    if(response.status == 200) {
                        location.reload();
                    } else {
                        console.log("error")
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        } else {
            console.log("doctor_id: ", doctor_id)
            formData.append("id", doctor_id)
            axios.post('doctor/update', formData).then(function (response) {
                console.log(response)
                if(response.status == 200) {
                    location.reload();
                } else {

                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }

    });

    $("#openModalDoctor").click(function() {
        let formulario = document.getElementById("formDoctor");

        formulario.elements["userdoctor[username]"].value = "";
        formulario.elements["userdoctor[password]"].value = "";
        formulario.elements["userdoctor[name]"].value = "";
        formulario.elements["userdoctor[lastname]"].value = "";
        formulario.elements["userdoctor[cedula]"].value = "";
        formulario.elements["userdoctor[tarjeta]"].value = "";
        formulario.elements["userdoctor[especialidad]"].value = "";
        modeHttp = false;
        addModalDoctor.show();
    });

    const saveDataForm = () => {
        let username = $("#f_username").val();
        let password = $("#f_password").val();
        let nombre = $("#f_name").val();
        let apellido = $("#f_lastName").val();
        let cedula = $("#f_cedula").val();
        let role = "medico";
        let tarjeta = $("#f_tarjeta").val();
        let especialidad = $("#f_especialidad").val();


        if(!modeHttp) {
            axios.post('doctor/store', {
                username: username,
                password: password,
                nombre: nombre,
                apellido: apellido,
                cedula: cedula,
                role: role,
                tarjeta: tarjeta,
                especialidad
            }).then(function (response) {
                console.log(response)
                if(response.status == 200) {

                    /* dataPeople.push(response.data);
                    let nuevaFila = `<tr data-id=${response.data.id}>
                            <th scope="row">${dataPeople.length}</th>
                            <td>${response.data.firstname}</td>
                            <td>${response.data.lastname}</td>
                            <td>${response.data.email}</td>
                            <td>
                                <button type="button" class="btn btn-secondary editar">Editar</button>
                                <button type="button" class="btn btn-secondary eliminar" >Eliminar</button>
                            </td>
                        </tr>`;
                    $("#bodyTable").append(nuevaFila); */
                    //generateTable();
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        } else {

        }

    }

    $("#saveForm").click(saveDataForm);

    function getDataInit() {

        $('#bodyTable tr').each(function() {
            let row = $(this); //
            
            dataDoctors.push({
                id: row.find('td:eq(0)').text(),
                nombre: row.find('td:eq(1)').text(),
                apellido: row.find('td:eq(2)').text(),
                cedula: row.find('td:eq(3)').text(),
                role: row.find('td:eq(4)').text(),
                tarjeta: row.find('td:eq(5)').text(),
                especialidad: row.find('td:eq(5)').text()
            });
        });
    }
})