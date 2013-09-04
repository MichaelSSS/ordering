<?php
/**
*
*/
class RbWebApplication extends CWebApplication
{
    /**
    * Сохран. в базе время, если пользователь не гость и активен
    */
    public function beforeControllerAction($controller,$action)
    {
        if ( !Yii::app()->user->isGuest ) {
            $model = User::model()->find('LOWER(username)=?',array(strtolower(Yii::app()->user->name)));
            $currentTime = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
            if ( $currentTime - $model->lastActionTime < Yii::app()->params['secondsBeforeDisactivate']*60 ) {
                $model->lastActionTime = $currentTime;
                $model->update(array('lastActionTime'));
            }
        }
        return true;
    }
}