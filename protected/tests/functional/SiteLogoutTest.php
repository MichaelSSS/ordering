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
        $this->open('');
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        $this->assertTextPresent('Create New User');
        $this->click('link=Logout');
        $this->waitForTextPresent('Are you sure');
        $this->clickAndWait('link=Yes');
        $this->assertText("css=button[type='submit']","sign in");
        $this->pause(5000);
    }

}
