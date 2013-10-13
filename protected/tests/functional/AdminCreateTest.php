<?php

class AdminCreateTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setBrowserUrl('http://mine/ordering-master/');
        $this->setBrowser("*firefox");
    }

    public $fixtures=array(
        'user'=>':user',
    );

    public function testCreateUser()
    {
        $this->open('index-test.php');
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "admin01");
        $this->clickAndWait("name=yt0");
        //$this->setSpeed(500);
        $this->assertElementPresent("id=create-user");
        $this->click("id=create-user");
        $this->waitForNotVisible("css=div.edit-shade");
        $this->type("id=User_username","smith");
        $this->type("id=User_firstname","Adam");
        $this->type("id=User_lastname","Smith");
        $this->type("id=User_password","aA1!");
        $this->type("id=User_confirmPassword","aA1!");
        $this->type("id=User_email","adsm@adsm.com");
        $this->select("id=User_region","label=West");
        $this->click("id=User_role_1");
        $this->click("id=edit-save");
        $this->waitForElementNotPresent("css=#oms-grid-view0 .grid-view-loading");
    }
}
