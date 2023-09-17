$(document).ready(function(){
    let dataAppointment = []
    let addModalAppointment = new bootstrap.Modal(document.getElementById('modalAddAppointment'), {
        keyboard: false
    });

    let modeHttp = false;

    $("#openModalAppointment").click(function() {
        modeHttp = false;
        addModalAppointment.show();
    });

    //agregamos un controlador de eventos para el boton eliminar en la tabla
    $("#bodyTable").on('click', '.eliminar', function() {
        let fila = $(this).closest('tr');
        let peopleId = fila.data('id');

        var formData = new FormData();
        formData.append('id', peopleId)

        axios.post('appointment/delete', formData)
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

    document.getElementById('formAppointment').addEventListener('submit', function(event) {
        event.preventDefault();

        //
        var formData = new FormData(this);

        console.log("formData: ", formData)

        if(!modeHttp) {
            axios.post('appointment/store', formData).then(function (response) {
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
        }
    })
})