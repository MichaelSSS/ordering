<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ybakshy
 * Date: 9/11/13
 * Time: 5:54 PM
 * To change this template use File | Settings | File Templates.
 */

class CreditCardFormModel extends CFormModel
{
    public $credit_card_type;
    public $credit_card_number;
    public $cvv2_code;
    public $expiry_date;
    public $start_date;
    public $issue_number;
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'credit_card_type'=>'Credit Card Type',
            'cvv2_code'=>"CVV2 Code (<a href='' id ='CreditCardFormModel_cvv2_code_tip'>What is this?</a>)",
            'start_date'=>'Start Date (Maestro only)',
            'issue_number'=>'Issue Number (Maestro only)'
        );
    }
    /*
     * Declares the validation rules.
     * CC type, CC number, CVV2, Expiry Date, Start Date (Maestro only) are mandatory
     */
    public function rules()
    {
        return array (
            array('credit_card_type','required','message'=>'Please select Credit Card Type','on'=>'validateCardInfo, validateMaestroCardInfo, required'),
            array('credit_card_number','required','message'=>'Please enter Credit Card Number','on'=>'validateCardInfo, validateMaestroCardInfo, required'),
            array('credit_card_number','match','pattern'=>'/^[0-9]{16}$/','message'=>'Credit Card Number is incorrect. Please re-type it again.','on'=>'validateCardInfo, validateMaestroCardInfo'),
            array('cvv2_code','required','message'=>'Please enter CVV2 Code','on'=>'validateCardInfo, validateMaestroCardInfo, required'),
            array('cvv2_code','match','pattern'=>'/^[0-9]{3}$/','message'=>'CVV2 Code is incorrect. Please re-type it again.','on'=>'validateCardInfo, validateMaestroCardInfo'),
            array('expiry_date','required','message'=>'Please enter Expiry Date','on'=>'validateCardInfo, validateMaestroCardInfo, required'),
            array('expiry_date, start_date','date', 'format'=>'MM/dd/yyyy', 'message'=>'Incorrect Date Format. Please use mm/dd/yyyy','on'=>'validateCardInfo, validateMaestroCardInfo'),
            array('expiry_date','checkDate', 'on'=>'validateCardInfo, validateMaestroCardInfo'),
            array('start_date','required','message'=>'Please enter Start Date','on'=>'validateCardInfo, validateMaestroCardInfo, required'),
            array('start_date','compare','compareAttribute'=>'expiry_date','operator'=>'<','strict'=>true,'message'=>'Start Date for Maestro card is incorrect.Please re-type it again.', 'on'=>'validateMaestroCardInfo'),
            array('issue_number','match', 'pattern'=>'/^[0-9]{1}$/','allowEmpty'=>true, 'message'=>'Issue Number for Maestro card is incorrect.Please re-type it again.', 'on'=>'validateMaestroCardInfo'),
        );
    }

    public function checkDate($expiry_date)
    {
        $todayDate = date("m/d/Y");
        if (strtotime($todayDate) >= strtotime($this->expiry_date))
        {
            $this->addError($expiry_date, 'Expire Date is incorrect.Please re-type it again.');
        }

        $diff = date_diff(date_create_from_format("m/d/Y",$todayDate),date_create_from_format("m/d/Y",$this->expiry_date));
        if ($diff->format('%r%a') <= '3')
        {
            $this->addError($expiry_date, 'Unfortunately you are not able to pay by this Credit Card, since Expire Date is too fast.');
        }
        return true;
    }

 }
