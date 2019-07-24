<?php
namespace frontend\tests\unit\models;

use Codeception\AssertThrows;
use Codeception\Test\Unit;
use common\fixtures\UserFixture as UserFixture;
use frontend\forms\ContactForm;
use frontend\services\contact\ContactService;
use frontend\tests\UnitTester;
use RuntimeException;
use yii\mail\MessageInterface;

class ContactFormTest extends Unit
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

    use AssertThrows;

    public function testSendEmail()
    {
        $form = new ContactForm();

        $form->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
        ];

        $this->assertNotThrows(RuntimeException::class, function() use ($form) {
            (new ContactService())->sendEmail($form);
        });

        // using Yii2 module actions to check email was sent
        $this->tester->seeEmailIsSent();

        /** @var MessageInterface  $emailMessage */
        $emailMessage = $this->tester->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        codecept_debug($emailMessage);
        expect($emailMessage->getTo())->hasKey('tester@example.com');
        expect($emailMessage->getFrom())->hasKey('noreply@example.com');
        expect($emailMessage->getReplyTo())->hasKey('tester@example.com');
        expect($emailMessage->getSubject())->equals('very important letter subject');
        expect($emailMessage->toString())->contains('body of current message');
    }
}
