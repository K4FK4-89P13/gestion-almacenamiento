//import { domUpdates } from "./domUpdates";

export function apiRequest(url, method, data = null) {
    let options = {
        method: method,
        headers: { "Content-Type": "application/json" }
    };
    if( data ) {
        options.body = JSON.stringify(data);
    };

    return fetch(url, options).then(response => response.json())
}