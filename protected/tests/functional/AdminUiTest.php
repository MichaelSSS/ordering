<?php

class AdminUiTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setBrowserUrl('http://mine/ordering-master/');
        $this->setBrowser("*firefox");
    }

    public $fixtures=array(
        'userTable'=>':userTable',
    );

    public function testUi()
    {
        $this->open('index-test.php');
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        //$this->setSpeed(500);
        $this->assertTextPresent("user: admin01");
        
        $this->assertElementPresent("
            //table[@id='table-user']
                /tbody
                /tr[1]
                /td[8]
                /a[@data-original-title='active user'] 
            | //table[@id='table-user']
                /tbody
                /tr[1]
                /td[8]
                /a[@title='active user']
        ");

        // test searching
        
        $this->select("id=AdminSearchForm_keyField","label=Role");
        $this->type("id=AdminSearchForm_keyValue","customer");
        $this->keyUp("id=AdminSearchForm_keyValue","r");
        //$this->pause(1000);
        $this->click("id=btn-search");
        $this->waitForElementNotPresent("css=.grid-view-loading");

        $this->assertText("id=search-result-count","44");
        $this->assertText("css=div.summary","page #1 of 5");

        // test sorting
        
        $this->controlKeyDown();
        $this->click("link=Region");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->click("link=First Name");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->click("link=Last Name");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->controlKeyUp();
        //$this->pause(5000);

        $this->assertTable("id=table-user.1.0","customer08");
        $this->assertTable("id=table-user.10.0","customer24");

        //test pagination
     
        $this->assertElementPresent("css=li.first.hidden");
        $this->assertElementPresent("css=li.backward.hidden");
        $this->assertElementPresent("css=li.forward");
        $this->assertElementPresent("css=li.last");
        $this->assertElementNotPresent("css=li.forward.hidden");
        $this->assertElementNotPresent("css=li.last.hidden");

        $this->click("css=li.forward");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->assertElementPresent("css=li.first");
        $this->assertElementPresent("css=li.backward");
        $this->assertElementPresent("css=li.forward");
        $this->assertElementPresent("css=li.last");
        $this->assertElementNotPresent("css=li.first.hidden");
        $this->assertElementNotPresent("css=li.backward.hidden");
        $this->assertElementNotPresent("css=li.forward.hidden");
        $this->assertElementNotPresent("css=li.last.hidden");
        $this->assertText("css=div.summary","page #2 of 5");
        $this->assertTable("id=table-user.1.0","customer41");
        $this->assertTable("id=table-user.10.0","customer17");

        $this->click("css=li.last");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->assertElementPresent("css=li.first");
        $this->assertElementPresent("css=li.backward");
        $this->assertElementPresent("css=li.forward.hidden");
        $this->assertElementPresent("css=li.last.hidden");
        $this->assertElementNotPresent("css=li.first.hidden");
        $this->assertElementNotPresent("css=li.backward.hidden");
        $this->assertText("css=div.summary","page #5 of 5");
        $this->assertTable("id=table-user.1.0","customer22");
        $this->assertTable("id=table-user.4.0","customer46");

        $this->click("css=li.backward");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->assertElementPresent("css=li.first");
        $this->assertElementPresent("css=li.backward");
        $this->assertElementPresent("css=li.forward");
        $this->assertElementPresent("css=li.last");
        $this->assertElementNotPresent("css=li.first.hidden");
        $this->assertElementNotPresent("css=li.backward.hidden");
        $this->assertElementNotPresent("css=li.forward.hidden");
        $this->assertElementNotPresent("css=li.last.hidden");
        $this->assertText("css=div.summary","page #4 of 5");
        $this->assertTable("id=table-user.1.0","customer01");
        $this->assertTable("id=table-user.10.0","customer18");

        $this->click("css=li.first");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->assertText("css=div.summary","page #1 of 5");

        // test page size

        $this->click("id=page-size");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->assertText("id=page-size","show 10 items");
        $this->assertText("css=div.summary","page #1 of 2");
        $this->assertTable("id=table-user.1.0","customer08");
        $this->assertTable("id=table-user.25.0","customer31");

        // test show deleted

        $this->click("id=check_toggle");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->assertTable("id=table-user.6.0","customer43");
        $this->assertTable("id=table-user.16.0","customer38");
        $this->assertTable("id=table-user.25.0","customer16");

        $this->click("id=check_toggle");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->assertTable("id=table-user.1.0","customer08");
        $this->assertTable("id=table-user.25.0","customer31");

        $this->click("id=page-size");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->assertText("id=page-size","show 25 items");
        $this->assertText("css=div.summary","page #1 of 5");
        $this->assertTable("id=table-user.1.0","customer08");
        $this->assertTable("id=table-user.10.0","customer24");

        // test reset search

        $this->click("css=#search-form button[type='reset']");
        $this->waitForElementNotPresent("css=.grid-view-loading");
        $this->assertText("id=search-result-count","47");
        $this->assertText("css=div.summary","page #1 of 5");

    }
}
