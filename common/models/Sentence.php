<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sentence".
 *
 * @property int $id
 * @property string $text
 * @property int $text_id
 *
 * @property Text $text0
 * @property SentenceWord[] $sentenceWords
 * @property Word[] $words
 * @property Word[] $words0
 */
class Sentence extends \yii\db\ActiveRecord
{
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
            [['text'], 'string'],
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
            'text' => 'Text',
            'text_id' => 'Text ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getText0()
    {
        return $this->hasOne(Text::className(), ['id' => 'text_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentenceWords()
    {
        return $this->hasMany(SentenceWord::className(), ['sentence_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWords()
    {
        return $this->hasMany(Word::className(), ['id' => 'word_id'])->viaTable('sentence_word', ['sentence_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWords0()
    {
        return $this->hasMany(Word::className(), ['sentence_id' => 'id']);
    }
}
