<?php

/**
 *  class.
 *  is the data structure for keeping
 * 
 */
class AdminSearchForm extends CFormModel
{
    
    public $keyField;
	public $criteria;
	public $keyValue;

    public $keyFields = array('All Columns', 'User Name', 'First Name', 'Last Name', 'Role');
    public $criterias = array('equals','not equals','starts with','contains','does not contain');

    public $keyAttributes = array(
        'All Columns'=>'*',
        'User Name'=>'username',
        'First Name'=>'firstname',
        'Last Name'=>'lastname',
        'Role'=>'role'
    );

    public $operators = array(
                 'equals'  => " =?",
             'not equals'  => " <>?",
             'starts with' => " LIKE ? '%'",
                'contains' => " LIKE '%' ? '%'",
        'does not contain' => " NOT LIKE '%' ? '%'"
    );

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
            array('keyValue', 'required', 'message'=>'please, fill the field before search'),
            array('keyValue', 'length', 'max'=>128),
            array('keyField,criteria', 'numerical', 'message'=>'illegal filter parameters'),
            array('keyField,criteria,keyValue','safe','on'=>'search'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
		);
	}


    public function getCriteria()
    {

        if( $this->keyAttributes[$this->keyFields[$this->keyField]] != '*' ){

            $condition = $this->keyAttributes[$this->keyFields[$this->keyField]]
                . $this->operators[$this->criterias[$this->criteria]];



            return array(
                'condition' => $condition,
                'params' => array($this->keyValue)
            );

        }else{

            $numKeys = count($this->keyFields);

            $condition = '';

            for($i=1; $i < $numKeys-1; ++$i){
                $condition .= '(' 
                    . $this->keyAttributes[$this->keyFields[$i]]
                    . $this->operators[$this->criterias[$this->criteria]]
                    . ') OR ';
            }

            $condition .= '(' 
                . $this->keyAttributes[$this->keyFields[$numKeys-1]]
                . $this->operators[$this->criterias[$this->criteria]]
                . ')';

            return array(
                'condition' => $condition,
                'params' => array_fill(0,$numKeys-1,$this->keyValue)
            );

        }        
    }

}
