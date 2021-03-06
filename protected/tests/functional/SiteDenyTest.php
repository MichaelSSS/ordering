<?php

class SiteDenyTest extends WebTestCase
{

//    protected $coverageScriptUrl = 'http://mine/phpunit_coverage.php';
    
    protected function setUp()
    {
        parent::setUp();
        $this->setBrowser("*firefox");
    }

    public $fixtures=array(
        'userTable'=>':userTable',
        'userLogin' => ':user_login',
        'userAttempt' => ':user_attempt',
    );

	public function testBlock()
	{
		$this->open('');
        for ($i=1;$i<5;$i++) {
            $this->type("id=LoginForm_username", "admin01");
            $this->type("id=LoginForm_password", "wrong");
            $this->click("name=yt0");
            $this->waitForTextPresent('Password is incorrect');
        }
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "wrong");
        $this->click("name=yt0");
        $this->waitForTextPresent('Page is locked');
        $this->pause(5000);
    }

/*	public function testUnBlock()
	{
        Yii::app()->db->createCommand('UPDATE user_attempt SET blocked_until=' . (time()-1))->execute();

		$this->open('');

        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        $this->assertTextPresent('Create New User');
        $this->pause(3000);
    }
*/
    public function testLimit()
    {

       // Yii::app()->db->createCommand('TRUNCATE user_login')->execute();

        $extraTime = time() + 3600;

        $command = Yii::app()->db->createCommand('
            INSERT INTO user_login (user_id,last_action_time,user_agent) 
            VALUE (:userId, :lastActionTime, :userAgent)
        ');

        // create 49 fictious active users
        for($i=1;$i<=50;$i++) {
            $command->execute(array(
                'userId'         => -1,
                'lastActionTime' => $extraTime,
                'userAgent'      => 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0',
            ));
        }

        // log in as 50-th user to fill the limit
/*        $this->open('');
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        $this->assertTextPresent('Create New User');
        $this->pause(3000);
*/
        // try to log in once more to check that login is denied
        $this->open('');
        $this->type("id=LoginForm_username", "customer01");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        $this->assertTextPresent('only 50 users');
        $this->pause(5000);

        // logout 50-th user and try to login once more.
        // now we must be able to ligin
/*        $this->open('');
        $this->type("id=LoginForm_username", "admin01");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        $this->click('link=Logout');
        $this->waitForTextPresent('Are you sure');
        $this->clickAndWait('link=Yes');

        $this->assertText("css=button[type='submit']","login"); 
        $this->type("id=LoginForm_username", "customer01");
        $this->type("id=LoginForm_password", "aA1!");
        $this->clickAndWait("name=yt0");
        $this->assertTextPresent('Create New Order');
*/
        $command = Yii::app()->db->createCommand('TRUNCATE user_login')->execute();

    }
}
