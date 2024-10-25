import { apiRequest } from "./api.js";
import { domUpdates } from "./domUpdates.js";

export function domLogin() {
    const formLogin = (document.querySelector('.login') != null) ? document.querySelector('.login') : null;
    if(formLogin) formLogin.addEventListener('submit', (e) => {
        e.preventDefault();
        const data = Object.fromEntries( new FormData(e.target) );
        console.log(data);

        apiRequest('http://product.test/Auth/login', 'POST', data)
            .then( res => {
                console.log(res);
                //Si la auntenticacion fue exitosa
                if(res.success) {
                    window.location.href = 'http://product.test';
                }else{
                    domUpdates('mensaje-login', re.message || 'Error en la autenticacion', 'danger');
                }
            })
            .catch( err => {
                console.error(err);
                domUpdates('mensaje-login', err.message, 'danger')
            })
    });
}