<?php

namespace frontend\tests\unit\models;

use Codeception\AssertThrows;
use common\entities\User;
use common\fixtures\UserFixture;
use common\repositories\NotFoundException;
use common\repositories\UserRepository;
use frontend\forms\VerifyEmailForm;
use frontend\services\auth\SignupService;

class VerifyEmailFormTest extends \Codeception\Test\Unit
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

    public function testVerifyWrongToken()
    {
        $this->assertThrows(NotFoundException::class, function() {
            (new SignupService())->confirm('');
        });

        $this->assertThrows(NotFoundException::class, function() {
            (new SignupService())->confirm('notexistingtoken_1391882543');
        });
    }

    public function testAlreadyActivatedToken()
    {
        $this->tester->expectException(\DomainException::class, function() {
            (new SignupService())->confirm('already_used_token_1548675330');
        });
    }

    public function testVerifyCorrectToken()
    {
        $fix = $this->tester->grabFixture('user', 2);
        $form = new VerifyEmailForm(['token' => $fix->verification_token]);

        $this->assertNotThrows(\DomainException::class, function() use ($form) {
            (new SignupService())->confirm($form->token);
        });
        $user = (new UserRepository())->getByUsername($fix->username);
        expect($user)->isInstanceOf('common\entities\User');

        expect($user->username)->equals('test.test');
        expect($user->email)->equals('test@mail.com');
        expect($user->status)->equals(\common\entities\User::STATUS_ACTIVE);
        expect($user->validatePassword('Test1234'))->true();
    }
}
