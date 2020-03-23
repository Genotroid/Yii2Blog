<?php

use yii\db\Migration;

/**
 * Class m200323_154341_add_slug_article_column
 */
class m200323_154341_add_slug_article_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'slug', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('article', 'slug');
    }
}
