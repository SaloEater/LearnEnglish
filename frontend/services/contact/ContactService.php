<?php
namespace frontend\services\contact;
use Yii;

/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17.07.2019
 * Time: 10:24
 */

class ContactService
{
    public function sendEmail(\frontend\forms\ContactForm $form)
    {
        $sent = Yii::$app->mailer->compose()
            ->setTo($form->email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$form->email => $form->name])
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$sent) {
            throw new \http\Exception\RuntimeException('Sending error');
        }
    }
}