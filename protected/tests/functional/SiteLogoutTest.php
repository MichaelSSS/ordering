<?php

class SiteLogoutTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setBrowser("*firefox");
    }

    public function testLogout()
    {
        $this->open('?r=admin/index');
        $this->assertTextPresent('Create New User');
        $this->click('link=Logout');
        $this->waitForTextPresent('Are you sure');
        $this->clickAndWait('link=Yes');
        $this->assertText("css=button[type='submit']","Login");

    }

}
