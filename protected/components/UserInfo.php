<?php
class UserInfo extends CAction{
    public function info(){
        $user_id =  $id=Yii::app()->user->id;
        $model=User::model()->findByPk($user_id);

        echo "User name: ". $model->username;
        echo "<br>";
        echo "Role: ".$model->role;
        echo "<br>";

        if($model->role == 'customer'){
            echo 'Customer Type:';
            echo "<br>";
            echo 'Account Balance:';
        }
    }
}