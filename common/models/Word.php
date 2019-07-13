<?php

namespace common\models;

use Yii;
use yii\httpclient\Client;

/**
 * This is the model class for table "word".
 *
 * @property int $id
 * @property string $content
 * @property int $count
 *
 * @property Forms[] $forms
 * @property SentencesWords[] $sentencesWords
 * @property Sentence[] $sentences
 */
class Word extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count'], 'integer'],
            [['content'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForms()
    {
        return $this->hasMany(Forms::className(), ['word_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentencesWords()
    {
        return $this->hasMany(SentencesWords::className(), ['word_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentences()
    {
        return $this->hasMany(Sentence::className(), ['id' => 'sentence_id'])->viaTable('sentences_words', ['word_id' => 'id']);
    }

    function lemma($word)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('http://paraphraser.ru/api')
            ->setData([
                'token' => '85f2fbd3f9fef2e1b4595f451490dbc010de50d1',
                'c' => 'vector',
                'query' => $word,
                'top' => 1,
                'lang' => 'en',
                'forms' => 0,
                'scores' => 0,
                'format' => 'json'
            ])
            ->send();
        if ($response->isOk) {
            $data = $response->data;
            $lemma = $data['response'][1]['lemma'];
            if ($word == $lemma){
                return true;
            } else return $lemma;
        } else return false;
    }
}
