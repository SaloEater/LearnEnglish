<?php
namespace common\repositories;
use common\entities\Word;
use common\repositories\IRepository;
use phpDocumentor\Reflection\Types\Integer;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class WordRepository extends IRepository
{
    public function __construct()
    {
        $this->type = new Word();
    }

    /**
     * @param string $content
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByContent(string $content)
    {
        $form = $this->getBy([
            'content' => $content
        ]);

        return $form;
    }

    public function countWordsBeforeUs($count)
    {
        return (new Query())
            ->from('word')
            ->where(['>', 'count', $count])
            ->count();
    }

    public function countWordsOnLevel($count)
    {
        return (new Query())
            ->select('*')
            ->from('word')
            ->where(['count' => $count])
            ->all();
    }
}