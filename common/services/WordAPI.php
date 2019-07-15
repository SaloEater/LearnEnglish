<?php

namespace common\services;

use yii\httpclient\Client;

class WordAPI
{
    /**
     * @param string $word
     * @return array|bool
     * @throws \yii\base\InvalidConfigException
     */
    public function IsForm(string $word)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('https://dictionary.yandex.net/api/v1/dicservice.json/lookup')
            ->setData([
                'key' => 'dict.1.1.20190712T151839Z.8f981db4806b17e7.409da4b528ace844fa4b498c92c989b160edcd29',
                'lang' => 'en-ru',
                'flags' => 4,
                'text' => $word,
            ])
            ->send();
        if ($response->isOk) {
            $data = $response->data;
            $result = array();
            foreach ($data['def'] as $arr) {
                if (isset($arr['tr'][0]['text']) && isset($arr['tr'][0]['pos'])) {
                    $result[$arr['text']][] = ['tr' => $arr['tr'][0]['text'], 'type' => $arr['tr'][0]['pos']];
                }
            }
            return $result;
        } else return false;
    }
}