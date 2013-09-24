<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function logout()
    {
        Yii::app()->user->makeUnActive();
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    protected function beforeAction($action)
    {
        $user = Yii::app()->user;

        if ( !$user->isGuest ) {
            if ( $user->isActive($user->id, time()) 
                    && $user->isSameUserAgent($user->id) 
                    && !Yii::app()->user->getState('blocked')) {
                $user->updateLastActionTime();
            } else {
                // if user's session exists(not guest) but user is already not active, we destroy session
                $this->logout();
            }
        }
        return true;
    }
}