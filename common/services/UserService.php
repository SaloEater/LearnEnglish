<?php


namespace common\services;


use Yii;

class UserService
{
    public function sendEmail($user)
    {
        $mailer = Yii::$app->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Account registration at ' . Yii::$app->name);

        if (!$mailer->send()) {
            throw new \DomainException("Can't send email to user");
        }
    }
}