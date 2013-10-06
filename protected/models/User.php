<?php

class User extends CActiveRecord
{

    public $currentPageSize = 10;
    public $searchCriteria = array();

    public $confirmPassword;
    public $status;


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        return array(
            array('username,firstname,lastname,email', 'required','except'=>'remove'),
            array('password,confirmPassword','required','except'=>'remove,edit'),
            array('username, password,role,firstname,lastname,email,region,deleted','safe','except'=>'remove'),

            array('username','unique','message'=>'Login name already exist','except'=>'remove'),
            array('username','length','max'=>20,'message'=>'Login Name is too long','except'=>'remove'),
            array('username','match','not'=>true,'pattern'=>'[\s]','message'=>'Login Name cannot contain spaces','except'=>'remove'),
            array('email','email','message'=>'Incorrect format of Email Adress','except'=>'remove'),

            array('password','length','min'=>4,'max'=>10,'except'=>'remove'),
            array('password','match','pattern'=>'|(?=^.{1,25}$)(?=(?:.*?\d){1})(?=.*[a-z])(?=(?:.*?[A-Z]){1})(?=(?:.*?[!@#$%*()_+^&}{:;?.\[\~\`\-\=\'"\<\>\,\/\]]){1})(?!.*\s)[0-9a-zA-Z!@#$%*()_+^&\[\~\`\-\=\'"\<\>\,\/\]]*$|','message'=>'The value provided for the password does not meet required complexity','except'=>'remove'),
            array('confirmPassword', 'compare', 'compareAttribute'=>'password','message'=>'Confirm Password is not equal to Password','except'=>'remove'),

            array('firstname','length','max'=>50,'message'=>'First Name is too long','except'=>'remove'),
            array('lastname','length','max'=>50,'message'=>'Last Name is too long','except'=>'remove'),

        );
	}



	protected function beforeSave()
	{
	    $this->password = CPasswordHelper::hashPassword($this->password);
	    $this->username = trim($this->username);
	    $this->firstname = trim($this->username);
	    $this->lastname = trim($this->username);

	    return true;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'         => 'Id',
			'username'   => 'User Name',
			'password'   => 'Password',
            'firstname'  => 'First Name',
            'lastname'   => 'Last Name',
            'role'       => 'Role',
            'email'      => 'Email',
            'region'     => 'Region',
            'deleted'     => 'Status',
		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password, $this->password);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}


    public function search()
    {
        return new CActiveDataProvider('User', array(
            'model'=>$this,
            'criteria'   => $this->searchCriteria,
            'pagination' => array(
                'pageSize' => $this->currentPageSize,
            ),
            'sort' => array(
                'multiSort' => true,
            ),
        ));
    }
}
