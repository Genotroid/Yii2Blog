<?php

use yii\db\Migration;

/**
 * Class m200323_145059_add_admin_and_roles
 */
class m200323_145059_add_admin_and_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Роль для автора, может добавлять и редактировать статьи
        $this->insert('auth_item', [
            'name' => 'author',
            'type' => 1,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        //Роль для админа, может все
        $this->insert('auth_item', [
            'name' => 'admin',
            'type' => 1,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        //Добавление пользователя с доступами administrator/administrator, необходим для тестирования
        $this->insert('user', [
            'id' => 1,
            'username' => 'administrator',
            'email' => 'admin@admin.com',
            'password_hash' => '$2y$10$5wDxUa2kDgTWDyJYVQrEKOFthUlAjR/ffxJ6o8trG1VTNuT.21BWG',
            'auth_key' => 'KctHxMNHqXe-am9kRK8eLGMlpvb6BLfn',
            'confirmed_at' => time(),
            'created_at' => time(),
            'updated_at' => time()
        ]);

        //Связываем пользователя administrator и роль admin
        $this->insert('auth_assignment', [
            'item_name' => 'admin',
            'user_id' => 1,
            'created_at' => time()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('auth_item', [
            'name' => 'author'
        ]);

        $this->delete('auth_item', [
            'name' => 'admin'
        ]);

        $this->delete('user', [
            'id' => 1
        ]);

    }
}
