///<reference types="cypress"/>

describe('prueba el formulario de contacto', () => {
    it('Prueba La pagina de contacto y el envio de emails', () => {
        cy.visit('/contactanos');
        cy.get('[data-cy="contacto"]').should('exist');
        cy.get('[data-cy="contacto"]').invoke('text').should('equal', 'Contactanos');
        cy.get('[data-cy="contacto"]').invoke('text').should('not.equal', 'Contacto');
    });

    it('Llena los campos del formulario', () => {
        cy.get('[data-cy="nombre"]').type('Juan')
        cy.get('[data-cy="mensaje"]').type('Deseo comprar una casa')
        cy.get('[data-cy="input-contacto-tipo"]').select('Compra');
        cy.get('[data-cy="precio"]').type('12000')
        cy.get('[data-cy="TipoContacto"]').eq(0).check();
        cy.wait(1000);
        cy.get('[data-cy="telefono"]').should('exist');
        cy.wait(1000);
        cy.get('[data-cy="TipoContacto"]').eq(1).check();
        cy.wait(1000);
        cy.get('[data-cy="email"]').should('exist');
        cy.get('[data-cy="email"]').type('juaneshs21014@gmail.com')
        cy.get('[data-cy="fecha"]').type('2020-10-02')
        cy.get('[data-cy="hora"]').type('16:00')
        cy.get('[data-cy="formulario-contacto-submit"]').submit();

    });
    it('Verificar alerta', () => {
        cy.get('[data-cy="alerta"]').should('exist');
        cy.get('[data-cy="alerta"]').invoke('text').should('equal', 'Correo Enviado Nos comunicaremos prontamente con usted');
    });
});