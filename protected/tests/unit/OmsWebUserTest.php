<?php
class OmsWebUserTest extends PHPUnit_Framework_TestCase {

    protected $webUser;

    public static function setUpBeforeClass()
    {
        Yii::app()->db
            ->createCommand('TRUNCATE user_login')
            ->execute();
    }
    
    public function setUp()
    {
        $this->webUser = new OmsWebUser;
        $this->webUser->setId(1);
    }

    public function testIsActiveFalse()
    {
        $this->assertFalse(OmsWebUser::isActive($this->webUser->id, time()));
    }

    public function testIsActiveTrue()
    {
        Yii::app()->db
            ->createCommand('
                INSERT INTO user_login (user_id, last_action_time, user_agent)
                VALUES (1, UNIX_TIMESTAMP(), "Mozilla")
            ')
            ->execute();
        $this->assertTrue(OmsWebUser::isActive($this->webUser->id, time()));
    }

    public function testCountActive()
    {
        $this->assertEquals(1,$this->webUser->countActive(time()));
    }

    public function testMakeUnActive()
    {
        $this->webUser->makeUnactive();

        $this->assertFalse(OmsWebUser::isActive($this->webUser->id, time()));

        $this->assertEquals(0,$this->webUser->countActive(time()));
    }

}

