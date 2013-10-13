<?php

class ItemModelTest extends DbTestCase {
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
         public function testBelongsToOrder_items()
    {
        $item = Item::model()->findByPk(2);

        $this->assertInstanceOf('Item', $item->order_items);
    }
      
          public function testAllAttributesHaveLabels()
       {
           $attributes = array_keys($this->category->attributes);

            foreach ($attributes as $attribute) {
                $this->assertArrayHasKey($attribute, $this->category->attributeLabels());
           }
        }
      
          public function testSafeAttributesOnSearch()
        {
            $item = new Item('search');

            $mustBeSafe = array('name', 'price');
            $safeAttrs = $item->safeAttributeNames;
            sort($mustBeSafe); sort($safeAttrs);

            $this->assertEquals($mustBeSafe, $safeAttrs);
       }
       
}
?>
