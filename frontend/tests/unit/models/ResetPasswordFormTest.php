<?php

namespace frontend\tests\unit\models;

use common\fixtures\UserFixture;
use frontend\forms\ResetPasswordForm;
use frontend\services\auth\PasswordResetService;

class ResetPasswordFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
        ]);
    }

    public function testResetWrongToken()
    {
        $this->tester->expectException(\DomainException::class, function() {
            (new PasswordResetService())->validateToken('');
        });

        $this->tester->expectException(\DomainException::class, function() {
            (new PasswordResetService())->validateToken('notexistingtoken_1391882543');
        });
    }

    public function testResetCorrectToken()
    {
        $user = $this->tester->grabFixture('user', 3);
        (new PasswordResetService())->validateToken($user['password_reset_token']);
    }

}
