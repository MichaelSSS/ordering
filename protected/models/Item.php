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
      public $filterValue;
  
    public $searchValue;
    public $nextPageSize = array(10=>25,25=>2,2=>3,3=>10);
    public $searchCriteria;
     public $searchCriterias = array('id_item'=>'Id Item','name'=>'Item Name','description'=>'Description','price'=>'Price','quantity'=>'Quantity');
    //===========================================
   // public $filterCriterias = array('id_item', 'name');
     public $filterCriteria;
      public $filterCriterias = array('Id Item', 'Item Name','Description','Price','Quantity');
    //================================================
    


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
			array('id_item,price,quantity', 'required'),
                        array('id_item','unique'),
			array('quantity','numerical', 'integerOnly'=>true),
                        array('price','numerical'),
			array('name', 'length', 'max'=>30),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_item, searchValue, searchCriteria, searchCriterias, price, name, description, quantity', 'safe', 'on'=>'search'),
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
			'id_item' => 'Item Number',
                        'price'=>'Price',
			'name' => 'Item Name',
			'description' => 'Item Description',
                        'quantity' => 'Quantity',
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
        
        $criteria= new CDbCriteria;
       // $criteria->compare('id_item',$this->id_item);
      //  $criteria->compare('name',$this->name,true);
     //   $criteria->compare('price',$this->price,true);
       // $criteria->condition='id>3';
        
       //    if (empty($this->filterCriteria) && !empty($this->filterValue))
         //   $criteria->compare('status', $this->filterStatuses[$this->filterValue]);
       // elseif (!empty($this->filterCriteria) && !empty($this->filterValue))
       //     $criteria->compare('assignees.role', $this->filterRoles[$this->filterValue]);

        if ($this->searchValue!="")
        {
            $keyword = strtr($this->searchValue, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%';
            $criteria->compare($this->searchCriteria, $keyword, true, 'AND', false);
        }
                
       $sort=new CSort;
        $sort->attributes=array(
            'id_item'=>array(
               'asc'=>'id_item',
                'desc'=>'id_item desc',
            )
        );
        
return new CActiveDataProvider($this,array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$this->currentPageSize,
              
            ),
                'sort'=>$sort,
        ));
//=========================================================
	
      //  return new CActiveDataProvider('Item',array(
        //   'criteria'=>$this->searchCriteria,
          //  'pagination'=>array(
            //    'pageSize'=>$this->currentPageSize,
            //),
        //));
        //=======================================================
    }
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

     
       //   public function getTotalprice(){
            
       //     return $this->price->price * $this->quantity;

       // } 
}

