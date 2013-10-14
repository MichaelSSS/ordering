<?php
class AdminCreateDbTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        $pdo = new PDO('mysql:dbname=oms_test;host=127.0.0.1','root','');
        return $this->createDefaultDBConnection($pdo, 'oms_test');
    }
    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return new PHPUnit_Extensions_Database_DataSet_CsvDataSet();
    }

    public function testCreateUser()
    {
        $queryTable = $this->getConnection()->createQueryTable(
            'user', 
            'SELECT id,username,role,firstname,lastname,email,region,deleted 
             FROM user 
             WHERE id=2'
        );
        $expectedTable = $this->createXmlDataSet("unit/userCreated.xml")
                              ->getTable("user");
        $this->assertTablesEqual($expectedTable, $queryTable);

        $queryTable = $this->getConnection()->createQueryTable(
            'user', 
            'SELECT password 
             FROM user 
             WHERE id=2'
        );
        
        $queryPasswordHash = $queryTable->getValue(0,'password');
        $expectedPasswordHash = crypt('aA1!',$queryPasswordHash);

        $this->assertEquals($expectedPasswordHash,$queryPasswordHash);
    }
}
?>