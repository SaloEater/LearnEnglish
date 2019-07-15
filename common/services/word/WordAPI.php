<?php

namespace common\services\word;

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
                'key' => 'dict.1.1.20190713T082547Z.c2ac59a6f8d8ac1d.c69330f9fb250cbc0d08d24296952c8f6da67758',
                'lang' => 'en-ru',
                'flags' => 4,
                'text' => $word,
            ])
            ->send();
        if ($response->isOk) {
            $data = $response->data;
            $result = array();
            foreach ($data['def'] as $arr) {
                $result[$arr['text']][] = ['tr' => $arr['tr'][0]['text'], 'type' => $arr['tr'][0]['pos']];
            }
            return $result;
        } else return false;
    }
}