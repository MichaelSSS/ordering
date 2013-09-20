<?php

class Item extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 */
    
    public $currentPageSize = 10;
    public $nextPageSize = array(10=>25,25=>2,2=>3,3=>10);
    public $searchCriteria = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
//	public static function model($className=__CLASS__)
//	{
//		return parent::model($className);
//	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Item_Name, ItemDescription, Price, Quantity', 'required'),
			array('Price, Quantity', 'numerical', 'integerOnly'=>true),
			array('Item_Name', 'length', 'max'=>30),
			//array('Demension', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Item_Number, Item_Name, ItemDescription, Price, Quantity', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Item_Number' => 'Item Number',
			'Item_Name' => 'Item Name',
			'ItemDescription' => 'Item Description',
			//'Demension' => 'Dimension',
			'Price' => 'Price',
			'Quantity' => 'Quantity',
		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
//	public function validatePassword($password)
//	{
//		return CPasswordHelper::verifyPassword($password,$this->password);
//	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
//	public function hashPassword($password)
//	{
//		return CPasswordHelper::hashPassword($password);
//	}

    public function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, $this->nextPageSize);
    }

    public function search()
    {
//file_put_contents('d:\\log.txt', print_r($_POST['User'],true));

	
        return new CActiveDataProvider('Item',array(
           'criteria'=>$this->searchCriteria,
            'pagination'=>array(
                'pageSize'=>$this->currentPageSize,
            ),
        ));
    }
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        //public function updateLastActionTime()
    //{
     //   $currentTime = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
      //  $this->lastActionTime = $currentTime;
      //  $this->update(array('lastActionTime'));

    //}
}

