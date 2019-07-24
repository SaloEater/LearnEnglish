<?php

namespace common\entities;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sentences_words".
 *
 * @property int $sentence_id
 * @property int $word_id
 *
 * @property Sentence $sentence
 * @property Word $word
 */
class SentencesWords extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sentences_words';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sentence_id', 'word_id'], 'required'],
            [['sentence_id', 'word_id'], 'integer'],
            [['sentence_id', 'word_id'], 'unique', 'targetAttribute' => ['sentence_id', 'word_id']],
            [['sentence_id'], 'exist', 'skipOnError' => false, 'targetClass' => Sentence::className(), 'targetAttribute' => ['sentence_id' => 'id']],
            [['word_id'], 'exist', 'skipOnError' => false, 'targetClass' => Word::className(), 'targetAttribute' => ['word_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sentence_id' => 'Sentence ID',
            'word_id' => 'Word ID',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getSentence()
    {
        return $this->hasOne(Sentence::className(), ['id' => 'sentence_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getWord()
    {
        return $this->hasOne(Word::className(), ['id' => 'word_id']);
    }
}
