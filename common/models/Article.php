<?php

namespace common\models;

use floor12\files\components\FileBehaviour;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 *
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ],
            'published' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['published_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['published_at']

                ],
                'value' => static function($event) {
                    /** @var Article $model */
                    $model = $event->sender;
                    if ($model->published_at !== null) {
                        return $model->published_at;
                    }
                    if ($model->status == Article::STATUS_PUBLISHED) {
                        return time();
                    }

                    return null;
                }

            ],
            'editor' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by'
            ],
            'files' => [
                'class' => FileBehaviour::class,
                'attributes' => [
                    'main_pic',
                ]
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true
            ],
        ];
    }

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED  = 1;
    const STATUS_DELETED   = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['main_pic', 'file', 'extensions' => ['jpg', 'png', 'jpeg', 'gif'], 'maxFiles' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'content' => 'Контент',
            'created_at' => 'Дата',
            'updated_at' => 'Обновлена',
            'created_by' => 'Автор',
            'updated_by' => 'Редактор',
            'status' => 'Статус',
            'main_pic' => 'Изображение',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT => 'Черновик',
            self::STATUS_PUBLISHED => 'Опубликована',
            self::STATUS_DELETED => 'Удалена',
        ];
    }

    public function getIsPublished()
    {
        return $this->status === self::STATUS_PUBLISHED;
    }
}
