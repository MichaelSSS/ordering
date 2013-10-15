<?php
class UserIdentityTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        $pdo = new PDO('mysql:dbname=oms_test;host=127.0.0.1','root','');
        return $this->createDefaultDBConnection($pdo, 'oms_test');
    }

    public static function setUpBeforeClass()
    {
        Yii::app()->db
            ->createCommand('TRUNCATE `user_attempt`')
            ->execute();
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return new PHPUnit_Extensions_Database_DataSet_CsvDataSet();
    }

    public function testIsBlockedFalse()
    {
        $this->assertFalse(UserIdentity::isBlocked('127.0.0.1'));
    }

    public function testAddFailedAttempt()
    {
        // add 1st fail
        UserIdentity::addFailedAttempt('127.0.0.1');
        $queryTable = $this->getConnection()->createQueryTable(
            'user_attempt', 
            'SELECT id, user_ip, attempt_count
             FROM user_attempt' 
        );
        $queryTableTime = $this->getConnection()->createQueryTable(
            'user_attempt', 
            'SELECT blocked_until
             FROM user_attempt' 
        );
        $expectedTable = $this->createXmlDataSet("unit/user_attempt_expected.xml")
                              ->getTable("user_attempt");
        $this->assertTablesEqual($expectedTable, $queryTable);
        $this->assertNull($queryTableTime->getValue(0,'blocked_until'));

        // add 2nd fail
        UserIdentity::addFailedAttempt('127.0.0.1');
        $queryTable = $this->getConnection()->createQueryTable(
            'user_attempt', 
            'SELECT id, user_ip, attempt_count
             FROM user_attempt' 
        );
        $expectedTable = $this->createXmlDataSet("unit/user_attempt_expected2.xml")
                              ->getTable("user_attempt");
        $this->assertTablesEqual($expectedTable, $queryTable);
        $this->assertNull($queryTableTime->getValue(0,'blocked_until'));
    }

    public function testResetAttempt()
    {
        UserIdentity::resetAttempt('127.0.0.1');
        $queryTable = $this->getConnection()->createQueryTable(
            'user_attempt', 
            'SELECT id, user_ip, attempt_count
             FROM user_attempt' 
        );
        $expectedTable = $this->createXmlDataSet("unit/user_attempt_expected0.xml")
                              ->getTable("user_attempt");
        $this->assertTablesEqual($expectedTable, $queryTable);
        
    }


    public function testSetBlock()
    {
        UserIdentity::setBlock('127.0.0.1');
        $queryTableTime = $this->getConnection()->createQueryTable(
            'user_attempt', 
            'SELECT blocked_until
             FROM user_attempt' 
        );

        $blockedTime = $queryTableTime->getValue(0,'blocked_until');

        $this->assertNotNull($blockedTime);
        $this->assertGreaterThan(time(), $blockedTime);

    }

    public function testIsBlockedTrue()
    {
        $this->assertTrue(UserIdentity::isBlocked('127.0.0.1'));
    }

}
?>