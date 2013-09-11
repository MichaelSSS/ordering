<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property integer $id_order
 * @property integer $trash
 * @property string $order_name
 * @property string $total_price
 * @property integer $max_discount
 * @property string $delivery_date
 * @property string $status
 * @property integer $assignee
 * @property integer $customer
 */
class Order extends CActiveRecord
{

    private $assigneesRole;
    public $searchCriteria = array();
    public $currentPageSize = 10;
    const IS_DELETED = 0;


    public $filterCriteria;
    public $filterRole;
    public $filterStatus;
    public $searchField;
    public $searchValue;

    public $filterCriterias = array('Status', 'Role');
    public $filterStatuses = array('None', 'Ordered', 'Pending', 'Delivered');
    public $filterRoles = array('None', 'Merchandiser', 'Administrator', 'Supervisor');
    public $searchFields = array('Order Name', 'Status', 'Assignee');

    public $filterAttributes = array(
        'Status' => 'status',
        'Role' => 'assignees.role',
    );

    public $searchAttributes = array(
        'None' => '',
        'Order Name' => 'order_name',
        'Status' => 'status',
        'Assignee' => 'assignees.username',
    );

    public $statusAttributes = array(
        'None' => '',
        'User Name' => 'username',
        'First Name' => 'firstname',
        'Last Name' => 'lastname',
        'Role' => 'role'
    );




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
			array('order_name, total_price, max_discount, delivery_date, assignee, customer', 'required'),
			array('max_discount, assignee, customer', 'numerical', 'integerOnly'=>true),
			array('order_name', 'length', 'max'=>128),
			array('total_price', 'length', 'max'=>12),
			array('status', 'length', 'max'=>9),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_order,  order_name, total_price, max_discount, delivery_date, status, assignees, assigneesRole, customer', 'safe', 'on'=>'search'),
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
			'assigneesRole' => 'Role',
			'customer' => 'Customer',
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
        $criteria = new CDbCriteria;
        $criteria->with = array('assignees');
        $criteria->compare('customer', $this->customer);
        $criteria->compare('trash', self::IS_DELETED);
        $criteria->addCondition($this->searchCriteria);

//        $criteria->compare('order_name',$this->order_name,true);
//        $criteria->compare('total_price',$this->total_price,true);
//        $criteria->compare('max_discount',$this->max_discount);
//        $criteria->compare('delivery_date',$this->delivery_date,true);
//        $criteria->compare('status',$this->status,true);
//        $criteria->compare('assignee',$this->assignee);
//        $criteria->compare('customer',$this->customer);

        $sort = new CSort('User');
        $sort->attributes = array(
                'assigneesRole'=>array(
                    'asc'=>'assignees.role',
                    'desc'=>'assignees.role DESC',
                ),
                '*',
        );
        return new CActiveDataProvider($this,array(
            'criteria' => $criteria,
            'sort'=>$sort,
            'pagination'=>array(
                'pageSize'=>$this->currentPageSize,
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
