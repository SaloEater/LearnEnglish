<?php

namespace common\helpers\word;

class WordHelper
{
    public static $punctuationMarks = '.?!,:-;/\\*+(){}[]\"\'<>@#$%^&*№_=|';

    public static function isPunctuationMark(string $content)
    {
        if (strlen($content) > 1) {
            return false;
        }

        if (!substr_count(self::$punctuationMarks, $content)) {
            return false;
        }

        return true;
    }
}