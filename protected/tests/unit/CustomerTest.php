<?php
class CustomerTest extends CDbTestCase
{

    public $fixtures = array(
        'customers' => 'Customer',
    );

    public function testUpdateBalance()
    {
        $customer = $this->customers('customer2');
        $oldBalance = (int)$customer->account_balance;
        $oldType = $customer->customer_type;

        $profit = 300;

        $customer->updateBalance($profit,(int)$customer->customer_id );

        $customer->refresh();

        $this->assertNotEquals($oldBalance,(int)$customer->account_balance );
        $this->assertGreaterThan($oldBalance, (int)$customer->account_balance );
        $this->assertEquals($oldBalance,(int)$customer->account_balance-$profit);
        $this->assertNotEquals($oldType,$customer->customer_type);
    }

    public function testCheckType()
    {
        $customer = new Customer();
        $customer->account_balance = 500;
        $customer->checkType($customer);

        $this->assertEquals('Standart', $customer->customer_type);

        $customer->account_balance = 1500;
        $customer->checkType($customer);

        $this->assertEquals('Silver', $customer->customer_type);

        $customer->account_balance = 5000;
        $customer->checkType($customer);

        $this->assertEquals('Gold', $customer->customer_type);

        $customer->account_balance = 15000;
        $customer->checkType($customer);

        $this->assertEquals('Platinum', $customer->customer_type);
    }

    public function testGetDiscount()
    {
        $customer1 = $this->customers('customer1');

        $this->assertEquals(Customer::SILVER_DISCOUNT, $customer1->getDiscount($customer1->customer_id));

        $customer1 = $this->customers('customer2');

        $this->assertEquals(Customer::STANDART_DISCOUNT, $customer1->getDiscount($customer1->customer_id));

        $customer1 = $this->customers('customer3');

        $this->assertEquals(Customer::PLATINUM_DISCOUNT, $customer1->getDiscount($customer1->customer_id));
    }

}