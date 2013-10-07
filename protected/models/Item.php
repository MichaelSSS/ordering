<?php

class Item extends CActiveRecord
{
    public $currentPageSize = 10;
    public $filterValue;
  
    public $searchValue;
    public $nextPageSize = array(10=>25,25=>2,2=>3,3=>10);

    public $searchCriteria;

    public $searchCriterias = array('id_item'=>'Id Item','name'=>'Item Name','description'=>'Description','price'=>'Price','quantity'=>'Quantity');
   
  
    public $filterCriteria;
    public $filterCriterias = array('Id Item', 'Item Name','Description','Price','Quantity');

    public $addI;

 
	public function tableName()
	{
		return 'item';
	}

	public function rules()
	{
		return array(
			array('id_item,price,quantity', 'required'),
                        array('id_item','unique'),
			array('quantity','numerical', 'integerOnly'=>true),
                        array('price','numerical'),
			array('name', 'length', 'max'=>40),
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

            'order_items' => array(self::HAS_MANY, 'OrderItem', 'id_item'),
           // 'dimension' => array(self::HAS_MANY, 'OrderItem', 'id_item'),
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


    public function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, $this->nextPageSize);
    }

    public function search()
    {
        
        $criteria= new CDbCriteria;
  //    $criteria->compare('id_item',$this->id_item);
  //    $criteria->compare('name',$this->name,true);
  //    $criteria->compare('price',$this->price,true);
 
      
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
            ),
            'price'=>array(
                'asc'=>'price',
                'desc'=>'price desc',
                ),
            'quantity'=>array(
                'asc'=>'quantity',
                'desc'=>'quantity desc',
                )
        );
        
return new CActiveDataProvider($this,array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$this->currentPageSize,
              
            ),
                'sort'=>$sort,
        ));

    }
    
        public function add()
    {


            // получаем ID статьи, но учтите, т.к. это тренировочный
            // скрипт мы не фильтруем содержимое $_POST
            // в реальном скрипте фильтрация обязательна
            //$item_id = $this->addI;
       // if (isset($_POST['item_id']))
            
            //echo '{"item_id":"'.$item_id.'"}';
            
           /* $command = Yii::app()->db->createCommand();
            $user = Yii::app()->db->createCommand()
                ->select('name, price')
                ->from('item')
                ->where('id=:id', array(':id'=>$item_id))
                ->queryRow();*/
            //$connect = new mysqli("localhost", "root", "", "managerarticle");

            // считываем все данные статьи по $article_id
            //$result = $connect->query("select * from item where article_id = '$article_id'");
            //$row = $result->fetch_object();

            // отправляем все данные в формате JSON нашему основному скрипту (index.php)
            //формат JSON выглядит так:
            // "ключ1":"значени1", "ключ2":"значени2" и т.д.
           // echo '{"item_id";"'.$item_id.'"}';
            /*echo '{"item_name":"'.$this->name.'",
             "item_price":"'.$this->price.'",
                 "fff":"'.'fff'.'"}';*/

    }
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}

