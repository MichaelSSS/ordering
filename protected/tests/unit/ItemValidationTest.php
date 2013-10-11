<?php

class ItemValidationTest extends DbTestCase {
     /**
       * @var Item
       */
      protected $item;

    public $fixtures = array(
        'items' => 'Item',
    );
      protected function setUp()
      {
          parent::setUp();
          $this->item = new Item();
          
      }
        // public function testBelongsToOrder_items()
    //{
     //   $item = Item::model()->findByPk(2);

      //  $this->assertInstanceOf('Item', $item->order_items);
    //}
      
         // public function testAllAttributesHaveLabels()
      //  {
        //    $attributes = array_keys($this->category->attributes);

         //   foreach ($attributes as $attribute) {
         //       $this->assertArrayHasKey($attribute, $this->category->attributeLabels());
        //    }
        //}
      
      //    public function testSafeAttributesOnSearch()
     //   {
     //       $item = new Item('search');

     //       $mustBeSafe = array('name', 'price');
     //       $safeAttrs = $item->safeAttributeNames;
     //       sort($mustBeSafe); sort($safeAttrs);

     //       $this->assertEquals($mustBeSafe, $safeAttrs);
    //    }
        public function testIdItemRequired()
    {
        $this->item->id_item = '';
        $this->assertFalse($this->item->validate(array('id_item')));
    }
        public function testQuantityRequired() 
    {
        $this->item->quantity ='';
        $this->assertFalse($this->item->validate(array('quantity')));
    }
         public function testPriceRequired() 
    {
        $this->item->price ='';
        $this->assertFalse($this->item->validate(array('price')));
    }
         public function testQuantityIsIntegerOnly()
    {
        $this->item->quantity = 'quantity';
        $this->assertFalse($this->item->validate(array('quantity')));

        $this->item->quantity = 100;
        $this->assertTrue($this->item->validate(array('quantity')));
    }
        public function testPriceIsNumerical()
        {
            $this->item->price = 10.1234;
            $this->assertEquals(10.12, $item->price);
        }
       // public function testIdItemUnique()
       // {
        //    $this->item->id_item=1;
       //     $this->assertFalse($this->item->)
       // }
        public function testNameMaxLength()
    {
        $this->item->name = generateString(31);
        $this->assertFalse($this->item->validate(array('name')));

        $this->item->name = generateString(30);
        $this->assertTrue($this->item->validate(array('name')));
    }
        
        public function testDescriptionMaxLength() {
        
        $this->item->description =generateString(256);
        $this->assertFalse($this->item->validate(array('description')));
        
        $this->item->description = generateString(255);
        $this->assertTrue($this->item->validate(array('description')));
    }
        function generateString($length)
    {
        $random= "";
        srand((double)microtime()*1000000);
        $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $char_list .= "abcdefghijklmnopqrstuvwxyz";
        $char_list .= "1234567890";
     
        for($i = 0; $i < $length; $i++)
        {
            $random .= substr($char_list,(rand()%(strlen($char_list))), 1);
        }
        return $random;
    }
   
}
?>
