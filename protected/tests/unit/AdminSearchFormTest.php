<?php
class AdminSearchFormTest extends PHPUnit_Framework_TestCase {

    const INDEX_ALL_COLUMNS = 0;
    const INDEX_USER_NAME = 1;
    const INDEX_FIRST_NAME = 2;
    const INDEX_LAST_NAME = 3;
    const INDEX_ROLE = 4;

    const INDEX_EQUALS = 0;
    const INDEX_NOT_EQUALS = 1;
    const INDEX_STARTS_WITH = 2;
    const INDEX_CONTAINS = 3;
    const INDEX_NOT_CONTAINS = 4;

    public function testGetCriteria()
    {
        $adminSearchForm = new AdminSearchForm;

        $adminSearchForm->keyValue = 'zzz';
        $adminSearchForm->keyField = self::INDEX_ALL_COLUMNS;
        $adminSearchForm->criteria = self::INDEX_NOT_CONTAINS;

        $this->assertEquals(
            array(
                'condition' => "(username NOT LIKE '%' ? '%') OR "
                    . "(firstname NOT LIKE '%' ? '%') OR "
                    . "(lastname NOT LIKE '%' ? '%') OR "
                    . "(role NOT LIKE '%' ? '%') OR "
                    . "(email NOT LIKE '%' ? '%') OR "
                    . "(region NOT LIKE '%' ? '%')",
                'params'    => array(
                    1 => "zzz",
                    2 => "zzz",
                    3 => "zzz",
                    4 => "zzz",
                    5 => "zzz",
                    6 => "zzz"
                )
            ),
            $adminSearchForm->getCriteria()
        );

        $adminSearchForm->keyField = self::INDEX_USER_NAME;
        $adminSearchForm->criteria = self::INDEX_STARTS_WITH;

        $this->assertEquals(
            array(
                'condition' => "username LIKE ? '%'",
                'params'    => array("zzz")
            ),
            $adminSearchForm->getCriteria()
        );

    }
}

