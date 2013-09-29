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
//			array('id_order, id_item, quantity, price, id_dimension', 'required'),
//			array('id_order, id_item, quantity, id_dimension', 'numerical', 'integerOnly'=>true),
//			array('price', 'length', 'max'=>6),
			// The following rule is used by search().
//			 @todo Please remove those attributes that should not be searched.
			array('id_order, id_item, quantity, price, id_dimension', 'safe'),
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
        $criteria->compare('id_customer', Yii::app()->user->id);
        $criteria->compare('id_order',0);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getPricePerLine(){
        self::$totalItemsQuantity +=(int)$this->quantity * (int)$this->dimensionId->count_of_items;
        self::$totalPrice +=$this->itemOredered->price * $this->quantity * $this->dimensionId->count_of_items;
        return $this->itemOredered->price * $this->quantity * $this->dimensionId->count_of_items;

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
}
