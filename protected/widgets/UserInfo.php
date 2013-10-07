<?php
Yii::import('zii.widgets.CWidget');
class UserInfo extends CWidget
{
    public function run()
    {
        $user_id =  $id=Yii::app()->user->id;
        $model=User::model()->findByPk($user_id);
        $this->render('userInfo', array('model' => $model, 'user_id' => $user_id));
    }
}