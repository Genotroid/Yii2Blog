<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $article_id
 * @property string $text
 * @property int $created_at
 * @property int $created_by
 *
 * @property Article $article
 */
class Comment extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            //Поведение для работы с датой создания
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ]
            ],
            //Поведение для работы с автором
            'editor' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'created_by'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'text'], 'required'],
            [['article_id', 'created_at', 'created_by'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Статья',
            'text' => 'Текст комментария',
            'created_at' => 'Дата',
            'created_by' => 'Автор',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    //Возвращает объект User, который оставил комментарий
    public function getEditor()
    {
        return $this->hasOne(\dektrium\user\models\User::class, ['id' => 'created_by']);
    }
}
