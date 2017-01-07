<?php


class SigninCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    protected function authenticateUser(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('_username', 'admin@example.com');
        $I->fillField('_password', 'admin');
        $I->click('Log In');
    }

    // tests
    public function checkLogin(AcceptanceTester $I)
    {
        $this->authenticateUser($I);

        $I->see('My Account');
    }

    public function checkNewsletterPage(AcceptanceTester $I)
    {
        $this->authenticateUser($I);

        $I->amOnPage('/newsletters');
        $I->see('Newsletters List');
    }
}
