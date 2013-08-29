<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    private $role;	

    public $username;
	public $password;
	public $rememberMe;
    
    public function getRole()
    {
        return $this->role;
    }

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username', 'required', 'message'=>'Please enter user name'),
			array('password', 'required', 'message'=>'Please enter password'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'username'=>'User Name',
			'rememberMe'=>'Remember User Name',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
            $this->role = $this->_identity->authenticate();
			if( !$this->role ){
                if( $this->_identity->errorCode == CUserIdentity::ERROR_USERNAME_INVALID )
    				$this->addError('username','Such user does not exist in the system - please try again');
                elseif( $this->_identity->errorCode == CUserIdentity::ERROR_PASSWORD_INVALID )
    				$this->addError('password','Password is incorrect - please try again' . $role);

            }

		}
        return !$this->hasErrors();
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
