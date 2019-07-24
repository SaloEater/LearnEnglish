<?php

use common\fixtures\SentenceFixture;
use common\fixtures\SentencesWordsFixture;
use common\fixtures\TextFixture;
use common\fixtures\UserFixture;
use common\fixtures\UsersWordsFixture;
use common\fixtures\WordFixture;
use frontend\tests\FunctionalTester;

class IndexCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
            'text' => [
                'class' => TextFixture::class,
                'dataFile' => codecept_data_dir() . 'text_data.php'
            ],
            'sentence' => [
                'class' => SentenceFixture::class,
                'dataFile' => codecept_data_dir() . 'sentence_data.php'
            ],
            'word' => [
                'class' => WordFixture::class,
                'dataFile' => codecept_data_dir() . 'word_data.php'
            ],
            'users_words' => [
                'class' => UsersWordsFixture::class,
                'dataFile' => codecept_data_dir() . 'users_words_data.php'
            ],
            'sentences_words' => [
                'class' => SentencesWordsFixture::class,
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