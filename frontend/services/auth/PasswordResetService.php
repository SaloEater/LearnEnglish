<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.07.2019
 * Time: 10:08
 */

namespace frontend\services\auth;

use common\entities\User;
use common\repositories\UserRepository;
use frontend\forms\PasswordResetRequestForm;
use http\Exception\RuntimeException;
use Yii;

class PasswordResetService
{
    private $users;
    public function __construct()
    {
        $this->users = new UserRepository();
    }

    public function request(PasswordResetRequestForm $form)
    {
        /* @var $user User */
        $user = $this->users->getByEmail($form->email);

        $user->generatePasswordResetToken();
        $this->users->save($user);

        $sent = \Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($form->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new RuntimeException('Sending error');
        }
    }

    public function validateToken($token)
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!$this->users->existsByPasswordToken($token)) {
            throw new \DomainException('Wrong password reset token.');
        }
    }

    public function reset($token, $form)
    {
        /* @var $user User*/
        $user = $this->users->getByPasswordToken($token);
        $user->resetPassword($form->password);

        $this->users->save($user);
    }
}