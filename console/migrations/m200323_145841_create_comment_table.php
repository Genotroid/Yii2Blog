<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m200323_145841_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(11)->notNull(),
            'text' => $this->string(255)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'created_by' => $this->integer(11)->notNull(),
        ]);

        $this->createIndex(
            'idx-comment-article_id',
            'comment',
            'article_id'
        );

        $this->addForeignKey(
            'fk-comment-article_id',
            'comment',
            'article_id',
            'article',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-comment-article_id',
            'comment'
        );

        $this->dropIndex(
            'idx-comment-article_id',
            'comment'
        );

        $this->dropTable('{{%comment}}');
    }
}
