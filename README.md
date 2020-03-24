<p>Порядок действий при разворачивании проекта : </p>
<ul>
    <li>php init</li>
    <li>Сменить доступы к базе данных в файле common/config/main-local.php</li>
    <li>composer install</li>
    <li>php yii migrate/up --migrationPath=@yii/rbac/migrations</li>
    <li>php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations</li>
    <li>php yii migrate --migrationPath=@vendor/floor12/yii2-module-files/src/migrations/</li>
    <li>php yii migrate</li>
</ul>

<p>Доступ к админ панеле находится по адресу sitename/admin</p>
<p>логин/пароль : administrator/administrator</p>