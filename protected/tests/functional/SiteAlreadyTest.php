<?php

class SiteAlreadyTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setBrowser("*iexplore");
    }


    public function testAlready()
    {
        $this->open('');
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        $this->assertTextPresent('user is already logged');
        $this->pause(5000);
    }
}
