class helpers {

homepageDemo() {
    cy.setCookie("cookiesAccepted", "true");
    cy.visit('/', {
      auth: {
        username: 'banger',
        password: 'banger2020'
      }
    });
}

}
module.exports = new helpers;