<?php

namespace frontend\tests\unit\models;


use Codeception\AssertThrows;
use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\forms\ResendVerificationEmailForm;
use frontend\services\auth\SignupService;

class ResendVerificationEmailFormTest extends Unit
{
    use AssertThrows;
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
            ]
        ]);
    }

    public function testWrongEmailAddress()
    {
        $model = new ResendVerificationEmailForm();
        $model->attributes = [
            'email' => 'aaa@bbb.cc'
        ];

        expect($model->validate())->false();
        expect($model->hasErrors())->true();
        expect($model->getFirstError('email'))->equals('There is no user with this email address.');
    }

    public function testEmptyEmailAddress()
    {
        $model = new ResendVerificationEmailForm();
        $model->attributes = [
            'email' => ''
        ];

        expect($model->validate())->false();
        expect($model->hasErrors())->true();
        expect($model->getFirstError('email'))->equals('Email cannot be blank.');
    }

    public function testResendToActiveUser()
    {
        $model = new ResendVerificationEmailForm();
        $model->attributes = [
            'email' => 'test2@mail.com'
        ];

        expect($model->validate())->false();
        expect($model->hasErrors())->true();
        expect($model->getFirstError('email'))->equals('There is no user with this email address.');
    }

    public function testSuccessfullyResend()
    {
        $form = new ResendVerificationEmailForm();
        $form->attributes = [
            'email' => 'test@mail.com'
        ];

        expect($form->validate())->true();
        expect($form->hasErrors())->false();

        $this->assertNotThrows(\DomainException::class, function() use ($form) {
            (new SignupService())->resendRequest($form);
        });
        $this->tester->seeEmailIsSent();

        $mail = $this->tester->grabLastSentEmail();

        expect('valid email is sent', $mail)->isInstanceOf('yii\mail\MessageInterface');
        expect($mail->getTo())->hasKey('test@mail.com');
        expect($mail->getFrom())->hasKey(\Yii::$app->params['supportEmail']);
        expect($mail->getSubject())->equals('Account registration at ' . \Yii::$app->name);
        expect($mail->toString())->contains('4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330');
    }
}
