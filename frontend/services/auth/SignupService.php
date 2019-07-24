<?php

namespace frontend\services\auth;

use common\entities\User;
use common\repositories\NotFoundException;
use common\repositories\UserRepository;
use DomainException;
use frontend\forms\ResendVerificationEmailForm;
use frontend\forms\SignupForm;
use http\Exception\RuntimeException;
use Yii;

/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.07.2019
 * Time: 9:58
 */

class SignupService
{
    private $users;
    public function __construct()
    {
        $this->users = Yii::createObject(UserRepository::class);
    }

    /**
     * @param SignupForm $form
     * @return User
     */
    public function signup(SignupForm $form)
    {
        $user = User::signup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->users->save($user);

        $this->sendRequest($user->email);

        return $user;
    }

    public function validateToken($token)
    {
        if (empty($token) || !is_string($token)) {
            throw new DomainException('Verify email token cannot be blank.');
        }

        try {
            $this->users->existsByVerificationToken($token);
        } catch (NotFoundException $e) {
            throw new DomainException('Wrong verify email token.');
        }
    }

    public function confirm($token)
    {
        /* @var $user User*/
        $user = $this->users->getByVerificationToken($token);

        $user->confirmSignup();

        $this->users->save($user);
    }

    public function sendRequest($email)
    {
        /* @var $user User*/
        $user = $this->users->getByEmail($email);

        if (!$user->verification_token) {
            throw new DomainException('Email already confirmed');
        }

        $sent = Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new RuntimeException('Sending error');
        }
    }

    public function resendRequest(ResendVerificationEmailForm $form)
    {
        $this->sendRequest($form->email);

    }
}