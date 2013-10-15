<?php

class AdminDuplicateTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setBrowser("*firefox");
    }

    public $fixtures=array(
        'user'=>':user',
        'user_attempt' => ':user_attempt',
        'user_login' => ':user_login',
        'authAssignment' => ':auth_assignment',
    );

    public function testDuplicateUser()
    {
        $this->open('');
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        //$this->setSpeed(500);
        $this->click("//table[@id='table-user']/tbody/tr/td[9]/a");
        $this->waitForNotVisible("css=div.edit-shade");
        $this->assertAttribute("id=User_firstname@value","Izambard");
        $this->assertAttribute("id=User_lastname@value","Brunnel");
        $this->assertAttribute("id=User_email@value","a@a.com");
        $this->assertAttribute(
            "css=#User_region > option[value='north']@selected",
            "selected"
        );
        $this->assertAttribute("id=User_role_0@checked","checked");
        $this->type("id=User_username","smith");
        $this->type("id=User_firstname","Adam");
        $this->type("id=User_lastname","Smith");
        $this->type("id=User_password","aA1!");
        $this->type("id=User_confirmPassword","aA1!");
        $this->type("id=User_email","adsm@adsm.com");
        $this->select("id=User_region","label=West");
        $this->click("id=User_role_1");
        $this->click("id=edit-save");
        $this->waitForElementNotPresent("css=#oms-grid-view0.grid-view-loading");

        $this->assertTable("id=table-user.2.0","smith"); 
        $this->assertTable("id=table-user.2.1","Adam"); 
        $this->assertTable("id=table-user.2.2","Smith"); 
        $this->assertTable("id=table-user.2.3","merchandiser"); 
        $this->assertTable("id=table-user.2.4","adsm@adsm.com"); 
        $this->assertTable("id=table-user.2.5","west"); 
        
    }
}
