<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "translation".
 *
 * @property int $id
 * @property string $content
 * @property string $type
 * @property int $sort
 * @property int $word_id
 *
 * @property Word $word
 */
class Translation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'translation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'word_id'], 'integer'],
            [['content', 'type'], 'string', 'max' => 64],
            [['word_id'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['word_id' => 'id']],
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
            'type' => 'Type',
            'sort' => 'Sort',
            'word_id' => 'Word ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWord()
    {
        return $this->hasOne(Word::className(), ['id' => 'word_id']);
    }
}
