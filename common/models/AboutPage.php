<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "about_page".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 */
class AboutPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Зогловок',
            'content' => 'Контент',
        ];
    }
}
