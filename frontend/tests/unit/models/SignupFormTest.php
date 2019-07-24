<?php
namespace frontend\tests\unit\models;

use Codeception\Test\Unit;
use common\entities\User;
use common\fixtures\UserFixture;
use common\repositories\UserRepository;
use common\services\AuthService;
use frontend\forms\SignupForm;
use frontend\services\auth\SignupService;
use frontend\tests\UnitTester;
use Yii;

class SignupFormTest extends Unit
{
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

    public function testCorrectSignup()
    {
        $form = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);

        (new SignupService())->signup($form);
        $user = Yii::createObject(UserRepository::class)->getByUsername($form->username);
        expect($user)->notNull();

        /** @var User $user */
        $user = $this->tester->grabRecord('common\entities\User', [
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'status' => User::STATUS_WAIT
        ]);

        $this->tester->seeEmailIsSent();

        $mail = $this->tester->grabLastSentEmail();

        expect($mail)->isInstanceOf('yii\mail\MessageInterface');
        expect($mail->getTo())->hasKey('some_email@example.com');
        expect($mail->getFrom())->hasKey(Yii::$app->params['supportEmail']);
        expect($mail->getSubject())->equals('Account registration at ' . Yii::$app->name);
        expect($mail->toString())->contains($user->verification_token);
    }

    public function testNotCorrectSignup()
    {
        $form = new SignupForm([
            'username' => 'troy.becker',
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
        ]);

        expect_not($form->validate());
        expect_that($form->getErrors('username'));
        expect_that($form->getErrors('email'));

        expect($form->getFirstError('username'))
            ->equals('This username has already been taken.');
        expect($form->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }
}
