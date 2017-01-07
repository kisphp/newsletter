<?php

use Kisphp\NewsletterBundle\Form\NewsletterForm;

class NewsletterCest
{
    protected $formName;

    public function _before(AcceptanceTester $I)
    {
        $form = new NewsletterForm();

        $this->formName = $form->getName();
    }

    public function _after(AcceptanceTester $I)
    {
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function getFormField($name)
    {
        return sprintf('%s_form[%s]', $this->formName, $name);
    }

    protected function authenticateUser(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('_username', 'admin@example.com');
        $I->fillField('_password', 'admin');
        $I->click('Log In');
    }

    public function checkNewsletterCreatePage(AcceptanceTester $I)
    {
        $this->authenticateUser($I);

        $I->amOnPage('/newsletters/create');
        $I->see('Create Newsletter');
    }

    public function checkNewsletterCreateNewsletter(AcceptanceTester $I)
    {
        $this->authenticateUser($I);

        $newsletterId = uniqid();

        $fieldSubject = $this->getFormField(NewsletterForm::FIELD_SUBJECT);
        $fieldContent = $this->getFormField(NewsletterForm::FIELD_CONTENT);

        $I->amOnPage('/newsletters/create');
        $I->fillField($fieldSubject, 'Newsletter ' . $newsletterId);
        $I->fillField($fieldContent, 'Content newsletter ' . $newsletterId);
        $I->click('Save');
        $I->wantTo('See newly created newsletter: ' . $newsletterId);
        $I->seeInField('form input[name="' . $fieldSubject . '"]', 'Newsletter ' . $newsletterId);
        $I->seeInField('form textarea[name="' . $fieldContent . '"]', 'Content newsletter ' . $newsletterId);
        $I->seeInTitle('Edit Newsletter');
    }
}
