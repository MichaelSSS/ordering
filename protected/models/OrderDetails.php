<?php

/**
 * This is the model class for table "order_details".
 *
 * The followings are the available columns in table 'order_details':
 * @property integer $id_order
 * @property integer $id_item
 * @property integer $quantity
 * @property string $price
 * @property integer $id_dimension
 */



class OrderDetails extends CActiveRecord
{

     public static $totalItemsQuantity = 0;
     public static $totalPrice = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
            return array(
			array('quantity', 'numerical', 'integerOnly'=>true),
                        array('quantity', 'required'),
                        array('quantity', 'length', 'max'=>3),
                        array('quantity', 'length', 'max'=>3),
                array('id_order, id_item, id_customer, quantity, price, id_dimension', 'safe','on'=>'save'),

		);

	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'itemOredered' =>array(self::BELONGS_TO, 'Item', 'id_item'),
            'orderId' =>array(self::BELONGS_TO, 'Order', 'id_order'),
            'dimensionId' =>array(self::BELONGS_TO, 'Dimension', 'id_dimension'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_order' => 'Id Order',
			'id_item' => 'Id Item',
			'quantity' => 'Quantity',
			'price' => 'Price',
			'id_dimension' => 'Id dimension',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
        $criteria->compare('id_customer', Yii::app()->user->id);
        if(isset($id))
        {
            $criteria->compare('id_order', $id);
        }
        else
        {
            $criteria->compare('id_order', 0);
        }


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}





    public function setCustomer($id)
    {
        $this->id_customer = $id;
    }

    public function getOrderItems($id_customer)
    {

        $criteria = new CDbCriteria;
        $criteria->compare('id_customer',$id_customer );
        $criteria->compare('id_order',Order::IS_ORDERED );

        return  $this->findAll($criteria);
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderedOrder the static model class
     */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getOrderedItems($currentItems )
    {
        $res= array();
        foreach($currentItems as $item)
        {
            $iData = Yii::app()->db->createCommand()
                ->select()
                ->from('item i')
                ->leftJoin('dimension d', 'd.id_dimension =:id_dimension', array(':id_dimension'=>$item['id_dimension']))
                ->where('i.id_item =:id_item', array(':id_item'=>$item['id_item']))
                ->queryAll();
            $iData[0]['customer'] = $item['id_customer'];
            $iData[0]['quantity'] = $item['quantity'];
            $iData[0]['price_per_line'] =  (int)$iData[0]['price'] * (int)$iData[0]['quantity']*(int)$iData[0]['count_of_items'];


            self::$totalItemsQuantity +=(int)$iData[0]['count_of_items'] * (int)$iData[0]['quantity'];
            self::$totalPrice +=(int)$iData[0]['price']*(int)$iData[0]['count_of_items']*(int)$iData[0]['quantity'];

            $res[] = $iData[0];
        }
        return  new CArrayDataProvider($res, array('keyField' => false));
    }

    public static function findOrderDetails($id)
    {
        $iData = Yii::app()->db->createCommand()
            ->select('*, o.quantity as quantity, i.quantity as items_quantity')
            ->from('order_details o, item i, dimension d')
            ->where('o.id_order =:id_order and o.id_dimension =d.id_dimension AND o.id_item = i.id_item', array(':id_order'=>$id))
            ->queryAll();
        foreach ($iData as $key=>$value){
            $iData[$key]['price_per_line']= (int)$iData[$key]['price'] * (int)$iData[$key]['quantity']*(int)$iData[$key]['count_of_items'];


            self::$totalItemsQuantity +=(int)$iData[$key]['count_of_items'] * (int)$iData[$key]['quantity'];
            self::$totalPrice +=(int)$iData[$key]['price']*(int)$iData[$key]['count_of_items']*(int)$iData[$key]['quantity'];
        }
        return  $iData;
    }
//
//    public  function getPricePerLine($price, $quantity)
//    {
//        return $price*$quantity;
//    }

    public function afterSave()
    {
        Yii::app()->session->remove("OrderItems");
    }

    public function searchItem($orderId)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->addCondition('id_order = ' . (int)$orderId);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
