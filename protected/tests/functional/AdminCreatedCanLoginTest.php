<?php

class AdminCreatedCanLoginTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setBrowserUrl('http://mine/ordering-master/');
        $this->setBrowser("*firefox");
    }


    public function testCreatedUserCanLogin()
    {
        $this->open('index-test.php');
        $this->type("id=LoginForm_username", "smith");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        //$this->setSpeed(500);
        $this->assertTextPresent("Logged user: smith");
    }
}
