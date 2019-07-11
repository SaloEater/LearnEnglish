<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "word".
 *
 * @property int $id
 * @property string $value
 * @property int $count
 * @property int $sentence_id
 *
 * @property SentenceWord[] $sentenceWords
 * @property Sentence[] $sentences
 * @property Sentence $sentence
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
            [['count', 'sentence_id'], 'integer'],
            [['value'], 'string', 'max' => 64],
            [['sentence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sentence::className(), 'targetAttribute' => ['sentence_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'count' => 'Count',
            'sentence_id' => 'Sentence ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentenceWords()
    {
        return $this->hasMany(SentenceWord::className(), ['word_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentences()
    {
        return $this->hasMany(Sentence::className(), ['id' => 'sentence_id'])->viaTable('sentence_word', ['word_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentence()
    {
        return $this->hasOne(Sentence::className(), ['id' => 'sentence_id']);
    }
}
