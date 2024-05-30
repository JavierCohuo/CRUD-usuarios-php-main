// search_students.js
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.querySelector('input[name="search_student"]'); // Campo de búsqueda
    var tbody = document.querySelector('.users-table tbody'); // Cuerpo de la tabla para actualizar

    // Evento input para la búsqueda
    searchInput.addEventListener('input', function() {
        var searchValue = this.value.trim(); // Valor de búsqueda sin espacios al inicio y al final

        // Solicitud AJAX al servidor
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'search_students.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Actualizar el contenido de la tabla con los resultados
                tbody.innerHTML = xhr.responseText;
            }
        };
        xhr.send('search=' + searchValue); // Enviar el valor de búsqueda al servidor
    });
});