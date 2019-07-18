<?php

use frontend\tests\FunctionalTester;

class IndexCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => \common\fixtures\UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
            'text' => [
                'class' => \common\fixtures\TextFixture::class,
                'dataFile' => codecept_data_dir() . 'text_data.php'
            ],
            'sentence' => [
                'class' => \common\fixtures\SentenceFixture::class,
                'dataFile' => codecept_data_dir() . 'sentence_data.php'
            ],
            'word' => [
                'class' => \common\fixtures\WordFixture::class,
                'dataFile' => codecept_data_dir() . 'word_data.php'
            ],
            'users_words' => [
                'class' => \common\fixtures\UsersWordsFixture::class,
                'dataFile' => codecept_data_dir() . 'users_words_data.php'
            ],
            'sentences_words' => [
                'class' => \common\fixtures\SentencesWordsFixture::class,
                'dataFile' => codecept_data_dir() . 'sentences_words_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->submitForm('form#login-form', [
           'LoginForm[username]' => 'erau',
           'LoginForm[password]' => 'password_0',
        ]);
    }

    public function checkView(FunctionalTester $I)
    {
        $I->amOnRoute('/word/index');

        $I->seeInCurrentUrl('/word/');

        $I->see('blah');
    }
}