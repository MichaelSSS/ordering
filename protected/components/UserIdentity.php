<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public function authenticate()
	{
        $model = User::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if( $model===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif( !$model->validatePassword($this->password) )
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;
            return $model->role;
        }
		return false;
	}
}