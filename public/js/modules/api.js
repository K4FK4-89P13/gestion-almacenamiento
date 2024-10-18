export function apiRequest(url, method, data = null) {
    let options = {
        method: method,
        headers: { "Content-Type": "application/json" }
    };
    if( data ) {
        options.body = JSON.stringify(data);
    }

    return fetch(url, options)
        .then(response => response.json())
        .catch(error => console.error("Error en la API: ", error));
}