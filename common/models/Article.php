<?php

namespace common\models;

use floor12\files\components\FileBehaviour;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
            //Поведение для работы с датой создания
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ],
            //Поведение для работы с датой публикации статьи
            'published' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['created_at']

                ],
                'value' => static function($event) {
                    /** @var Article $model */
                    $model = $event->sender;
                    if ($model->created_at !== null) {
                        return $model->created_at;
                    }
                    if ($model->status == Article::STATUS_PUBLISHED) {
                        return time();
                    }

                    return null;
                }

            ],
            //Поведение для работы с автором
            'editor' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by'
            ],
            //Поведение для работы с изобрадением статьи
            'files' => [
                'class' => FileBehaviour::class,
                'attributes' => [
                    'main_pic',
                ]
            ],
            //Поведение для генерации ссылки для статьи
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
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
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

    public function getEditor()
    {
        return $this->hasOne(\dektrium\user\models\User::class, ['id' => 'updated_by']);
    }

    public static function getEditorsMap()
    {
        $adminIds = \Yii::$app->authManager->getUserIdsByRole('admin');
        $moderIds = \Yii::$app->authManager->getUserIdsByRole('author');
        if ($users = \dektrium\user\models\User::find()->where(['id' => ArrayHelper::merge($adminIds, $moderIds)])->all()) {
            return ArrayHelper::map($users, 'id', 'username');
        }

        return [];
    }

    public function getStatusText()
    {
        $statuses = self::getStatuses();

        return $statuses[$this->status];
    }
}
