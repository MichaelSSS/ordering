<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_userId = 0;
    private $_home = '';

    protected function addFailedAttempt($userIp)
    {
        $curAttempts = 0;
        $affectedRows = 0;
        
        $command = Yii::app()->db->createCommand('
            SELECT attempt_count 
            FROM user_attempt
            WHERE user_ip= :userIp
        ');
        $curAttempts = $command->queryScalar(array(
            'userIp' => $userIp,
        ));
        if ($curAttempts === false) {
            $command = Yii::app()->db->createCommand('
                INSERT INTO user_attempt (user_ip,attempt_count) 
                VALUE (:userIp, 1)
            ');
            $affectedRows = $command->execute(array(
                'userIp' => $userIp,
            ));
            return 1;
        }  else {
            $curAttempts = (int)$curAttempts + 1;
            $command = Yii::app()->db->createCommand('
                UPDATE user_attempt 
                SET attempt_count= :attempts
                WHERE user_ip= :userIp
            ');
            $affectedRows = $command->execute(array(
                'attempts' => $curAttempts,
                'userIp'  => $userIp,
            ));
            return $curAttempts;
        }
        return $affectedRows;
    }
    protected function setBlock($userIp)
    {
        $affectedRows = 0;        
        $command = Yii::app()->db->createCommand('
            UPDATE user_attempt 
            SET blocked_until= :blockedTime, attempt_count= 0
            WHERE user_ip= :userIp
        ');
        $affectedRows = $command->execute(array(
            'blockedTime' => time() + Yii::app()->params['blockSeconds'],
            'userIp'  => $userIp,
        ));
        Yii::app()->user->setState('blocked','1');
        return $affectedRows;
    }        
    protected function resetAttempt($userIp)
    {
        $affectedRows = 0;
        $command = Yii::app()->db->createCommand('
            UPDATE user_attempt 
            SET attempt_count= 0
            WHERE user_ip= :userIp
        ');
        $affectedRows = $command->execute(array(
            'userIp'  => $userIp,
        ));
        return $affectedRows;
    }    
    
    public static function isBlocked($userIp)
    {
        $command = Yii::app()->db->createCommand('
            SELECT blocked_until
            FROM user_attempt
            WHERE user_ip= :userIp
        ');
        $blockedTime = $command->queryScalar(array(
            'userIp' => $userIp,
        ));
        return $blockedTime >= time();
    }
    
    public function authenticate()
    {
        $model = User::model()->find('LOWER(username)=?',array(strtolower($this->username)));
        $userIp = $_SERVER['REMOTE_ADDR'];
        $attemptCount = 0;
        if ( $model===null || $model->deleted ) {
            $attemptCount = $this->addFailedAttempt($userIp);
            if ( $attemptCount >= Yii::app()->params['maxCredentialAttempts'] ) {
                $this->setBlock($userIp);
            } else {
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
        } elseif ( !$model->validatePassword($this->password) ) {
            $attemptCount = $this->addFailedAttempt($userIp);
            if ( $attemptCount >= Yii::app()->params['maxCredentialAttempts'] ) {
                $this->setBlock($userIp);
            } else {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
        } else {
            Yii::app()->user->setState('blocked','0');
            $this->errorCode=self::ERROR_NONE;
            $this->_userId = $model->id;
            $this->_home = $model->role;
            $this->resetAttempt($userIp);
            return true;
        }
        return false;
    }

    public function getId()
    {
        return $this->_userId;
    }

    public function getHomeController()
    {
        return $this->_home;
    }

}