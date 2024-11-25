document.addEventListener("DOMContentLoaded", function () {
    cargarExperiencia();
    cargarEstudios();
    cargarMenus();
    cargarRedesSociales();
});

function cargarExperiencia() {
    fetch('/Pagina/controller/experiencia.php?op=listar')
        .then((response) => response.json())
        .then((experiencias) => {
            const contenedor = document.querySelector("#experiencia .timeline-container");
            contenedor.innerHTML = experiencias.map(exp => `
                <div class="timeline-item">
                    <div class="timeline-date">${formatearFechas(exp.fecha_inicio, exp.fecha_fin)}</div>
                    <div class="timeline-content">
                        <h3>${exp.puesto}</h3>
                        <h4>${exp.empresa}</h4>
                        <p>${exp.descripcion ? exp.descripcion : 'Sin descripción disponible.'}</p>
                    </div>
                </div>
            `).join('');
        })
        .catch((error) => console.error("Error cargando la experiencia:", error));
}

function cargarEstudios() {
    fetch('/Pagina/controller/estudios.php?op=listar')
        .then((response) => response.json())
        .then((estudios) => {
            const contenedor = document.querySelector("#estudios .timeline-container");
            contenedor.innerHTML = estudios.map(estudio => `
                <div class="timeline-item">
                    <div class="timeline-date">${formatearFechas(estudio.fecha_inicio, estudio.fecha_fin)}</div>
                    <div class="timeline-content">
                        <h3>${estudio.titulo}</h3>
                        <h4>${estudio.institucion}</h4>
                        <p>${estudio.descripcion ? estudio.descripcion : 'Sin descripción disponible.'}</p>
                    </div>
                </div>
            `).join('');
        })
        .catch((error) => console.error("Error cargando los estudios:", error));
}

/**
 * Función auxiliar para formatear fechas.
 * @param {string} fechaInicio - Fecha de inicio en formato YYYY-MM-DD.
 * @param {string|null} fechaFin - Fecha de fin en formato YYYY-MM-DD o null.
 * @returns {string} - Cadena formateada con rango de fechas.
 */
function formatearFechas(fechaInicio, fechaFin) {
    const inicio = new Date(fechaInicio).toLocaleDateString('es-ES', { year: 'numeric', month: 'long' });
    const fin = fechaFin ? new Date(fechaFin).toLocaleDateString('es-ES', { year: 'numeric', month: 'long' }) : "Actualidad";
    return `${inicio} - ${fin}`;
}


function cargarMenus() {
    fetch('/Pagina/controller/menu.php?op=listar')
        .then((response) => response.json())
        .then((menus) => {
            const navbar = document.querySelector(".navbar");
            navbar.innerHTML = menus.map(menu => `<a href="${menu.url}">${menu.opcion}</a>`).join('');
        })
        .catch((error) => console.error("Error cargando los menús:", error));
}

function cargarRedesSociales() {
    fetch('/Pagina/controller/social_media.php?op=listar')
        .then((response) => response.json())
        .then((redes) => {
            const icons = document.querySelector(".icons");
            icons.innerHTML = redes.map(red => 
                `<a href="${red.socmed_url}" target="_blank" class="bx ${red.socmed_icono}"></a>`
            ).join('');
        })
        .catch((error) => console.error("Error cargando redes sociales:", error));
}
