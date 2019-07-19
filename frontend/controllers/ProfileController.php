<?php


namespace frontend\controllers;


use common\entities\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProfileController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }



    /**
     * User profile
     */
    public function actionIndex()
    {
        $user = User::findOne(Yii::$app->user->id);

        return $this->render('index', [
            'user' => $user
        ]);
    }

    /**
     *
     */
    public function actionEdit()
    {
        $user = User::findOne(Yii::$app->user->id);

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            return $this->redirect('index');
        }

        return $this->render('edit', [
            'user' => $user
        ]);
    }
}