$(document).ready(function () {
    $('#tablaRedesSociales').DataTable({
        "ajax": {
            "url": "/Pagina/controller/social_media.php?op=listar", // Ruta al controlador PHP
            "type": "GET",
            "dataSrc": ""
        },
        "dom": 'Bfrtip',
        "language": {
            "decimal": "",
            "emptyTable": "No hay datos disponibles en la tabla",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar la columna de manera ascendente",
                "sortDescending": ": activar para ordenar la columna de manera descendente"
            }
        },
        "columns": [
            {
                "data": "socmed_id", 
                "title": "ID"
            },
            {
                "data": "socmed_icono",
                "title": "Ícono",
            },
            {
                "data": "socmed_url",
                "title": "URL"
            },
            {
                "data": "est", 
                "title": "Estado",
                "render": function (data) {
                    if (data === 1) {
                        return '<span class="badge badge-success">Activo</span>';
                    } else if (data === 0) {
                        return '<span class="badge badge-danger">Inactivo</span>';
                    }
                    return '';
                }
            },
            {
                "data": "socmed_id",  
                "title": "Acciones",
                "render": function(data, type, row) {
                    return `
                        <button class="btn btn-primary btn-sm" onclick="cargarDatosModal(${data})">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarSocialMedia(${data})">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    `;
                }
            }
        ]
    });
});


function eliminarSocialMedia(socmed_id) {
    // Mostrar confirmación con SweetAlert2
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡Este registro se eliminará permanentemente!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/Pagina/controller/social_media.php?op=eliminar', 
                { id: socmed_id }, 
                function(response) {
                    if (response === 'success') {
                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado correctamente.',
                            'success'
                        );

                        $('#tablaRedesSociales').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            'Hubo un problema al eliminar el registro.',
                            'error'
                        );
                    }
                }
            );
        } 
    });
}


// Función para cargar los datos del registro en el formulario del modal (para editar)
function cargarDatosModal(socmed_id) {

    
    $.post('/Pagina/controller/social_media.php?op=mostrar', 
        { socmed_id: socmed_id }, 
        function(response) {

            var data = JSON.parse(response);

            if (data) {

                $('#socmed_icono').val(data.socmed_icono);
                $('#socmed_url').val(data.socmed_url);
                $('#est').val(data.est);
                $('#socmed_id').val(socmed_id)

                $('#modalAddLabel').text('Actualizar Red Social');
                $('#modalAdd button[type="submit"]').text('Actualizar');

                $('#modalAdd').val('socmed_id', socmed_id);

                $('#modalAdd').modal('show');
            } else {
                Swal.fire('Error', 'No se encontraron datos para el registro.', 'error');
            }
        }
    ).fail(function() {
        Swal.fire('Error', 'Hubo un problema al obtener los datos.', 'error');
    });
}


function guardarSocialMedia() {
    // Obtener los valores del formulario
    const socmed_id = $('#socmed_id').val(); // Campo oculto para el ID
    const socmed_icono = $('#socmed_icono').val();
    const socmed_url = $('#socmed_url').val();
    const est = $('#est').val();

    // Validar que los campos no estén vacíos
    if (!socmed_icono || !socmed_url) {
        Swal.fire(
            'Error',
            'Todos los campos son obligatorios.',
            'error'
        );
        return;
    }

    // Determinar si es "crear" o "actualizar" según el valor de socmed_id
    const operacion = socmed_id ? 'actualizar' : 'crear';

    // Realizar la petición AJAX
    $.post(`/Pagina/controller/social_media.php?op=${operacion}`, 
        { 
            socmed_id: socmed_id, 
            socmed_icono: socmed_icono, 
            socmed_url: socmed_url, 
            est: est 
        },
        function(response) {
            // Evaluar la respuesta
            if (response === 'success') {
                const mensaje = operacion === 'crear' ? 'creado' : 'actualizado';

                Swal.fire(
                    'Éxito',
                    `El registro ha sido ${mensaje} correctamente.`,
                    'success'
                );

                // Ocultar el modal
                $('#modalAdd').modal('hide');

                
                $('#tablaRedesSociales').DataTable().ajax.reload();
            } else {
                Swal.fire(
                    'Error',
                    'Hubo un problema al guardar los datos.',
                    'error'
                );
            }
        }
    );
}


// Función para mostrar el modal para agregar (crear)
function mostrarModalCrear() {
    $('#socmed_id').val('');
    $('#socmed_icono').val('');
    $('#socmed_url').val('');
    $('#est').val(1);
    $('#modalAddLabel').text('Agregar Red Social');
    $('#modalAdd button[type="submit"]').text('Guardar');
    $('#modalAdd').removeData('socmed_id');
    $('#modalAdd').modal('show');
}





