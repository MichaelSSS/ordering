<?php

class SiteReloginTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setBrowser("*iexplore");
    }


    public function testRelogin()
    {
        $this->open('');
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "admin01");
        $this->clickAndWait("name=yt0");
        $this->assertTextPresent('Create New User');
        $this->pause(5000);
    }
}
