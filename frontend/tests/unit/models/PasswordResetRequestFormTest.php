<?php

namespace frontend\tests\unit\models;

use Codeception\AssertThrows;
use Codeception\Test\Unit;
use common\entities\User;
use common\fixtures\UserFixture as UserFixture;
use common\repositories\NotFoundException;
use common\services\AuthService;
use DomainException;
use frontend\forms\PasswordResetRequestForm;
use frontend\services\auth\PasswordResetService;
use frontend\tests\UnitTester;
use Yii;

class PasswordResetRequestFormTest extends Unit
{
    use AssertThrows;

    /**
     * @var UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testSendMessageWithWrongEmailAddress()
    {
        $form = new PasswordResetRequestForm();
        $form->email = 'not-existing-email@example.com';
        $this->assertThrowsWithMessage(NotFoundException::class, 'common\entities\User is not found', function() use ($form) {
            (new PasswordResetService())->request($form);
        });
    }

    public function testNotSendEmailsToWaitUser()
    {
        /**
         * @var $user User
         */
        $user = $this->tester->grabFixture('user', 1);
        $form = new PasswordResetRequestForm();
        $form->email = $user->email;
        $this->assertThrowsWithMessage(DomainException::class, 'User has not confirmed email',function() use ($form) {
            (new PasswordResetService())->request($form);
        });
    }

    public function testSendEmailSuccessfully()
    {
        $userFixture = $this->tester->grabFixture('user', 0);

        $form = new PasswordResetRequestForm();
        $form->email =$userFixture['email'];

        $user = User::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        (new PasswordResetService())->request($form);
        /*$this->assertNotThrows(\DomainException::class, function() use ($form) {

        });*/
        expect_not($user->password_reset_token);

        $emailMessage = $this->tester->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey($form->email);
        expect($emailMessage->getFrom())->hasKey(Yii::$app->params['supportEmail']);
    }
}
