<?php

class SiteLoginTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setBrowser("*firefox");
    }

    public function testLogin()
    {
        $this->open('');
        Yii::app()->db->createCommand('TRUNCATE user_login')->execute(); 
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "admin01");
        $this->check("id=LoginForm_rememberMe");
        $this->clickAndWait("name=yt0");
        $this->assertTextPresent('Create New User');
        $this->pause(5000);
    }

    public function testAccessControl()
    {
        $this->open('?r=customer/index');
        $this->assertTextPresent('not authorized');
        $this->pause(5000);
    }

    public function testRemember()
    {
        $this->open('');
        $this->assertValue('id=LoginForm_username','admin01');       
        $this->pause(5000);
    }
}
