<?php

class LoginFormTest extends CDbTestCase {

    const MESSAGE_USERNAME_EMPTY = 'Please enter user name';
    const MESSAGE_USERNAME_WHITESPACE = 'Login Name cannot contain spaces';    
    const MESSAGE_PASSWORD_EMPTY = 'Please enter password';
    const MESSAGE_USERNAME_INVALID = 'Such user does not exist in the system - please try again';
    const MESSAGE_PASSWORD_INVALID = 'Password is incorrect - please try again';

    public $fixtures = array(
        'user' => ':user',
    );

    public function testValidate()
    {
        $loginForm = new LoginForm;

        // correct credentials
        
        $loginForm->username = 'admin01';
        $loginForm->password = 'aA1!';        
        $this->assertTrue($loginForm->validate());

        // incorrect user name

        $loginForm->username = 'wrong';
        $loginForm->password = 'aA1!';        
        $this->assertFalse($loginForm->validate());
        $this->assertTrue($loginForm->hasErrors('username'));
        $this->assertEquals(
            MESSAGE_USERNAME_INVALID,
            $loginForm->getError('username')
        );
        $this->assertFalse($loginForm->hasErrors('password'));
        
        // incorrect password

        $loginForm->username = 'admin01';
        $loginForm->password = 'wrong';
        $this->assertFalse($loginForm->validate());
        $this->assertFalse($loginForm->hasErrors('username'));        
        $this->assertTrue($loginForm->hasErrors('password'));
        $this->assertEquals(
            MESSAGE_PASSWORD_INVALID,
            $loginForm->getError('password')
        );

        // both incorrect
        
        $loginForm->username = 'wrong';
        $loginForm->password = 'wrong';
        $this->assertFalse($loginForm->validate());
        $this->assertTrue($loginForm->hasErrors('username'));        
        $this->assertTrue($loginForm->hasErrors('password'));

        // empty user name
        
        $loginForm->username = '';
        $loginForm->password = 'aA1!';
        $this->assertFalse($loginForm->validate());
        $this->assertTrue($loginForm->hasErrors('username'));
        $this->assertEquals(
            MESSAGE_USERNAME_EMPTY,
            $loginForm->getError('username')
        );
        $this->assertFalse($loginForm->hasErrors('password'));
        
        // empty password

        $loginForm->username = 'admin01';
        $loginForm->password = '';
        $this->assertFalse($loginForm->validate());
        $this->assertFalse($loginForm->hasErrors('username'));        
        $this->assertTrue($loginForm->hasErrors('password'));
        $this->assertEquals(
            MESSAGE_PASSWORD_EMPTY,
            $loginForm->getError('password')
        );

        // user name with whitespace
        
        // in the middle
        $loginForm->username = 'admin 01';
        $loginForm->password = 'aA1!';
        $this->assertFalse($loginForm->validate());
        $this->assertTrue($loginForm->hasErrors('username'));
        $this->assertEquals(
            MESSAGE_USERNAME_WHITESPACE,
            $loginForm->getError('username')
        );

        // not in the middle
        $loginForm->username = 'admin01 ';
        $loginForm->password = 'aA1!';
        $this->assertTrue($loginForm->validate());

    }    
}
?>
