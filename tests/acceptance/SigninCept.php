<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('See the login page');
$I->amOnPage('/');
$I->see('Log In');
