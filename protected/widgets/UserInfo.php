<?php

class UserInfo extends CWidget
{

    public function run()
    {

        $user_id =  $id=Yii::app()->user->id;
        $model=User::model()->findByPk($user_id);
        $this->render('user_info',array('model'=>$model,'user_id'=>$user_id));
    }
}