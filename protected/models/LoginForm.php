<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    const ERROR_USER_LOGGED = 1;
    const ERROR_ACTIVE_LIMIT = 2;

    public $username;
    public $password;
    public $rememberMe;

    private $_errorCode = 0;
    
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
            'username'   => 'User Name',
            'rememberMe' => 'Remember User Name',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        if ( !$this->hasErrors() ) {
            $this->_identity=new UserIdentity($this->username,$this->password);            

            if ( !$this->_identity->authenticate() ) {
                if ( $this->_identity->errorCode == CUserIdentity::ERROR_USERNAME_INVALID ) {
                    $this->addError('username','Such user does not exist in the system - please try again');
                } elseif ( $this->_identity->errorCode == CUserIdentity::ERROR_PASSWORD_INVALID ) {
                    $this->addError('password','Password is incorrect - please try again');
                } 
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
        if ( $this->_identity===null ) {
            $this->_identity=new UserIdentity($this->username,$this->password);
            $this->_identity->authenticate();
        }


        if ( $this->_identity->errorCode===UserIdentity::ERROR_NONE ) {
            $user = Yii::app()->user;
            $userId = $this->_identity->getId();
            
            // determine if user logged in another browser
            if ( $user->isActive($userId, time()) 
                && !$user->isSameUserAgent($userId) ) {
               
                $this->_errorCode = self::ERROR_USER_LOGGED;
                return false;
                
            // apply 50 active users limit    
            } elseif ( $user->countActive(time()) >= 50 ) {
                $this->_errorCode = self::ERROR_ACTIVE_LIMIT;
                return false;
            }

            $duration = 0;
            //file_put_contents("d:/log.txt", print_r(Yii::app()->user->rememberedName,true));
            if ( $this->rememberMe ) {
                $user->setState('Remembered Name',$this->username);
            
                $duration = 3600*24*30; // 30 days

            } elseif ( $user->getRememberedName() == $this->username ) {
                     
                $user->setState('Remembered Name',null);
                $user->rememberedName = '';
                $duration = 1;
            }
            
            $user->login($this->_identity,$duration);
            $user->updateLastActionTime();
            $user->homeController = $this->_identity->getHomeController();
            
            return !$this->hasErrors();

        } else {
            return false;
        }
    }


    public function getErrorCode()
    {
        return $this->_errorCode;
    }

}
