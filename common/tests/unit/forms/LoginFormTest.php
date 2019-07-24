<?php

namespace common\tests\unit\forms;
use Codeception\AssertThrows;
use Codeception\Test\Unit;
use common\repositories\NotFoundException;
use common\tests\UnitTester;
use DomainException;
use PHPUnit\Framework\AssertionFailedError;
use common\fixtures\UserFixture;
use common\forms\LoginForm;
use common\services\AuthService;
use Yii;

/**
 * Login form test
 */
class LoginFormTest extends Unit
{
    use AssertThrows;

    /**
     * @var UnitTester
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

        $this->assertThrows(NotFoundException::class, function() use ($form){
            Yii::createObject(AuthService::class)->auth($form);
        });
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $form = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'wrong_password',
        ]);

        $this->assertThrows(DomainException::class, function() use ($form){
            Yii::createObject(AuthService::class)->auth($form);
        });
    }

    public function testLoginCorrect()
    {
        $form = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'password_0',
        ]);

        $this->assertNotThrows(DomainException::class, function() use ($form){
            Yii::createObject(AuthService::class)->auth($form);
        });
    }
}
