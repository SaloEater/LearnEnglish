<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "word".
 *
 * @property int $id
 * @property string $content
 * @property int $count
 *
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
}
