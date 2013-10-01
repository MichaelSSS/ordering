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
            'cvv2_code'=>'CVV2 Code',
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
            array('credit_card_type','required','message'=>'Please select Credit Card Type','on'=>'validateCardInfo'),
            array('credit_card_number','required','message'=>'Please enter Credit Card Number','on'=>'validateCardInfo'),
            array('credit_card_number','match','pattern'=>'/^[0-9]{16}$/','message'=>'Incorrect CC format','on'=>'validateCardInfo'),
            array('cvv2_code','required','message'=>'Please enter CVV2 Code','on'=>'validateCardInfo'),
            array('expiry_date','required','message'=>'Please enter Expiry Date','on'=>'validateCardInfo')
        );
    }

 }
