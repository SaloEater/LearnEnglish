<?php


namespace common\widgets\translatable;


use common\entities\Text;
use common\repositories\TextRepository;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class TranslatableTextWidget extends Widget
{
    /* @var $text Text*/
    public $text;

    /* @var $textId int$*/
    public $textId;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if (!$this->text) {
            $this->text = Yii::createObject(TextRepository::class)->getById($this->textId);
        }
    }

    public function run()
    {
        $text = '';
        foreach ($this->text->sentences as $sentence ) {
            $text .= TranslatableSentenceWidget::widget([
                'sentence' => $sentence
            ]);
        }

        return Html::tag('div', $text, [
            'class' => 'translatable-text'
        ]);
    }
}