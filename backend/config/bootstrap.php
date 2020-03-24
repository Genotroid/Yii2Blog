<?php
//Шаблон для инструментальной панели tinymce
Yii::$container->set('dosamigos\tinymce\TinyMce', [
    'language' => 'ru',
    'clientOptions' => [
        'height' => '414',
        'plugins' => [
            'advlist autolink lists link charmap hr preview pagebreak',
            'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
            'save insertdatetime media table contextmenu template paste image responsivefilemanager filemanager',
        ],
        'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager link image',
        'external_filemanager_path' => '/admin/plugins/responsivefilemanager/filemanager/',
        'filemanager_title' => 'Менеджер файлов',
        'external_plugins' => [
            'filemanager' => '/admin/plugins/responsivefilemanager/filemanager/plugin.min.js',
            'responsivefilemanager' => '/admin/plugins/responsivefilemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
        ],
        'relative_urls' => false,
    ]
]);