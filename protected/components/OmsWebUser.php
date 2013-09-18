<?php 
/**
*Override CWebUser to save in cookie only username
*and not to populate session from this cookie
*/
class OmsWebUser extends CWebUser
{

    public $homeController = '';
    public $rememberedName = '';

    protected function restoreFromCookie()
    {

        $app=Yii::app();
        $request=$app->getRequest();
        $cookie=$request->getCookies()->itemAt($this->getStateKeyPrefix());

        if($cookie && !empty($cookie->value) && is_string($cookie->value) && ($data=$app->getSecurityManager()->validateData($cookie->value))!==false)
        {
            $data=@unserialize($data);

            if(is_array($data) && isset($data[0],$data[1],$data[2],$data[3]))
            {
                list($id,$name,$duration,$states)=$data;
                if($this->beforeLogin($id,$states,true))
                {
                    $this->rememberedName = htmlspecialchars($name);
                    if($this->autoRenewCookie)
                    {
                        $this->saveToCookie($duration);
                    }
                    $this->afterLogin(true);
                }
            }
        }

    }
    
    public function getRememberedName()
    {
        $rememberedName = $this->rememberedName;                    //remembered name from cookie
        if (!empty($rememberedName)) {
            return $rememberedName;
        } else {
            $rememberedName = $this->getState('Remembered Name');   //remembered name from session
            if (!empty($rememberedName)) {
                return $this->getState('Remembered Name');
            }
        }
        return '';
         
         
    }

/*    protected function saveToCookie($duration)
    {
        $app=Yii::app();
        $cookie=$this->createIdentityCookie($this->getStateKeyPrefix());
        $cookie->expire=time()+$duration;
        $data=array(
            $this->getId(),
            $this->rememberedName,
            $duration,
            $this->saveIdentityStates(),
        );


        $cookie->value = $app->getSecurityManager()->hashData(serialize($data));
        $app->getRequest()->getCookies()->add($cookie->name,$cookie);
    }
*/

    /**
    *@return true if last action time is fresh, false otherwise
    */
    public function isActive($userId, $currentTime)
    {
        $lastActionTime = $this->getLastActionTime($userId);
        return ($lastActionTime != 0) &&
            ($currentTime - $lastActionTime < Yii::app()->params['secondsBeforeDisactivate']);
    }

    /**
    *@return time() of last action or zero
    */
    public function getLastActionTime($userId)
    {
            $command = Yii::app()->db->createCommand('
                SELECT last_action_time 
                FROM user_login 
                WHERE user_id=?
            ');
            return (int)($command->queryScalar(array(1=>$userId)));

    
    }

    public function updateLastActionTime()
    {
            
        $currentTime = time();
        $affectedRows = 0;
        
        $command = Yii::app()->db->createCommand('
            SELECT id 
            FROM user_login 
            WHERE user_id=?
        ');
        $rowId = $command->queryScalar(array(1=>$this->id));
        if ( $rowId ) {
            $command = Yii::app()->db->createCommand('
                UPDATE user_login 
                SET last_action_time= :currentTime, user_agent= :userAgent
                WHERE user_id= :userId
            ');
            $affectedRows = $command->execute(array(
                'userId'      => $this->id,
                'currentTime' => $currentTime,
                'userAgent'   => $_SERVER['HTTP_USER_AGENT'],
            ));
        } else {                                        //        if ($affectedRows == 0) {

            $command = Yii::app()->db->createCommand('
                INSERT INTO user_login (user_id,last_action_time,user_agent) 
                VALUE (:userId, :currentTime, :userAgent)
            ');
            $affectedRows = $command->execute(array(
                'userId'      => $this->id,
                'currentTime' => $currentTime,
                'userAgent'   => $_SERVER['HTTP_USER_AGENT'],
            ));
        }

        return $affectedRows;
    }

    public function countActive($currentTime)
    {
            $command = Yii::app()->db->createCommand('
                SELECT COUNT(*)
                FROM user_login 
                WHERE last_action_time>?
            ');
            return $command->queryScalar(array(
                1 => $currentTime - Yii::app()->params['secondsBeforeDisactivate']
            ));
    
    }

    public function isSameUserAgent($userId)
    {
            $command = Yii::app()->db->createCommand('
                SELECT user_agent
                FROM user_login 
                WHERE user_id=?
            ');
            
            return 0 == strcmp($command->queryScalar(array(1=>$userId)), $_SERVER['HTTP_USER_AGENT']);
    }

    public function makeUnActive()
    {
            
        $command = Yii::app()->db->createCommand('
            UPDATE user_login 
            SET last_action_time= :oldTime
            WHERE (user_id= :userId) AND (user_agent= :userAgent)
        ');
        return $command->execute(array(
            'userId'  => $this->id,
            'userAgent'   => $_SERVER['HTTP_USER_AGENT'],
            'oldTime' => 1,
        ));
    }

}