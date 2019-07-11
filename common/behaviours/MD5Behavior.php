<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 11.07.2019
 * Time: 23:15
 */
namespace yii\behaviors;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\BaseActiveRecord;
use yii\helpers\ArrayHelper;

class MD5Behavior
{
    /**
     * @var string the attribute that will receive md5 value
     */
    public $md5Attribute = 'md5';

    /**
     * @var string|array|null the attribute whose value will be converted into a md5
     */
    public $attribute = 'text';
    /**
     * {@inheritdoc}
     *
     * In case, when the value is `null`, the result of the PHP function [md5()](https://www.php.net/manual/en/function.md5.php)
     * will be used as value.
     */
    public $value;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->md5Attribute],
                BaseActiveRecord::EVENT_AFTER_UPDATE => [$this->md5Attribute],
            ];
        }

        if ($this->attribute === null ) {
            throw new InvalidConfigException('"attribute" property must be specified.');
        }

    }

    /**
     * {@inheritdoc}
     *
     * In case, when the [[value]] is `null`, the result of the PHP function [time()](https://secure.php.net/manual/en/function.time.php)
     * will be used as value.
     */
    protected function getValue($event)
    {
        if ($this->value === null) {
            $text = ArrayHelper::getValue($this->owner, $this->attribute);
            return md5($text);
        }

        return parent::getValue($event);
    }
}