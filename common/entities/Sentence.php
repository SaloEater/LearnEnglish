<?php

namespace common\entities;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sentence".
 *
 * @property int $id
 * @property string $content
 * @property int $text_id
 *
 * @property Text $text
 * @property SentencesWords[] $sentencesWords
 * @property Word[] $words
 */
class Sentence extends ActiveRecord
{

    public function behaviors()
    {
        return
        [

        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sentence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['text_id'], 'integer'],
            [['text_id'], 'exist', 'skipOnError' => true, 'targetClass' => Text::className(), 'targetAttribute' => ['text_id' => 'id']],
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
            'text_id' => 'Text ID',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getText()
    {
        return $this->hasOne(Text::className(), ['id' => 'text_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSentencesWords()
    {
        return $this->hasMany(SentencesWords::className(), ['sentence_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getWords()
    {
        return $this->hasMany(Word::className(), ['id' => 'word_id'])->viaTable('sentences_words', ['sentence_id' => 'id']);
    }
}
