<?php

class SupervisorController extends Controller
{
    public $defaultAction = 'index';
    public function filters()
	{
		return array(
			'accessControl',
		);
	}
         
    	public function actionIndex()
	{
            $model = new Item;
            
            $fields = new SupervisorSearchForm('search');

                /***/

       if( isset($_GET['pageSize']) && $model->validatePageSize($_GET['pageSize']) )
            $model->currentPageSize = $_GET['pageSize'];

        if( isset($_GET['SupervisorSearchForm']) ){
            $fields->attributes = $_GET['SupervisorSearchForm'];



            if( $fields->validate() )
                $model->searchCriteria = $fields->getCriteria();

        }                
       /* if ( isset($model->searchCriteria['condition']) ) {
            $model->searchCriteria['condition'] = '(' . $model->searchCriteria['condition'] . ') AND `t`.`deleted`=0';
        } else {
            $model->searchCriteria['condition'] = '`t`.`deleted`=0';

        }*/
        $this->render('supervisor',array('model'=>$model, 'fields'=>$fields));
        }

        
}