<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Successfully authenticate');
$I->amOnPage('/');
$I->fillField('_username', 'admin@example.com');
$I->fillField('_password', 'admin');
$I->click('Log In');
$I->see('My Account');
