$(document).ready(function(){
    let dataPaciente = []
    let addModalPaciente = new bootstrap.Modal(document.getElementById('modalAddPaciente'), {
        keyboard: false
    });

    let modeHttp = false;
    let paciente_id = null;

    $("#openModalPaciente").click(function() {
        let formulario = document.getElementById("formPaciente");
        
        formulario.elements["userpaciente[username]"].value = "";
        formulario.elements["userpaciente[password]"].value = "";
        formulario.elements["userpaciente[name]"].value = "";
        formulario.elements["userpaciente[lastname]"].value = "";
        formulario.elements["userpaciente[cedula]"].value = "";
        formulario.elements["userpaciente[numhistoria]"].value = "";

        modeHttp = false;
        addModalPaciente.show();
    });

    //boton eliminar
    $("#bodyTable").on('click', '.eliminar', function() {
        let fila = $(this).closest('tr');
        let peopleId = fila.data('id');

        var formData = new FormData();
        formData.append('id', peopleId)

        axios.post('paciente/delete', formData)
        .then(function (response) {
            console.log(response)
            if(response.status == 200) {
                location.reload();
            }
        })
        .catch(function (error) {
            console.log(error);
        });

    })

    //boton de editar eventos
    $("#bodyTable").on('click', '.editar', function() {
        let fila = $(this).closest('tr');
        paciente_id = fila.data('id');
        let celdas = fila.find('td');

        let formulario = document.getElementById("formPaciente");
        
        let username = formulario.elements["userpaciente[username]"];
        let password = formulario.elements["userpaciente[password]"];
        let name = formulario.elements["userpaciente[name]"];
        let lastname = formulario.elements["userpaciente[lastname]"];
        let cedula = formulario.elements["userpaciente[cedula]"];
        let numhistoria = formulario.elements["userpaciente[numhistoria]"];

        name.value = celdas[1].textContent;
        lastname.value = celdas[2].textContent;

        username.value = "****";
        password.value = "****";
        cedula.value = celdas[3].textContent;
        numhistoria.value = celdas[5].textContent;
        modeHttp = true;
        addModalPaciente.show();
    })

    document.getElementById('formPaciente').addEventListener('submit', function(event) {
        event.preventDefault();

        //
        var formData = new FormData(this);

        if(!modeHttp) {
            axios.post('paciente/store', formData).then(function (response) {
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
            formData.append("id", paciente_id)
            axios.post('paciente/update', formData).then(function (response) {
                console.log(response)
                if(response.status == 200) {
                    location.reload();
                } else {
                    console.log(error);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    })

})