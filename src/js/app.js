let CurrentPositionWindows;

document.addEventListener('DOMContentLoaded', (event) => {
    evenlisterns();
    darkmodeSistema();
    alerta();
});

function evenlisterns() {
    const mobile_menu = document.querySelector('.mobile-menu');
    mobile_menu.addEventListener('click', navegacionResponsive);
    const boton_darkmode = document.querySelector('.contenedor-darkmode');
    boton_darkmode.addEventListener('click', darkmode);

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('navegacion-responsive');

}

function darkmodeSistema() {
    const ThemePrefer = window.matchMedia('(prefers-color-scheme: dark)');
    if (ThemePrefer.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    ThemePrefer.addEventListener('change', e => {
        if (ThemePrefer.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });
}

function darkmode() {
    document.body.classList.toggle('dark-mode');
}

function alerta() {
    const alerta = document.querySelector('.alerta');
    if (alerta != null) {
        return new Promise(resolve => {
            setTimeout(() => {
                console.log('clase agregada')
                alerta.classList.add('desaperecer');
            }, 5000);

            setTimeout(() => {
                alerta.remove();
                resolve("eliminado");
            }, 7000);

        });
    }

}