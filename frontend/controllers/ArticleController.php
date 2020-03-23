<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\Comment;
use frontend\widgets\comments\AddComment;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ArticleController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays articles.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $articles = Article::find()->where(['status' => Article::STATUS_PUBLISHED])->all();

        return $this->render('index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Displays founded article from slug.
     *
     * @return mixed
     */
    public function actionView($slug){
        if ($slug === null) {
            return Url::to(['index']);
        }

        $model = Article::find()
            ->where(['status' => Article::STATUS_PUBLISHED])
            ->andWhere(['slug' => $slug])
            ->one();

        $comments = $model->comments;

        if ($model === null) {
            throw new NotFoundHttpException('Такой статьи не существует.');
        }

        return $this->render('view', [
            'model' => $model,
            'comments' => $comments,
        ]);
    }

}