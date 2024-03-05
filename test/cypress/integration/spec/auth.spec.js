/// <reference types="cypress" />
import auth from "../../pageObjects/auth.po.js"
import helper from "../../support/helpers.js"
import userAccounts from "../../fixtures/user.json"

context('Authentification', function () {
    before(function () {
      helper.homepageDemo()
    });
    describe("Sign in -  With InCorrect Credentrials", function () {
      userAccounts.forEach(function (item) {
        it("Sign for ".concat(item.username), function () {
          auth.signIn(item.username, item.password, item.error);
        });
      });
    });
    describe("Sign in - Correct Credentrials", function () {
      it('Sign in - Correct Credentials', function () {
        auth.signIn("qa@bangergames.com", "banger2020");
      });
    });
  });