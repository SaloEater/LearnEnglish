<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 11.07.2019
 * Time: 21:31
 */

namespace yii\helpers;

use common\models\Sentence;
use common\models\Text;
use common\models\Word;

class TextParser
{
    public static function parse(string $text)
    {
        $textModel = new Text();
        $textModel->text = $text;

        /**
         * @var string[] $sentences
         */
        preg_match_all('([A-Z]{1}[\w\d\s\-\,\;]+[\.\!]{1})', $text, $sentences);

        foreach ($sentences[0] as $_s) {
            $model = new Sentence();
            $model->text = $_s;
            $model->save();
            preg_match_all('(\w+)', $_s, $words);
            foreach ($words[0] as $_w) {
                $word = new Word();
                $word->value = $_w;
                $word->sentence_id = $model->id;
                $word->save();
            }
        }

    }
}

TextParser::parse('Affronting everything discretion men now own did. Still round match we to. Frankness pronounce daughters remainder extensive has but. Happiness cordially one determine concluded fat. Plenty season beyond by hardly giving of. Consulted or acuteness dejection an smallness if. Outward general passage another as it. Very his are come man walk one next. Delighted prevailed supported too not remainder perpetual who furnished. Nay affronting bed: projection; compliment, instrument. ');