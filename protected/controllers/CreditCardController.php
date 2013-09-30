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
    //public $layout='false';
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
        $modelCreditCard=new CreditCardFormModel();
//      validation with AJAX
       if (isset($_POST['ajax']) && $_POST['ajax']==='credit-card-form')
       {
           echo "TEST";
           echo CActiveForm::validate($modelCreditCard);
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

        $this->renderPartial('creditcard',array('modelCreditCard'=>$modelCreditCard));
    }

    public function actionValidatecc()
    {
        $model = new Order;
        $modelCreditCard = new CreditCardFormModel();
        //$model->attributes=$_POST;
        $modelCreditCard->scenario = 'validatecc';
/*//      validation with AJAX
        if(isset($_POST['ajax']) && $_POST['ajax']==='credit-card-form')
        {
            //$validationResult=CActiveForm::validate($model);
            echo CActiveForm::validate($modelCreditCard);
            Yii::app()->end();
        }*/

// validation without AJAX
       if ( isset($_POST['CreditCardFormModel']))
       {
           $modelCreditCard->attributes=$_POST['CreditCardFormModel'];
           if ($modelCreditCard->validate())
           {
               echo "Credit Card Info Correct";
           }
       }
        //$this->render('creditcard',array('modelCreditCard'=>$modelCreditCard));
        $this->render('/order/create', array('model' => $model, 'modelCreditCard' => $modelCreditCard,));
        //$this->renderPartial('/order/cardInfo',array('modelCreditCard'=>$modelCreditCard));
    }

}
