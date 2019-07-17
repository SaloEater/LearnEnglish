<?php

namespace common\tests\unit\forms;
use Codeception\AssertThrows;
use PHPUnit\Framework\AssertionFailedError;
use common\fixtures\UserFixture;
use common\forms\LoginForm;
use common\services\AuthService;
use Yii;

/**
 * Login form test
 */
class LoginFormTest extends \Codeception\Test\Unit
{
    use AssertThrows;

    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function testLoginNoUser()
    {
        $form = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        $this->assertThrows(\DomainException::class, function() use ($form){
            (new AuthService())->auth($form);
        });
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $form = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'wrong_password',
        ]);

        $this->assertThrows(\DomainException::class, function() use ($form){
            (new AuthService())->auth($form);
        });
        expect('error message should be set', $form->errors)->hasKey('password');
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginCorrect()
    {
        $form = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'password_0',
        ]);

        $user = (new AuthService())->auth($form);
        expect('error message should not be set', $form->errors)->hasntKey('password');
        expect('user should be logged in', Yii::$app->user->isGuest)->false();
    }
}
