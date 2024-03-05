class authObject {

username = "[name='email']";
password = "[name='password'";
signinPopUp= ".button-block";
signinBtnHome = ".auth-block [type='button']";
signinBtnPopUp=  "[type='submit']";
signinError = ".form-error";
closeBtn = ".close-modal";

signIn(username, password, authError){
      cy.get(this.signinBtnHome).click();
      cy.get(this.signinPopUp).should('be.visible');
      cy.get(this.username).type(username);
      cy.get(this.password).type(password);

      if (authError == 1) {
        cy.get(this.signinBtnPopUp).click();
        cy.get(this.signinError).should('contain', 'Invalid Credentials');
        cy.get(this.username).clear();
        cy.get(this.password).clear();
        cy.get(this.closeBtn).click();
      } else {
        cy.get(this.signinBtnPopUp).click();
      }
    }
  }
  module.exports = new authObject;