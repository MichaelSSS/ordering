<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ybakshy
 * Date: 9/13/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */

class CreditCardController extends Controller
{
    public $layout='false';
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error=Yii::app()->errorHandler->error) {
            if ( Yii::app()->request->isAjaxRequest ) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

   public function actionIndex()
    {
        $model=new CreditCardFormModel();

        if(isset($_POST['ajax']) && $_POST['ajax']==='credit-card-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

/*//      validation without AJAX
        if ( isset($_POST['CreditCardFormModel']))
        {
            $model->attributes=$_POST['CreditCardFormModel'];
            if ($model->validate())
            {
                echo "Credit Card Info Correct";
            }
        }*/

        $this->render('creditcard',array('model'=>$model));
    }

}
