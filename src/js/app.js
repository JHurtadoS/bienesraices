let CurrentPositionWindows;

document.addEventListener('DOMContentLoaded', (event) => {
    evenlisterns();
    darkmodeSistema();
    alerta();
    TipoContacto();
});

function evenlisterns() {
    const mobile_menu = document.querySelector('.mobile-menu');
    mobile_menu.addEventListener('click', navegacionResponsive);
    const boton_darkmode = document.querySelector('.contenedor-darkmode');
    boton_darkmode.addEventListener('click', darkmode);

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    const header = document.querySelector('.contenido-header');
    header.classList.toggle('navegacion-responsive');
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

function TipoContacto() {
    let metodoContactos = document.querySelectorAll('input[name="contacto[TipoContacto]"]');
    //console.log(metodoContactos);

    metodoContactos.forEach(e => {
        e.addEventListener("click", mostrarMetodosContacto);
        console.log(e);
    });



}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('.contacto');
    if (e.target.value == 'telefono') {
        contactoDiv.innerHTML = `
        <div class="campo">
            <label for="telefono">Telefono:</label>
            <input type="tel" placeholder="Telefono" name="contacto[telefono]"required>
        </div>
        `;
    } else {
        contactoDiv.innerHTML = `
        <div class="campo">
            <label for="email">E-mail:</label>
            <input type="email" placeholder="E-mail" name="contacto[email]"required>
        </div>
        `;
    }
}