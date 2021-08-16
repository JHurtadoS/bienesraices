///<reference types="cypress"/>

describe('Probar la autenticacion', () => {
    it('Prube la autenticacion en /login', () => {
        cy.visit('/login');
        cy.get('[data-cy="header-login"]').should('exist');
        cy.get('[data-cy="formulario-login"]').should('exist');
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta"]').should('exist');
        cy.get('[data-cy="alerta"]').should('have.class', 'alerta').and('not.have.class', 'sucess');

    });
});