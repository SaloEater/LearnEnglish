<?php

namespace common\service\word;

use yii\httpclient\Client;

class WordAPI
{
    /**
     * @param string $word
     * @return string|bool
     * @throws \yii\base\InvalidConfigException
     */
    public function IsForm(string $word)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('http://paraphraser.ru/api')
            ->setData([
                'token' => '85f2fbd3f9fef2e1b4595f451490dbc010de50d1',
                'c' => 'vector',
                'query' => $word,
                'top' => 1,
                'lang' => 'en',
                'forms' => 0,
                'scores' => 0,
                'format' => 'json'
            ])
            ->send();
        if ($response->isOk) {
            $data = $response->data;
            $lemma = $data['response'][1]['lemma'];
            return $lemma;
        } else return false;
    }
}