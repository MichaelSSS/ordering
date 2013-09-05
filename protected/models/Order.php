<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property integer $id_order
 * @property string $order_name
 * @property string $total_price
 * @property integer $max_discount
 * @property string $delivery_date
 * @property string $status
 * @property integer $assignee
 */
class Order extends CActiveRecord
{
    private $username;
    public $searchCriteria = array();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_name, total_price, max_discount, delivery_date, assignee', 'required'),
			array('max_discount, assignee', 'numerical', 'integerOnly'=>true),
			array('order_name', 'length', 'max'=>128),
			array('total_price', 'length', 'max'=>10),
			array('status', 'length', 'max'=>9),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_order, order_name, total_price, max_discount, delivery_date, status, assignee', 'safe', 'on'=>'search'),
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
            'assignees'=>array(self::BELONGS_TO, 'User', 'assignee'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_order' => 'Id Order',
			'order_name' => 'Order Name',
			'total_price' => 'Total Price',
			'max_discount' => 'Max Discount',
			'delivery_date' => 'Delivery Date',
			'status' => 'Status',
			'assignee' => 'Assignee',
			'assignees.password' => 'Password',
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
        $criteria->join = 'join {{user}} as u on t.assignee = u.id ';
/*
		$criteria=new CDbCriteria;

        $criteria->join = 'join {{user}} as u on t.assignee = u.id ';
        $criteria->select = 't.*,u.role, u.username';

		$criteria->compare('id_order',$this->id_order);
		$criteria->compare('order_name',$this->order_name,true);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('max_discount',$this->max_discount);
		$criteria->compare('delivery_date',$this->delivery_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('assignee',$this->assignee);

//        var_dump($criteria);exit;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
        ));
*/
   //  return new CSqlDataProvider("SELECT t.*,u.role, u.username FROM `tbl_order` `t` join tbl_user as u on t.assignee = u.id");

        return new CActiveDataProvider('Order',array(
            'criteria' => array(
                'select' => 't.*,u.role, u.username',
                'join' => 'join tbl_user as u on t.assignee = u.id ',

            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


}
