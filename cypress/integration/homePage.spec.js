///<reference types="cypress"/>

describe('Carga la pagina principal', () => {
    it('prueba el header', () => {
        cy.visit('/')
        cy.get('[data-cy="heading-sitio"]').should('exist')
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equals', 'Venta de Casas Y departamentos  Exclusivos de lujo')

    });
    it('prueba los iconos', () => {
        cy.get('[data-cy="iconos-nosotros"]').should('exist')
        cy.get('[data-cy="iconos-nosotros"]').find('.item').should('have.length', 3)
        cy.get('[data-cy="iconos-nosotros"]').find('.item').should('not.have.length', 4)
    });

    it('Prueba la seccion de propiedades', () => {
        cy.get('[data-cy="propiedad"]').should('exist')
        cy.get('[data-cy="propiedad"]').should('not.have.length', 4)
        cy.get('[data-cy="enlace-propiedad"]').first().click();
        cy.get('[data-cy="titulo-propiedad"]').should('exist')
        cy.wait(1000);
        cy.go('back');
    });
    it('prueba el routing hacia todas las propiedades', () => {
        cy.get('[data-cy="enlace-propiedades"]').should('exist')
        cy.get('[data-cy="enlace-propiedades"]').invoke('attr', 'href').should('equal', '/propiedades')
    });
});