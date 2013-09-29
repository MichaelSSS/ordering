<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property integer $id_order
 * @property integer $trash
 * @property string $order_name
 * @property string $total_price
 * @property integer $auto_index
 * @property integer $max_discount
 * @property string $delivery_date
 * @property string $status
 * @property integer $assignee
 * @property integer $customer
 * @property integer $filterCriteria
 * @property integer $filterRole
 * @property integer $filterValue
 * @property integer $searchCriteria
 * @property string $order_date
 * @property string $searchValue
 * @property string $preferable_date
 */
class Order extends CActiveRecord
{
    public $currentPageSize = 10;
    const IS_DELETED = 0;
    const ORDER_FORMAT = '0000';

    public $filterCriteria;
    public $filterRole;
    public $filterValue;
    public $searchCriteria;
    public $searchValue;

    public $filterCriterias = array('Status', 'Role');

    public $filterStatuses = array('None', 'Pending', 'Ordered', 'Delivered');
    public $filterRoles = array('None', 'Merchandiser', 'Supervisor', 'Administrator');
    public $searchCriterias = array('order_name'=>'Order Name',  'status'=>'Status', 'assignees.username'=>'Assignee');

    public $filterAttributes = array(
        'Status' => 'status',
        'Role' => 'assignees.role',
    );


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

            array('total_price,preferable_date,order_date, status, assignee, customer, ', 'required', 'except'=>'remove'),
            array('order_name', 'length', 'max' => 128),
            array('order_name', 'match', 'not' => 'true', 'pattern' => '|[^a-zA-Z0-9]|', 'message' => 'Order name can only contain numbers and letters'),
            array('order_name', 'unique', 'message' => 'Order name name already exists in the System. Please re-type it or just leave it blank'),
            array(' assignee, customer', 'numerical', 'integerOnly' => true),
            array('preferable_date, order_date', 'date', 'format' => 'MM/dd/yyyy', 'message' => 'Illegal Date Format', 'except' => 'remove'),
            array('preferable_date', 'checkDate', 'except' => 'remove'),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_order,  order_name, total_price, searchCriteria,  max_discount, filterValue, filterRole, delivery_date, preferable_date ,filterCriteria, status, assignees, searchValue, assigneesRole, customer,trash', 'safe','on'=>'search'),
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
            'assignees' => array(self::BELONGS_TO, 'User', 'assignee'),
            'ordered' => array(self::HAS_MANY, 'OrderDetails', 'order_id'),

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
            'preferable_date' => 'Preferable Delivery Date',
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
        if (empty($this->filterCriteria) && !empty($this->filterValue))
            $criteria->compare('status', $this->filterStatuses[$this->filterValue]);
        elseif (!empty($this->filterCriteria) && !empty($this->filterValue))
            $criteria->compare('assignees.role', $this->filterRoles[$this->filterValue]);

        if ($this->searchValue!="")
        {
            $keyword = strtr($this->searchValue, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%';
            $criteria->compare($this->searchCriteria, $keyword, true, 'AND', false);
        }

        $sort = new CSort('User');
        $sort->attributes = array(
            'assigneesRole' => array(
                'asc' => 'assignees.role',
                'desc' => 'assignees.role DESC',
            ),
            'assignee' => array(
                'asc' => 'assignees.username',
                'desc' => 'assignees.username DESC',
            ),
            '*',
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => $sort,
            'pagination' => array(
                'pageSize' => $this->currentPageSize,
            ),
        ));
    }

    public function getMerchandisers()
    {
        $criteria = new CDbCriteria;
        $criteria->compare("role", 'merchandiser', true);
        $models = User::model()->findAll($criteria);
        $list = CHtml::listData($models, 'id', 'username');
        $list = array(Yii::app()->user->getState('user_id') => '-me-') + $list;
        return $list;
    }

    public function formatDate($d)
    {
        return date('Y-m-d', strtotime($d));
    }

    protected function beforeSave()
    {
        if ($this->order_name == "")
        {
            $criteria = new CDbCriteria;
            $criteria->select = 'MAX(auto_index) AS auto_index';
            $row = $this->find($criteria);
            $this->order_name = self::ORDER_FORMAT . ++$row->auto_index;
            $this->auto_index = $row->auto_index;
        }
        $this->order_date = $this->formatDate($this->order_date);
        $this->preferable_date = $this->formatDate($this->preferable_date);
        return true;
    }


    public function checkDate($preferable_date)
    {
        if (strtotime($this->order_date) > strtotime($this->preferable_date))
        {
            $this->addError($preferable_date, 'Preferable Delivery Date can not be earlier than current date.');
        }
        return true;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */


}
