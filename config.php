<?php return array (
  'access' => 
  array (
    'captcha' => 
    array (
      'registration' => '0',
    ),
    'registration' => true,
    'table_names' => 
    array (
      'password_histories' => 'password_histories',
      'users' => 'users',
    ),
    'users' => 
    array (
      'confirm_email' => true,
      'change_email' => false,
      'admin_role' => 'administrator',
      'default_role' => 'student',
      'requires_approval' => false,
      'username' => 'email',
      'email_phone' => 'email_phone',
      'single_login' => true,
      'password_expires_days' => '',
      'password_history' => '3',
    ),
    'roles' => 
    array (
      'role_must_contain_permission' => true,
    ),
    'socialite_session_name' => 'socialite_provider',
  ),
  'analytics' => 
  array (
    'google-analytics' => 'UA-XXXXX-X',
  ),
  'app' => 
  array (
    'name' => 'IVORY TRAINING',
    'version' => '4.6',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://courses.test',
    'timezone' => 'UTC',
    'date_format' => 'Y-m-d',
    'date_format_js' => 'yy-mm-dd',
    'locale' => 'ar',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'locale_php' => 'en_US',
    'key' => 'base64:WEc7NjvDhLBU93z+0/i10IqH3VyaDBAeHnvC2cowrWA=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Collective\\Html\\HtmlServiceProvider',
      23 => 'DevDojo\\Chatter\\ChatterServiceProvider',
      24 => 'UniSharp\\LaravelFilemanager\\LaravelFilemanagerServiceProvider',
      25 => 'Intervention\\Image\\ImageServiceProvider',
      26 => 'Yajra\\Datatables\\DatatablesServiceProvider',
      27 => 'Yajra\\DataTables\\DataTablesServiceProvider',
      28 => 'Yajra\\DataTables\\ButtonsServiceProvider',
      29 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      30 => 'Gerardojbaez\\Messenger\\MessengerServiceProvider',
      31 => 'Jenssegers\\Agent\\AgentServiceProvider',
      32 => 'Darryldecode\\Cart\\CartServiceProvider',
      33 => 'ConsoleTVs\\Invoices\\InvoicesServiceProvider',
      34 => 'Harimayco\\Menu\\MenuServiceProvider',
      35 => 'Barryvdh\\TranslationManager\\ManagerServiceProvider',
      36 => 'Barryvdh\\DomPDF\\ServiceProvider',
      37 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      38 => 'Chumper\\Zipper\\ZipperServiceProvider',
      39 => 'BC\\Laravel\\DropboxDriver\\ServiceProvider',
      40 => 'Mtownsend\\ReadTime\\Providers\\ReadTimeServiceProvider',
      41 => 'Milon\\Barcode\\BarcodeServiceProvider',
      42 => 'App\\Providers\\AppServiceProvider',
      43 => 'App\\Providers\\AuthServiceProvider',
      44 => 'App\\Providers\\BladeServiceProvider',
      45 => 'App\\Providers\\ComposerServiceProvider',
      46 => 'App\\Providers\\EventServiceProvider',
      47 => 'App\\Providers\\ObserverServiceProvider',
      48 => 'App\\Providers\\RouteServiceProvider',
      49 => 'App\\Providers\\DropboxServiceProvider',
      50 => 'App\\Providers\\GoogleDriveServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Zipper' => 'Chumper\\Zipper\\Zipper',
      'Active' => 'HieuLe\\Active\\Facades\\Active',
      'Gravatar' => 'Creativeorange\\Gravatar\\Facades\\Gravatar',
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Messenger' => 'Gerardojbaez\\Messenger\\Facades\\Messenger',
      'Agent' => 'Jenssegers\\Agent\\Facades\\Agent',
      'Cart' => 'Darryldecode\\Cart\\Facades\\CartFacade',
      'Menu' => 'Harimayco\\Menu\\Facades\\Menu',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'DNS1D' => 'Milon\\Barcode\\Facades\\DNS1DFacade',
      'DNS2D' => 'Milon\\Barcode\\Facades\\DNS2DFacade',
    ),
    'theme_layout' => 1,
    'font_color' => 'default',
    'layout_type' => 'wide',
    'counter' => 1,
    'total_students' => '1M+',
    'total_courses' => '1k+',
    'total_teachers' => '200+',
    'contact_data' => '{[]}',
    'debug_blacklist' => 
    array (
      '_ENV' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
        2 => 'REDIS_PASSWORD',
        3 => 'MAIL_USERNAME',
        4 => 'MAIL_PASSWORD',
        5 => 'PUSHER_APP_KEY',
        6 => 'PUSHER_APP_SECRET',
      ),
      '_SERVER' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
        2 => 'REDIS_PASSWORD',
        3 => 'MAIL_USERNAME',
        4 => 'MAIL_PASSWORD',
        5 => 'PUSHER_APP_KEY',
        6 => 'PUSHER_APP_SECRET',
      ),
      '_POST' => 
      array (
        0 => 'password',
      ),
    ),
    'display_type' => 'ltr',
    'currency' => 'SAR',
  ),
  'app1' => 
  array (
    'name' => 'Ivory Training',
    'version' => '4.6',
    'env' => 'local',
    'debug' => true,
    'url' => 'e-training.ivorytraining.com',
    'timezone' => 'UTC',
    'date_format' => 'Y-m-d',
    'date_format_js' => 'yy-mm-dd',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'locale_php' => 'en_US',
    'key' => 'base64:WEc7NjvDhLBU93z+0/i10IqH3VyaDBAeHnvC2cowrWA=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Collective\\Html\\HtmlServiceProvider',
      23 => 'DevDojo\\Chatter\\ChatterServiceProvider',
      24 => 'UniSharp\\LaravelFilemanager\\LaravelFilemanagerServiceProvider',
      25 => 'Intervention\\Image\\ImageServiceProvider',
      26 => 'Yajra\\Datatables\\DatatablesServiceProvider',
      27 => 'Yajra\\DataTables\\DataTablesServiceProvider',
      28 => 'Yajra\\DataTables\\ButtonsServiceProvider',
      29 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      30 => 'Gerardojbaez\\Messenger\\MessengerServiceProvider',
      31 => 'Jenssegers\\Agent\\AgentServiceProvider',
      32 => 'Darryldecode\\Cart\\CartServiceProvider',
      33 => 'ConsoleTVs\\Invoices\\InvoicesServiceProvider',
      34 => 'Harimayco\\Menu\\MenuServiceProvider',
      35 => 'Barryvdh\\TranslationManager\\ManagerServiceProvider',
      36 => 'Barryvdh\\DomPDF\\ServiceProvider',
      37 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      38 => 'Chumper\\Zipper\\ZipperServiceProvider',
      39 => 'BC\\Laravel\\DropboxDriver\\ServiceProvider',
      40 => 'Mtownsend\\ReadTime\\Providers\\ReadTimeServiceProvider',
      41 => 'App\\Providers\\AppServiceProvider',
      42 => 'App\\Providers\\AuthServiceProvider',
      43 => 'App\\Providers\\BladeServiceProvider',
      44 => 'App\\Providers\\ComposerServiceProvider',
      45 => 'App\\Providers\\EventServiceProvider',
      46 => 'App\\Providers\\ObserverServiceProvider',
      47 => 'App\\Providers\\RouteServiceProvider',
      48 => 'Milon\\Barcode\\BarcodeServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Zipper' => 'Chumper\\Zipper\\Zipper',
      'DNS1D' => 'Milon\\Barcode\\Facades\\DNS1DFacade',
      'DNS2D' => 'Milon\\Barcode\\Facades\\DNS2DFacade',
      'Active' => 'HieuLe\\Active\\Facades\\Active',
      'Gravatar' => 'Creativeorange\\Gravatar\\Facades\\Gravatar',
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Messenger' => 'Gerardojbaez\\Messenger\\Facades\\Messenger',
      'Agent' => 'Jenssegers\\Agent\\Facades\\Agent',
      'Cart' => 'Darryldecode\\Cart\\Facades\\CartFacade',
      'Menu' => 'Harimayco\\Menu\\Facades\\Menu',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
    'theme_layout' => 1,
    'font_color' => 'default',
    'layout_type' => 'wide',
    'counter' => 1,
    'total_students' => '1M+',
    'total_courses' => '1k+',
    'total_teachers' => '200+',
    'contact_data' => '{[]}',
    'debug_blacklist' => 
    array (
      '_ENV' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
        2 => 'REDIS_PASSWORD',
        3 => 'MAIL_USERNAME',
        4 => 'MAIL_PASSWORD',
        5 => 'PUSHER_APP_KEY',
        6 => 'PUSHER_APP_SECRET',
      ),
      '_SERVER' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
        2 => 'REDIS_PASSWORD',
        3 => 'MAIL_USERNAME',
        4 => 'MAIL_PASSWORD',
        5 => 'PUSHER_APP_KEY',
        6 => 'PUSHER_APP_SECRET',
      ),
      '_POST' => 
      array (
        0 => 'password',
      ),
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'passport',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\Auth\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'backend' => 
  array (
    'body_classes' => 'app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show',
  ),
  'backup' => 
  array (
    'backup' => 
    array (
      'status' => 0,
      'name' => '',
      'source' => 
      array (
        'files' => 
        array (
          'include' => 
          array (
            0 => '/home1/ivorytr1/public_html/e-training',
          ),
          'exclude' => 
          array (
            0 => '/home1/ivorytr1/public_html/e-training/vendor',
          ),
          'follow_links' => false,
        ),
        'databases' => 
        array (
          0 => 'mysql',
        ),
      ),
      'database_dump_compressor' => NULL,
      'destination' => 
      array (
        'filename_prefix' => '',
        'disks' => 
        array (
          0 => 'google',
        ),
      ),
      'temporary_directory' => '/home1/ivorytr1/public_html/e-training/storage/app/backup-temp',
    ),
    'notifications' => 
    array (
      'notifications' => 
      array (
        'Spatie\\Backup\\Notifications\\Notifications\\BackupHasFailed' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\UnhealthyBackupWasFound' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupHasFailed' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\BackupWasSuccessful' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\HealthyBackupWasFound' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupWasSuccessful' => 
        array (
          0 => 'mail',
        ),
      ),
      'notifiable' => 'Spatie\\Backup\\Notifications\\Notifiable',
      'mail' => 
      array (
        'to' => 'ivorytraining22@gmail.com',
      ),
      'slack' => 
      array (
        'webhook_url' => '',
        'channel' => NULL,
        'username' => NULL,
        'icon' => NULL,
      ),
    ),
    'monitor_backups' => 
    array (
      0 => 
      array (
        'name' => '',
        'disks' => 
        array (
          0 => 'google',
        ),
        'health_checks' => 
        array (
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumAgeInDays' => 1,
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumStorageInMegabytes' => 5000,
        ),
      ),
    ),
    'cleanup' => 
    array (
      'strategy' => 'Spatie\\Backup\\Tasks\\Cleanup\\Strategies\\DefaultStrategy',
      'default_strategy' => 
      array (
        'keep_all_backups_for_days' => 7,
        'keep_daily_backups_for_days' => 7,
        'keep_weekly_backups_for_weeks' => 8,
        'keep_monthly_backups_for_months' => 4,
        'keep_yearly_backups_for_years' => 2,
        'delete_oldest_backups_when_using_more_megabytes_than' => 5000,
      ),
    ),
    'status' => '0',
    'content' => 'db',
  ),
  'breadcrumbs' => 
  array (
    'view' => 'backend.includes.partials.breadcrumbs',
    'files' => '/home1/ivorytr1/public_html/e-training/routes/breadcrumbs.php',
    'unnamed-route-exception' => true,
    'missing-route-bound-breadcrumb-exception' => true,
    'invalid-named-breadcrumb-exception' => true,
    'manager-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsManager',
    'generator-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsGenerator',
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/home1/ivorytr1/public_html/e-training/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'ivory_training_cache',
  ),
  'chatter' => 
  array (
    'routes' => 
    array (
      'home' => 'forums',
      'discussion' => 'discussion',
      'category' => 'category',
      'post' => 'posts',
      'register' => 'register',
      'login' => 'login',
    ),
    'headline_logo' => '/vendor/devdojo/chatter/assets/images/logo-light.png',
    'yields' => 
    array (
      'head' => 'css',
      'footer' => 'js',
    ),
    'master_file_extend' => 'frontend.layouts.app',
    'sidebar_in_discussion_view' => false,
    'user' => 
    array (
      'namespace' => 'App\\Models\\Auth\\User',
      'database_field_with_user_name' => 'name',
      'relative_url_to_profile' => '',
      'relative_url_to_image_assets' => '',
      'avatar_image_database_field' => '',
    ),
    'security' => 
    array (
      'limit_time_between_posts' => true,
      'time_between_posts' => 1,
    ),
    'editor' => 'tinymce',
    'tinymce' => 
    array (
      'toolbar' => 'bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
      'plugins' => 'link, image',
    ),
    'order_by' => 
    array (
      'posts' => 
      array (
        'order' => 'created_at',
        'by' => 'ASC',
      ),
      'discussions' => 
      array (
        'order' => 'last_reply_at',
        'by' => 'DESC',
      ),
    ),
    'email' => 
    array (
      'enabled' => false,
      'view' => 'chatter::email',
    ),
    'soft_deletes' => false,
    'paginate' => 
    array (
      'num_of_results' => 10,
    ),
    'errors' => true,
    'middleware' => 
    array (
      'global' => 
      array (
        0 => 'web',
      ),
      'home' => 
      array (
      ),
      'discussion' => 
      array (
        'index' => 
        array (
        ),
        'show' => 
        array (
        ),
        'create' => 
        array (
        ),
        'store' => 
        array (
        ),
        'destroy' => 
        array (
        ),
        'edit' => 
        array (
        ),
        'update' => 
        array (
        ),
      ),
      'post' => 
      array (
        'index' => 
        array (
        ),
        'show' => 
        array (
        ),
        'create' => 
        array (
        ),
        'store' => 
        array (
        ),
        'destroy' => 
        array (
        ),
        'edit' => 
        array (
        ),
        'update' => 
        array (
        ),
      ),
      'category' => 
      array (
        'show' => 
        array (
        ),
      ),
    ),
  ),
  'cookie-consent' => 
  array (
    'enabled' => true,
    'cookie_name' => 'laravel_cookie_consent',
    'cookie_lifetime' => 7300,
  ),
  'currencies' => 
  array (
    0 => 
    array (
      'short_code' => 'SAR',
      'symbol' => 'SAR',
      'name' => 'Saudi Riyal',
      'country' => 'Saudi Arabia',
    ),
    1 => 
    array (
      'short_code' => 'USD',
      'symbol' => '$',
      'name' => 'United States dollar',
      'country' => 'United States',
    ),
    2 => 
    array (
      'short_code' => 'AUD',
      'symbol' => 'AUD',
      'name' => 'Australian dollar',
      'country' => 'Australia',
    ),
    3 => 
    array (
      'short_code' => 'BRL',
      'symbol' => 'R$',
      'name' => 'Brazilian real',
      'country' => 'Brazil',
    ),
    4 => 
    array (
      'short_code' => 'CAD',
      'symbol' => 'CAD',
      'name' => 'Canadian dollar',
      'country' => 'Canada',
    ),
    5 => 
    array (
      'short_code' => 'DKK',
      'symbol' => 'KR',
      'name' => 'Danish krone',
      'country' => 'Denmark',
    ),
    6 => 
    array (
      'short_code' => 'EUR',
      'symbol' => '€',
      'name' => 'Euro',
      'country' => 'France',
    ),
    7 => 
    array (
      'short_code' => 'HKD',
      'symbol' => 'HKD',
      'name' => 'Hong Kong dollar',
      'country' => 'Hong Kong',
    ),
    8 => 
    array (
      'short_code' => 'MYR',
      'symbol' => 'RM',
      'name' => 'Malaysian ringgit',
      'country' => 'Malaysia',
    ),
    9 => 
    array (
      'short_code' => 'MXN',
      'symbol' => 'MXN',
      'name' => 'Mexican peso',
      'country' => 'Mexico',
    ),
    10 => 
    array (
      'short_code' => 'NZD',
      'symbol' => 'NZD',
      'name' => 'New Zealand dollar',
      'country' => 'New Zealand',
    ),
    11 => 
    array (
      'short_code' => 'NOK',
      'symbol' => 'kr',
      'name' => 'Norwegian krone',
      'country' => 'Norway',
    ),
    12 => 
    array (
      'short_code' => 'PHP',
      'symbol' => '₱',
      'name' => 'Philippine peso',
      'country' => 'Philippines',
    ),
    13 => 
    array (
      'short_code' => 'PLN',
      'symbol' => 'zł',
      'name' => 'Polish złoty',
      'country' => 'Poland',
    ),
    14 => 
    array (
      'short_code' => 'GBP',
      'symbol' => '£',
      'name' => '	British pound',
      'country' => 'United Kingdom',
    ),
    15 => 
    array (
      'short_code' => 'RUB',
      'symbol' => 'RUB',
      'name' => 'Russian ruble',
      'country' => 'Russia',
    ),
    16 => 
    array (
      'short_code' => 'SGD',
      'symbol' => 'SGD',
      'name' => 'Singapore dollar',
      'country' => 'Singapore',
    ),
    17 => 
    array (
      'short_code' => 'SEK',
      'symbol' => 'SEK',
      'name' => 'Swedish krona',
      'country' => 'Sweden',
    ),
    18 => 
    array (
      'short_code' => 'CHF',
      'symbol' => 'CHF',
      'name' => 'Swiss franc',
      'country' => 'Liechtenstein',
    ),
    19 => 
    array (
      'short_code' => 'THB',
      'symbol' => '฿',
      'name' => 'Thai baht',
      'country' => 'Thailand',
    ),
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'ivorytr1_e-training',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'sqlite_testing' => 
      array (
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ivorytr1_e-training',
        'username' => 'ivorytr1_e-training',
        'password' => '6D]}X:u(wwGSXs4G',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'modes' => 
        array (
          0 => 'STRICT_TRANS_TABLES',
          1 => 'NO_ZERO_IN_DATE',
          2 => 'NO_ZERO_DATE',
          3 => 'ERROR_FOR_DIVISION_BY_ZERO',
          4 => 'NO_ENGINE_SUBSTITUTION',
        ),
        'engine' => 'InnoDB',
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ivorytr1_e-training',
        'username' => 'ivorytr1_e-training',
        'password' => '6D]}X:u(wwGSXs4G',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ivorytr1_e-training',
        'username' => 'ivorytr1_e-training',
        'password' => '6D]}X:u(wwGSXs4G',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => '%s %s NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'datatables-buttons' => 
  array (
    'namespace' => 
    array (
      'base' => 'DataTables',
      'model' => '',
    ),
    'pdf_generator' => 'snappy',
    'snappy' => 
    array (
      'options' => 
      array (
        'no-outline' => true,
        'margin-left' => '0',
        'margin-right' => '0',
        'margin-top' => '10mm',
        'margin-bottom' => '10mm',
      ),
      'orientation' => 'landscape',
    ),
    'parameters' => 
    array (
      'dom' => 'Bfrtip',
      'order' => 
      array (
        0 => 
        array (
          0 => 0,
          1 => 'desc',
        ),
      ),
      'buttons' => 
      array (
        0 => 'create',
        1 => 'export',
        2 => 'print',
        3 => 'reset',
        4 => 'reload',
      ),
    ),
    'generator' => 
    array (
      'columns' => 'id,add your columns,created_at,updated_at',
      'buttons' => 'create,export,print,reset,reload',
      'dom' => 'Bfrtip',
    ),
  ),
  'debugbar' => 
  array (
    'enabled' => false,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => '/home1/ivorytr1/public_html/e-training/storage/debugbar',
      'connection' => NULL,
      'provider' => '',
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => true,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'timeline' => false,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => true,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => '/home1/ivorytr1/public_html/e-training/public/fonts/lobster',
      'font_cache' => '/home1/ivorytr1/public_html/e-training/public/fonts/lobster',
      'temp_dir' => '/tmp',
      'chroot' => '/home1/ivorytr1/public_html/e-training',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'arial',
      'dpi' => 96,
      'enable_php' => true,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 0.5,
      'enable_html5_parser' => true,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'temp_path' => '/tmp',
      'pre_calculate_formulas' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => '/home1/ivorytr1/public_html/e-training/storage/framework/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/home1/ivorytr1/public_html/e-training/public/storage',
        'url' => 'e-training.ivorytraining.com/app/public/',
        'visibility' => 'public',
      ),
      'lang' => 
      array (
        'driver' => 'local',
        'root' => '/home1/ivorytr1/public_html/e-training/resources/lang',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/home1/ivorytr1/public_html/e-training/storage/app/public',
        'url' => 'e-training.ivorytraining.com/storage',
        'visibility' => 'public',
      ),
      'media' => 
      array (
        'driver' => 'local',
        'root' => '/home1/ivorytr1/public_html/e-training/storage/app/public',
        'url' => 'e-training.ivorytraining.com/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
      'dropbox' => 
      array (
        'driver' => 'dropbox',
        'token' => 'xigrdtbi5qek29x',
        'app_secret' => 'hvdb0sves3062d2',
        'key' => 'eldnulhu0hqpb13',
        'authorization_token' => 'sl.BISGNnEEimtsvf6PyiqlzdVQF9RbzZ9-9-tIfLkRbcCBtoj-7nTgilJKWwk_vQVG-xsI6aDos_aZ-alFlFrPxH3ZC8bbmPXchSDcq-7wf-OcyGIUHquz6VFSWpPt28HQ53En3Zw',
      ),
      'google' => 
      array (
        'driver' => 'google',
        'clientId' => '792613786177-k8esjtaa8vls81pememo69sj7rmgru2e.apps.googleusercontent.com',
        'clientSecret' => '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',
        'refreshToken' => '1//04aCilVYw8HD1CgYIARAAGAQSNwF-L9IrzYGiZDX3Zg7cMcE9bgyLF7mkbRHdVUCDyqEARHV9BtFXVOt4DKY_jyOtp4yE2u2MRUI',
        'folderId' => '1hnyZA0Jb_Vsuc50DqC6TQVK6lYZ5gZRD',
      ),
      'Qr' => 
      array (
        'driver' => 'local',
        'root' => '/home1/ivorytr1/public_html/e-training/public/storage',
        'url' => 'e-training.ivorytraining.com/app/public',
        'visibility' => 'public',
      ),
      'pages' =>
      array (
        'driver' => 'local',
        'root' => '/home1/ivorytr1/public_html/e-training/public/storage',
        'url' => 'e-training.ivorytraining.com/app/public',
        'visibility' => 'public',
      ),
      'Invoices' => 
      array (
        'driver' => 'local',
        'root' => '/home1/ivorytr1/public_html/e-training/public/storage',
        'url' => 'e-training.ivorytraining.com/app/public/',
        'visibility' => 'public',
      ),
      'QrLogin' => 
      array (
        'driver' => 'local',
        'root' => '/home1/ivorytr1/public_html/e-training/public/storage',
        'url' => 'e-training.ivorytraining.com/app/public',
        'visibility' => 'public',
      ),
    ),
  ),
  'geoip' => 
  array (
    'log_failures' => true,
    'include_currency' => true,
    'service' => 'ipapi',
    'services' => 
    array (
      'maxmind_database' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\MaxMindDatabase',
        'database_path' => '/home1/ivorytr1/public_html/e-training/storage/app/geoip.mmdb',
        'update_url' => 'https://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz',
        'locales' => 
        array (
          0 => 'en',
        ),
      ),
      'maxmind_api' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\MaxMindWebService',
        'user_id' => NULL,
        'license_key' => NULL,
        'locales' => 
        array (
          0 => 'en',
        ),
      ),
      'ipapi' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\IPApi',
        'secure' => true,
        'key' => NULL,
        'continent_path' => '/home1/ivorytr1/public_html/e-training/storage/app/continents.json',
        'lang' => 'en',
      ),
    ),
    'cache' => 'none',
    'cache_tags' => NULL,
    'cache_expires' => 30,
    'default_location' => 
    array (
      'ip' => '127.0.0.0',
      'iso_code' => 'US',
      'country' => 'United States',
      'city' => 'New Haven',
      'state' => 'CT',
      'state_name' => 'Connecticut',
      'postal_code' => '06510',
      'lat' => 41.31000000000000227373675443232059478759765625,
      'lon' => -72.9200000000000017053025658242404460906982421875,
      'timezone' => 'America/New_York',
      'continent' => 'NA',
      'default' => true,
      'currency' => 'USD',
    ),
  ),
  'gravatar' => 
  array (
    'default' => 
    array (
      'size' => 80,
      'fallback' => 'mm',
      'secure' => false,
      'maximumRating' => 'g',
      'forceDefault' => false,
      'forceExtension' => 'jpg',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'invoices' => 
  array (
    'currency' => 'SAR',
    'decimals' => 2,
    'logo' => NULL,
    'logo_height' => 60,
    'business_details' => 
    array (
      'name' => 'Ivory Training',
      'id' => '',
      'phone' => '+34 123 456 789',
      'location' => 'Main Street 1st',
      'zip' => '08241',
      'city' => 'Barcelona',
      'country' => 'Spain',
    ),
    'footnote' => '',
    'tax_rates' => 
    array (
      0 => 
      array (
        'name' => '',
        'tax' => 0,
        'tax_type' => 'percentage',
      ),
    ),
    'due_date' => 'Apr 22nd ,2024',
    'with_pagination' => true,
    'duplicate_header' => false,
    'tax' => 0,
    'tax_type' => 'percentage',
  ),
  'lfm' => 
  array (
    'use_package_routes' => true,
    'middlewares' => 
    array (
      0 => 'web',
      1 => 'auth',
    ),
    'url_prefix' => 'laravel-filemanager',
    'allow_multi_user' => true,
    'allow_share_folder' => true,
    'user_field' => 'UniSharp\\LaravelFilemanager\\Handlers\\ConfigHandler',
    'base_directory' => 'public',
    'images_folder_name' => 'photos',
    'files_folder_name' => 'files',
    'shared_folder_name' => 'shares',
    'thumb_folder_name' => 'thumbs',
    'images_startup_view' => 'grid',
    'files_startup_view' => 'list',
    'rename_file' => false,
    'alphanumeric_filename' => false,
    'alphanumeric_directory' => false,
    'should_validate_size' => false,
    'max_image_size' => 50000,
    'max_file_size' => 50000,
    'should_validate_mime' => false,
    'valid_image_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
      3 => 'image/gif',
      4 => 'image/svg+xml',
    ),
    'should_create_thumbnails' => true,
    'raster_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
    ),
    'create_folder_mode' => 493,
    'create_file_mode' => 420,
    'should_change_file_mode' => true,
    'valid_file_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
      3 => 'image/gif',
      4 => 'image/svg+xml',
      5 => 'application/pdf',
      6 => 'text/plain',
    ),
    'thumb_img_width' => 200,
    'thumb_img_height' => 200,
    'file_type_array' => 
    array (
      'pdf' => 'Adobe Acrobat',
      'doc' => 'Microsoft Word',
      'docx' => 'Microsoft Word',
      'xls' => 'Microsoft Excel',
      'xlsx' => 'Microsoft Excel',
      'zip' => 'Archive',
      'gif' => 'GIF Image',
      'jpg' => 'JPEG Image',
      'jpeg' => 'JPEG Image',
      'png' => 'PNG Image',
      'ppt' => 'Microsoft PowerPoint',
      'pptx' => 'Microsoft PowerPoint',
    ),
    'file_icon_array' => 
    array (
      'pdf' => 'fa-file-pdf-o',
      'doc' => 'fa-file-word-o',
      'docx' => 'fa-file-word-o',
      'xls' => 'fa-file-excel-o',
      'xlsx' => 'fa-file-excel-o',
      'zip' => 'fa-file-archive-o',
      'gif' => 'fa-file-image-o',
      'jpg' => 'fa-file-image-o',
      'jpeg' => 'fa-file-image-o',
      'png' => 'fa-file-image-o',
      'ppt' => 'fa-file-powerpoint-o',
      'pptx' => 'fa-file-powerpoint-o',
    ),
    'php_ini_overrides' => 
    array (
      'memory_limit' => '256M',
    ),
  ),
  'locale' => 
  array (
    'status' => true,
    'languages' => 
    array (
      'en' => 
      array (
        0 => 'en',
        1 => 'en_US',
        2 => true,
      ),
      'ar' => 
      array (
        0 => 'ar',
        1 => 'ar_AR',
        2 => true,
      ),
    ),
  ),
  'log-viewer' => 
  array (
    'storage-path' => '/home1/ivorytr1/public_html/e-training/storage/logs',
    'pattern' => 
    array (
      'prefix' => 'laravel-',
      'date' => '[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]',
      'extension' => '.log',
    ),
    'locale' => 'auto',
    'theme' => 'bootstrap-4',
    'route' => 
    array (
      'enabled' => true,
      'attributes' => 
      array (
        'prefix' => 'admin/log-viewer',
        'middleware' => 
        array (
          0 => 'web',
          1 => 'admin',
        ),
      ),
    ),
    'per-page' => 30,
    'facade' => 'LogViewer',
    'download' => 
    array (
      'prefix' => 'laravel-',
      'extension' => 'log',
    ),
    'menu' => 
    array (
      'filter-route' => 'log-viewer::logs.filter',
      'icons-enabled' => true,
    ),
    'icons' => 
    array (
      'all' => 'fa fa-fw fa-list',
      'emergency' => 'fa fa-fw fa-bug',
      'alert' => 'fa fa-fw fa-bullhorn',
      'critical' => 'fa fa-fw fa-heartbeat',
      'error' => 'fa fa-fw fa-times-circle',
      'warning' => 'fa fa-fw fa-exclamation-triangle',
      'notice' => 'fa fa-fw fa-exclamation-circle',
      'info' => 'fa fa-fw fa-info-circle',
      'debug' => 'fa fa-fw fa-life-ring',
    ),
    'colors' => 
    array (
      'levels' => 
      array (
        'empty' => '#D1D1D1',
        'all' => '#8A8A8A',
        'emergency' => '#B71C1C',
        'alert' => '#D32F2F',
        'critical' => '#F44336',
        'error' => '#FF5722',
        'warning' => '#FF9100',
        'notice' => '#4CAF50',
        'info' => '#1976D2',
        'debug' => '#90CAF9',
      ),
    ),
    'highlight' => 
    array (
      0 => '^#\\d+',
      1 => '^Stack trace:',
    ),
  ),
  'logging' => 
  array (
    'default' => 'daily',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/home1/ivorytr1/public_html/e-training/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/home1/ivorytr1/public_html/e-training/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'mail.ivorytraining.com',
    'port' => '465',
    'from' => 
    array (
      'address' => 'etraining@ivorytraining.com',
      'name' => 'IVORY TRAINING',
    ),
    'encryption' => 'ssl',
    'username' => 'etraining@ivorytraining.com',
    'password' => 'Egypt!2021',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/home1/ivorytr1/public_html/e-training/resources/views/vendor/mail',
      ),
    ),
  ),
  'medialibrary' => 
  array (
    'disk_name' => 'public',
    'max_file_size' => 10485760,
    'queue_name' => '',
    'media_model' => 'Spatie\\MediaLibrary\\Models\\Media',
    's3' => 
    array (
      'domain' => 'https://.s3.amazonaws.com',
    ),
    'remote' => 
    array (
      'extra_headers' => 
      array (
        'CacheControl' => 'max-age=604800',
      ),
    ),
    'responsive_images' => 
    array (
      'width_calculator' => 'Spatie\\MediaLibrary\\ResponsiveImages\\WidthCalculator\\FileSizeOptimizedWidthCalculator',
      'use_tiny_placeholders' => true,
      'tiny_placeholder_generator' => 'Spatie\\MediaLibrary\\ResponsiveImages\\TinyPlaceholderGenerator\\Blurred',
    ),
    'url_generator' => NULL,
    'path_generator' => NULL,
    'image_optimizers' => 
    array (
      'Spatie\\ImageOptimizer\\Optimizers\\Jpegoptim' => 
      array (
        0 => '--strip-all',
        1 => '--all-progressive',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Pngquant' => 
      array (
        0 => '--force',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Optipng' => 
      array (
        0 => '-i0',
        1 => '-o2',
        2 => '-quiet',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Svgo' => 
      array (
        0 => '--disable=cleanupIDs',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Gifsicle' => 
      array (
        0 => '-b',
        1 => '-O3',
      ),
    ),
    'image_generators' => 
    array (
      0 => 'Spatie\\MediaLibrary\\ImageGenerators\\FileTypes\\Image',
      1 => 'Spatie\\MediaLibrary\\ImageGenerators\\FileTypes\\Webp',
      2 => 'Spatie\\MediaLibrary\\ImageGenerators\\FileTypes\\Pdf',
      3 => 'Spatie\\MediaLibrary\\ImageGenerators\\FileTypes\\Svg',
      4 => 'Spatie\\MediaLibrary\\ImageGenerators\\FileTypes\\Video',
    ),
    'image_driver' => 'gd',
    'ffmpeg_path' => '/usr/bin/ffmpeg',
    'ffprobe_path' => '/usr/bin/ffprobe',
    'temporary_directory_path' => NULL,
    'jobs' => 
    array (
      'perform_conversions' => 'Spatie\\MediaLibrary\\Jobs\\PerformConversions',
      'generate_responsive_images' => 'Spatie\\MediaLibrary\\Jobs\\GenerateResponsiveImages',
    ),
  ),
  'menu' => 
  array (
    'middleware' => 
    array (
    ),
    'table_prefix' => 'admin_',
    'table_name_menus' => 'menus',
    'table_name_items' => 'menu_items',
    'route_path' => '/user/',
    'use_roles' => false,
    'roles_table' => 'roles',
    'roles_pk' => 'id',
    'roles_title_field' => 'name',
  ),
  'messenger' => 
  array (
    'models' => 
    array (
      'message' => 'Gerardojbaez\\Messenger\\Models\\Message',
      'thread' => 'Gerardojbaez\\Messenger\\Models\\MessageThread',
      'participant' => 'Gerardojbaez\\Messenger\\Models\\MessageThreadParticipant',
    ),
  ),
  'newsletter' => 
  array (
    'apiKey' => '',
    'defaultListName' => 'subscribers',
    'lists' => 
    array (
      'subscribers' => 
      array (
        'id' => NULL,
      ),
    ),
    'ssl' => true,
  ),
  'no-captcha' => 
  array (
    'secret' => 'no-captcha-secret',
    'sitekey' => 'no-captcha-sitekey',
    'lang' => 'en',
    'attributes' => 
    array (
      'data-theme' => NULL,
      'data-type' => NULL,
      'data-size' => NULL,
    ),
  ),
  'paypal' => 
  array (
    'client_id' => NULL,
    'secret' => NULL,
    'settings' => 
    array (
      'mode' => 'sandbox',
      'http.ConnectionTimeOut' => 30,
      'log.LogEnabled' => true,
      'log.FileName' => '/home1/ivorytr1/public_html/e-training/storage/logs/paypal.log',
      'log.LogLevel' => 'ERROR',
    ),
    'active' => '0',
  ),
  'tabby' =>
  array(
      'active' => '1'
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Spatie\\Permission\\Models\\Permission',
      'role' => 'Spatie\\Permission\\Models\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'model_has_permissions' => 'model_has_permissions',
      'model_has_roles' => 'model_has_roles',
      'role_has_permissions' => 'role_has_permissions',
    ),
    'column_names' => 
    array (
      'model_morph_key' => 'model_id',
    ),
    'display_permission_in_exception' => false,
    'cache' => 
    array (
      'expiration_time' => 
      DateInterval::__set_state(array(
         'y' => 0,
         'm' => 0,
         'd' => 0,
         'h' => 24,
         'i' => 0,
         's' => 0,
         'f' => 0.0,
         'weekday' => 0,
         'weekday_behavior' => 0,
         'first_last_day_of' => 0,
         'invert' => 0,
         'days' => false,
         'special_type' => 0,
         'special_amount' => 0,
         'have_weekday_relative' => 0,
         'have_special_relative' => 0,
      )),
      'key' => 'spatie.permission.cache',
      'model_key' => 'name',
      'store' => 'default',
    ),
    'cache_expiration_time' => 1440,
    'log_registration_exception' => true,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 10,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'read-time' => 
  array (
    'abbreviate_time_measurements' => false,
    'omit_seconds' => true,
    'time_only' => false,
    'words_per_minute' => 230,
  ),
  'sections' => 
  array (
    'layout_1' => 
    array (
      'search_section' => 
      array (
        'title' => 'Search Section',
        'status' => 1,
      ),
      'popular_courses' => 
      array (
        'title' => 'Popular Courses',
        'status' => 1,
      ),
      'reasons' => 
      array (
        'title' => 'Reasons why choose Ivory Training',
        'status' => 1,
      ),
      'testimonial' => 
      array (
        'title' => 'Testimonial',
        'status' => 1,
      ),
      'latest_news' => 
      array (
        'title' => 'Latest News, Courses',
        'status' => 1,
      ),
      'sponsors' => 
      array (
        'title' => 'Sponsors',
        'status' => 1,
      ),
      'featured_courses' => 
      array (
        'title' => 'Featured Courses',
        'status' => 1,
      ),
      'teachers' => 
      array (
        'title' => 'Teachers',
        'status' => 1,
      ),
      'faq' => 
      array (
        'title' => 'Frequently Asked Questions',
        'status' => 1,
      ),
      'course_by_category' => 
      array (
        'title' => 'Course By Category',
        'status' => 1,
      ),
      'contact_us' => 
      array (
        'title' => 'Contact us / Get in Touch',
        'status' => 1,
      ),
    ),
    'layout_2' => 
    array (
      'sponsors' => 
      array (
        'title' => 'Sponsors',
        'status' => 1,
      ),
      'popular_courses' => 
      array (
        'title' => 'Popular Courses',
        'status' => 1,
      ),
      'search_section' => 
      array (
        'title' => 'Search Section',
        'status' => 1,
      ),
      'latest_news' => 
      array (
        'title' => 'Latest News, Courses',
        'status' => 1,
      ),
      'featured_courses' => 
      array (
        'title' => 'Featured Courses',
        'status' => 1,
      ),
      'faq' => 
      array (
        'title' => 'Frequently Asked Questions',
        'status' => 1,
      ),
      'course_by_category' => 
      array (
        'title' => 'Course By Category',
        'status' => 1,
      ),
      'testimonial' => 
      array (
        'title' => 'Testimonial',
        'status' => 1,
      ),
      'teachers' => 
      array (
        'title' => 'Teachers',
        'status' => 1,
      ),
      'contact_us' => 
      array (
        'title' => 'Contact us / Get in Touch',
        'status' => 1,
      ),
    ),
    'layout_3' => 
    array (
      'counters' => 
      array (
        'title' => 'Counters',
        'status' => 1,
      ),
      'latest_news' => 
      array (
        'title' => 'Latest News, Courses',
        'status' => 1,
      ),
      'popular_courses' => 
      array (
        'title' => 'Popular Courses',
        'status' => 1,
      ),
      'reasons' => 
      array (
        'title' => 'Reasons why choose Ivory Training',
        'status' => 1,
      ),
      'featured_courses' => 
      array (
        'title' => 'Featured Courses',
        'status' => 1,
      ),
      'teachers' => 
      array (
        'title' => 'Teachers',
        'status' => 1,
      ),
      'faq' => 
      array (
        'title' => 'Frequently Asked Questions',
        'status' => 1,
      ),
      'testimonial' => 
      array (
        'title' => 'Testimonial',
        'status' => 1,
      ),
      'sponsors' => 
      array (
        'title' => 'Sponsors',
        'status' => 1,
      ),
      'course_by_category' => 
      array (
        'title' => 'Course By Category',
        'status' => 1,
      ),
      'contact_us' => 
      array (
        'title' => 'Contact us / Get in Touch',
        'status' => 1,
      ),
    ),
    'layout_4' => 
    array (
      'counters' => 
      array (
        'title' => 'Counters',
        'status' => 1,
      ),
      'popular_courses' => 
      array (
        'title' => 'Popular Courses',
        'status' => 1,
      ),
      'reasons' => 
      array (
        'title' => 'Reasons why choose Ivory Training',
        'status' => 1,
      ),
      'featured_courses' => 
      array (
        'title' => 'Featured Courses',
        'status' => 1,
      ),
      'course_by_category' => 
      array (
        'title' => 'Course By Category',
        'status' => 1,
      ),
      'teachers' => 
      array (
        'title' => 'Teachers',
        'status' => 1,
      ),
      'latest_news' => 
      array (
        'title' => 'Latest News, Courses',
        'status' => 1,
      ),
      'search_section' => 
      array (
        'title' => 'Search Section',
        'status' => 1,
      ),
      'faq' => 
      array (
        'title' => 'Frequently Asked Questions',
        'status' => 1,
      ),
      'testimonial' => 
      array (
        'title' => 'Testimonial',
        'status' => 1,
      ),
      'sponsors' => 
      array (
        'title' => 'Sponsors',
        'status' => 1,
      ),
      'contact_form' => 
      array (
        'title' => 'Contact Form',
        'status' => 1,
      ),
      'contact_us' => 
      array (
        'title' => 'Contact us / Get in Touch',
        'status' => 1,
      ),
    ),
  ),
  'self-diagnosis' => 
  array (
    'environment_aliases' => 
    array (
      'prod' => 'production',
      'live' => 'production',
      'local' => 'development',
    ),
    'checks' => 
    array (
      0 => 'BeyondCode\\SelfDiagnosis\\Checks\\AppKeyIsSet',
      1 => 'BeyondCode\\SelfDiagnosis\\Checks\\CorrectPhpVersionIsInstalled',
      'BeyondCode\\SelfDiagnosis\\Checks\\DatabaseCanBeAccessed' => 
      array (
        'default_connection' => true,
        'connections' => 
        array (
        ),
      ),
      'BeyondCode\\SelfDiagnosis\\Checks\\DirectoriesHaveCorrectPermissions' => 
      array (
        'directories' => 
        array (
          0 => '/home1/ivorytr1/public_html/e-training/storage',
          1 => '/home1/ivorytr1/public_html/e-training/bootstrap/cache',
        ),
      ),
      2 => 'BeyondCode\\SelfDiagnosis\\Checks\\EnvFileExists',
      3 => 'BeyondCode\\SelfDiagnosis\\Checks\\ExampleEnvironmentVariablesAreSet',
      4 => 'BeyondCode\\SelfDiagnosis\\Checks\\MigrationsAreUpToDate',
      'BeyondCode\\SelfDiagnosis\\Checks\\PhpExtensionsAreInstalled' => 
      array (
        'extensions' => 
        array (
          0 => 'openssl',
          1 => 'PDO',
          2 => 'mbstring',
          3 => 'tokenizer',
          4 => 'xml',
          5 => 'ctype',
          6 => 'json',
        ),
        'include_composer_extensions' => true,
      ),
      5 => 'BeyondCode\\SelfDiagnosis\\Checks\\StorageDirectoryIsLinked',
    ),
    'environment_checks' => 
    array (
      'development' => 
      array (
        0 => 'BeyondCode\\SelfDiagnosis\\Checks\\ComposerWithDevDependenciesIsUpToDate',
        1 => 'BeyondCode\\SelfDiagnosis\\Checks\\ConfigurationIsNotCached',
        2 => 'BeyondCode\\SelfDiagnosis\\Checks\\RoutesAreNotCached',
      ),
      'production' => 
      array (
        0 => 'BeyondCode\\SelfDiagnosis\\Checks\\ComposerWithoutDevDependenciesIsUpToDate',
        1 => 'BeyondCode\\SelfDiagnosis\\Checks\\ConfigurationIsCached',
        2 => 'BeyondCode\\SelfDiagnosis\\Checks\\DebugModeIsNotEnabled',
        'BeyondCode\\SelfDiagnosis\\Checks\\PhpExtensionsAreDisabled' => 
        array (
          'extensions' => 
          array (
            0 => 'xdebug',
          ),
        ),
        3 => 'BeyondCode\\SelfDiagnosis\\Checks\\RoutesAreCached',
      ),
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\Models\\Auth\\User',
      'key' => NULL,
      'secret' => NULL,
      'webhook' => 
      array (
        'secret' => NULL,
        'tolerance' => 300,
      ),
      'active' => '0',
    ),
    'bitbucket' => 
    array (
      'active' => false,
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => 'e-training.ivorytraining.com/login/bitbucket/callback',
      'scopes' => 
      array (
      ),
      'with' => 
      array (
      ),
    ),
    'facebook' => 
    array (
      'active' => false,
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => 'e-training.ivorytraining.com/login/facebook/callback',
      'scopes' => 
      array (
      ),
      'with' => 
      array (
      ),
      'fields' => 
      array (
      ),
    ),
    'github' => 
    array (
      'active' => false,
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => 'e-training.ivorytraining.com/login/github/callback',
      'scopes' => 
      array (
      ),
      'with' => 
      array (
      ),
    ),
    'google' => 
    array (
      'active' => false,
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => 'e-training.ivorytraining.com/login/google/callback',
      'scopes' => 
      array (
        0 => 'https://www.googleapis.com/auth/plus.me',
        1 => 'https://www.googleapis.com/auth/plus.profile.emails.read',
      ),
      'with' => 
      array (
      ),
    ),
    'linkedin' => 
    array (
      'active' => false,
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => 'e-training.ivorytraining.com/login/linkedin/callback',
      'scopes' => 
      array (
      ),
      'with' => 
      array (
      ),
      'fields' => 
      array (
      ),
    ),
    'twitter' => 
    array (
      'active' => false,
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => 'e-training.ivorytraining.com/login/twitter/callback',
      'scopes' => 
      array (
      ),
      'with' => 
      array (
      ),
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home1/ivorytr1/public_html/e-training/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'ivory_training_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'shopping_cart' => 
  array (
    'format_numbers' => false,
    'decimals' => 0,
    'dec_point' => '.',
    'thousands_sep' => ',',
    'storage' => NULL,
    'events' => NULL,
  ),
  'sitemap' => 
  array (
    'use_cache' => false,
    'cache_key' => 'laravel-sitemap.e-training.ivorytraining.com',
    'cache_duration' => 3600,
    'escaping' => true,
    'use_limit_size' => false,
    'max_size' => NULL,
    'use_styles' => true,
    'styles_location' => '/vendor/sitemap/styles/',
    'use_gzip' => false,
    'chunk' => '500',
  ),
  'snappy' => 
  array (
    'pdf' => 
    array (
      'enabled' => true,
      'binary' => '/usr/local/bin/wkhtmltopdf',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
    'image' => 
    array (
      'enabled' => true,
      'binary' => '/usr/local/bin/wkhtmltoimage',
      'timeout' => false,
      'options' => 
      array (
      ),
      'env' => 
      array (
      ),
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
  'translation-manager' => 
  array (
    'route' => 
    array (
      'prefix' => 'user/translations',
      'middleware' => 
      array (
        0 => 'web',
        1 => 'auth',
      ),
    ),
    'delete_enabled' => true,
    'exclude_groups' => 
    array (
    ),
    'exclude_langs' => 
    array (
    ),
    'sort_keys' => false,
    'trans_functions' => 
    array (
      0 => 'trans',
      1 => 'trans_choice',
      2 => 'Lang::get',
      3 => 'Lang::choice',
      4 => 'Lang::trans',
      5 => 'Lang::transChoice',
      6 => '@lang',
      7 => '@choice',
      8 => '__',
      9 => '$trans.get',
    ),
    'sort_keys ' => false,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/home1/ivorytr1/public_html/e-training/resources/views',
    ),
    'compiled' => '/home1/ivorytr1/public_html/e-training/storage/framework/views',
  ),
  'blade-directives' => 
  array (
    'directives' => 
    array (
    ),
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
  ),
  'datatables-html' => 
  array (
    'table' => 
    array (
      'class' => 'table',
      'id' => 'dataTableBuilder',
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
    'script' => 'datatables::script',
    'editor' => 'datatables::editor',
  ),
  'purifier' => 
  array (
    'encoding' => 'UTF-8',
    'finalize' => true,
    'cachePath' => '/home1/ivorytr1/public_html/e-training/storage/app/purifier',
    'cacheFileMode' => 493,
    'settings' => 
    array (
      'default' => 
      array (
        'HTML.Doctype' => 'HTML 4.01 Transitional',
        'HTML.Allowed' => 'div,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
        'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
        'AutoFormat.AutoParagraph' => true,
        'AutoFormat.RemoveEmpty' => true,
      ),
      'test' => 
      array (
        'Attr.EnableID' => 'true',
      ),
      'youtube' => 
      array (
        'HTML.SafeIframe' => 'true',
        'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%',
      ),
      'custom_definition' => 
      array (
        'id' => 'html5-definitions',
        'rev' => 1,
        'debug' => false,
        'elements' => 
        array (
          0 => 
          array (
            0 => 'section',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          1 => 
          array (
            0 => 'nav',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          2 => 
          array (
            0 => 'article',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          3 => 
          array (
            0 => 'aside',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          4 => 
          array (
            0 => 'header',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          5 => 
          array (
            0 => 'footer',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          6 => 
          array (
            0 => 'address',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          7 => 
          array (
            0 => 'hgroup',
            1 => 'Block',
            2 => 'Required: h1 | h2 | h3 | h4 | h5 | h6',
            3 => 'Common',
          ),
          8 => 
          array (
            0 => 'figure',
            1 => 'Block',
            2 => 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow',
            3 => 'Common',
          ),
          9 => 
          array (
            0 => 'figcaption',
            1 => 'Inline',
            2 => 'Flow',
            3 => 'Common',
          ),
          10 => 
          array (
            0 => 'video',
            1 => 'Block',
            2 => 'Optional: (source, Flow) | (Flow, source) | Flow',
            3 => 'Common',
            4 => 
            array (
              'src' => 'URI',
              'type' => 'Text',
              'width' => 'Length',
              'height' => 'Length',
              'poster' => 'URI',
              'preload' => 'Enum#auto,metadata,none',
              'controls' => 'Bool',
            ),
          ),
          11 => 
          array (
            0 => 'source',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'src' => 'URI',
              'type' => 'Text',
            ),
          ),
          12 => 
          array (
            0 => 's',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          13 => 
          array (
            0 => 'var',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          14 => 
          array (
            0 => 'sub',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          15 => 
          array (
            0 => 'sup',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          16 => 
          array (
            0 => 'mark',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          17 => 
          array (
            0 => 'wbr',
            1 => 'Inline',
            2 => 'Empty',
            3 => 'Core',
          ),
          18 => 
          array (
            0 => 'ins',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'cite' => 'URI',
              'datetime' => 'CDATA',
            ),
          ),
          19 => 
          array (
            0 => 'del',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'cite' => 'URI',
              'datetime' => 'CDATA',
            ),
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            0 => 'iframe',
            1 => 'allowfullscreen',
            2 => 'Bool',
          ),
          1 => 
          array (
            0 => 'table',
            1 => 'height',
            2 => 'Text',
          ),
          2 => 
          array (
            0 => 'td',
            1 => 'border',
            2 => 'Text',
          ),
          3 => 
          array (
            0 => 'th',
            1 => 'border',
            2 => 'Text',
          ),
          4 => 
          array (
            0 => 'tr',
            1 => 'width',
            2 => 'Text',
          ),
          5 => 
          array (
            0 => 'tr',
            1 => 'height',
            2 => 'Text',
          ),
          6 => 
          array (
            0 => 'tr',
            1 => 'border',
            2 => 'Text',
          ),
        ),
      ),
      'custom_attributes' => 
      array (
        0 => 
        array (
          0 => 'a',
          1 => 'target',
          2 => 'Enum#_blank,_self,_target,_top',
        ),
      ),
      'custom_elements' => 
      array (
        0 => 
        array (
          0 => 'u',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
      ),
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'location' => 
  array (
    'driver' => 'Stevebauman\\Location\\Drivers\\IpApi',
    'fallbacks' => 
    array (
      0 => 'Stevebauman\\Location\\Drivers\\IpInfo',
      1 => 'Stevebauman\\Location\\Drivers\\GeoPlugin',
      2 => 'Stevebauman\\Location\\Drivers\\MaxMind',
    ),
    'position' => 'Stevebauman\\Location\\Position',
    'maxmind' => 
    array (
      'web' => 
      array (
        'enabled' => false,
        'user_id' => '',
        'license_key' => '',
        'options' => 
        array (
          'host' => 'geoip.maxmind.com',
        ),
      ),
      'local' => 
      array (
        'type' => 'city',
        'path' => '/home1/ivorytr1/public_html/e-training/database/maxmind/GeoLite2-City.mmdb',
      ),
    ),
    'ip_api' => 
    array (
      'token' => NULL,
    ),
    'ipinfo' => 
    array (
      'token' => NULL,
    ),
    'ipdata' => 
    array (
      'token' => NULL,
    ),
    'kloudend' => 
    array (
      'token' => NULL,
    ),
    'testing' => 
    array (
      'enabled' => true,
      'ip' => '66.102.0.0',
    ),
  ),
  'theme_layout' => '1',
  'font_color' => 'color-2',
  'layout_type' => 'wide-layout',
  'layout_1' => '{"search_section":{"title":"Search Section","status":1},"popular_courses":{"title":"Popular Courses","status":1},"reasons":{"title":"Reasons why choose Neon LMS","status":1},"testimonial":{"title":"Testimonial","status":1},"latest_news":{"title":"Latest News, Courses","status":1},"sponsors":{"title":"Sponsors","status":1},"featured_courses":{"title":"Featured Courses","status":1},"teachers":{"title":"Teachers","status":1},"faq":{"title":"Frequently Asked Questions","status":1},"course_by_category":{"title":"Course By Category","status":1},"contact_us":{"title":"Contact us / Get in Touch","status":1}}',
  'layout_2' => '{"sponsors":{"title":"Sponsors","status":1},"popular_courses":{"title":"Popular Courses","status":1},"search_section":{"title":"Search Section","status":1},"latest_news":{"title":"Latest News, Courses","status":1},"featured_courses":{"title":"Featured Courses","status":1},"faq":{"title":"Frequently Asked Questions","status":1},"course_by_category":{"title":"Course By Category","status":1},"testimonial":{"title":"Testimonial","status":1},"teachers":{"title":"Teachers","status":1},"contact_us":{"title":"Contact us / Get in Touch","status":1}}',
  'layout_3' => '{"counters":{"title":"Counters","status":1},"latest_news":{"title":"Latest News, Courses","status":1},"popular_courses":{"title":"Popular Courses","status":1},"reasons":{"title":"Reasons why choose Neon LMS","status":1},"featured_courses":{"title":"Featured Courses","status":1},"teachers":{"title":"Teachers","status":1},"faq":{"title":"Frequently Asked Questions","status":1},"testimonial":{"title":"Testimonial","status":1},"sponsors":{"title":"Sponsors","status":1},"course_by_category":{"title":"Course By Category","status":1},"contact_us":{"title":"Contact us / Get in Touch","status":1}}',
  'layout_4' => '{"counters":{"title":"Counters","status":1},"popular_courses":{"title":"Popular Courses","status":1},"reasons":{"title":"Reasons why choose Neon LMS","status":1},"featured_courses":{"title":"Featured Courses","status":1},"course_by_category":{"title":"Course By Category","status":1},"teachers":{"title":"Teachers","status":1},"latest_news":{"title":"Latest News, Courses","status":1},"search_section":{"title":"Search Section","status":1},"faq":{"title":"Frequently Asked Questions","status":1},"testimonial":{"title":"Testimonial","status":1},"sponsors":{"title":"Sponsors","status":1},"contact_form":{"title":"Contact Form","status":1},"contact_us":{"title":"Contact us / Get in Touch","status":1}}',
  'counter' => '1',
  'total_students' => '14800',
  'total_courses' => '282',
  'total_teachers' => '200+',
  'logo_b_image' => '1618790213-logo-wh.png',
  'logo_w_image' => '1618790213-logo-wh.png',
  'logo_white_image' => '1616816284-logo.png',
  'logo_popup' => '1618790213-logo-wh.png',
  'favicon_image' => '1618790213-logo-wh.png',
  'contact_data' => '[{"name":"short_text","value":"تمهير هي علامة تجارية مسجلة للتدريب والاستشارات تحت اسم العاج الفضي مقرها في الرياض ، المملكة العربية السعودية","status":1},{"name":"primary_address","value":"Tamher For Training & Consulting, Al Muruj, Riyadh, Urwah Bin Werd street 11534","status":1},{"name":"secondary_address","value":"","status":0},{"name":"primary_phone","value":"00966533993220","status":1},{"name":"secondary_phone","value":"0096611445518","status":1},{"name":"primary_email","value":"info@ivorytraining.com","status":1},{"name":"secondary_email","value":"","status":0},{"name":"location_on_map","value":"<iframe src=\'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14492.931038388067!2d46.6690387!3d24.7532074!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x42f38ab66576eab5!2zKNii2YrZgdmI2LHZiikg2YXYsdmD2LIg2KfZhNi52KfYrCDYp9mE2YHYttmKINmE2YTYqtiv2LHZitioINmI2KfZhNin2LPYqti02KfYsdin2KogSVZPUlkgRm9yIFRyYWluaW5nICYgQ29uc3VsdGluZw!5e0!3m2!1sen!2str!4v1588212496718!5m2!1sen!2str\' width=\'100%\' height=\'300\' frameborder=\'0\' style=\'border: 0px; pointer-events: none;\' allowfullscreen=\'\' aria-hidden=\'false\' tabindex=\'0\'></iframe>","status":1}]',
  'footer_data' => '{"short_description":{"text":"We take our mission of increasing global access to quality education seriously. We connect learners to the best universities and institutions from around the world.","status":1},"section1":{"type":"2","status":1},"section2":{"type":"3","status":1},"section3":{"type":"4","status":1},"social_links":{"status":1,"links":[{"icon":"fab fa-facebook-f","link":"#"},{"icon":"fab fa-instagram","link":"#"},{"icon":"fab fa-twitter","link":"#"},{"icon":"fab fa-youtube","link":"https://www.youtube.com/"},{"icon":"fab fa-linkedin","link":"https://www.linkedin.com/"}]},"newsletter_form":{"status":1},"bottom_footer":{"status":1},"copyright_text":{"text":"All right reserved  © 2021","status":1},"bottom_footer_links":{"status":1,"links":[{"label":"Privacy Policy","link":"http://neon-lms-app.com/privacy-policy"}]}}',
  'lesson_timer' => '0',
  'show_offers' => '0',
  'one_signal' => '0',
  'nav_menu' => '1',
  'commission_rate' => '0',
  'google_analytics_id' => NULL,
  'onesignal_data' => NULL,
  'registration_fields' => '[{"name":"phone","type":"number"}]',
  'myTable_length' => '10',
  'access_registration' => '0',
  'mailchimp_double_opt_in' => '0',
  'access_users_change_email' => '0',
  'access_users_confirm_email' => '0',
  'access_captcha_registration' => '0',
  'access_users_requires_approval' => '0',
  'payment_offline_active' => '1',
  'retest' => '0',
  'onesignal_status' => '0',
  'section1' => '2',
  'section2' => '3',
  'section3' => '4',
  'icon' => 'fab fa-facebook-f',
  'total_hours' => '28900',
  'total_years' => '6',
  'myfatoorah' => 
  array (
    'active' => '1',
    'secret' => NULL,
    'client_id' => NULL,
    'settings' => 
    array (
      'mode' => 'sandbox',
    ),
  ),
  'pixel_code' => '<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,\'script\',
\'https://connect.facebook.net/en_US/fbevents.js\');
fbq(\'init\', \'289740762023013\');
fbq(\'track\', \'PageView\');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=289740762023013&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

<!-- Snap Pixel Code -->
<script type=\'text/javascript\'>
(function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
{a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
a.queue=[];var s=\'script\';r=t.createElement(s);r.async=!0;
r.src=n;var u=t.getElementsByTagName(s)[0];
u.parentNode.insertBefore(r,u);})(window,document,
\'https://sc-static.net/scevent.min.js\');

snaptr(\'init\', \'995cc76c-cc51-4574-96be-7c7b40bd3725\', {
\'user_email\': \'__INSERT_USER_EMAIL__\'
});

snaptr(\'track\', \'PAGE_VIEW\');

</script>
<!-- End Snap Pixel Code -->

<!-- Google Tag Manager -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-232133810-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());

  gtag(\'config\', \'UA-232133810-1\');
</script>


<!-- Twitter universal website tag code -->
<script>
!function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
},s.version=\'1.1\',s.queue=[],u=t.createElement(n),u.async=!0,u.src=\'//static.ads-twitter.com/uwt.js\',
a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,\'script\');
// Insert Twitter Pixel ID and Standard Event data below
twq(\'init\',\'nvmpz\');
twq(\'track\',\'PageView\');
</script>',
  'home_free_course' => '35',
  'backup_schedule' => '1',
  'ide-helper' => 
  array (
    'filename' => '_ide_helper',
    'format' => 'php',
    'meta_filename' => '.phpstorm.meta.php',
    'include_fluent' => false,
    'include_factory_builders' => false,
    'write_model_magic_where' => true,
    'write_model_relation_count_properties' => true,
    'write_eloquent_model_mixins' => false,
    'include_helpers' => false,
    'helper_files' => 
    array (
      0 => '/home1/ivorytr1/public_html/e-training/vendor/laravel/framework/src/Illuminate/Support/helpers.php',
    ),
    'model_locations' => 
    array (
      0 => 'app',
    ),
    'ignored_models' => 
    array (
    ),
    'extra' => 
    array (
      'Eloquent' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'Illuminate\\Database\\Query\\Builder',
      ),
      'Session' => 
      array (
        0 => 'Illuminate\\Session\\Store',
      ),
    ),
    'magic' => 
    array (
    ),
    'interfaces' => 
    array (
    ),
    'custom_db_types' => 
    array (
    ),
    'model_camel_case_properties' => false,
    'type_overrides' => 
    array (
      'integer' => 'int',
      'boolean' => 'bool',
    ),
    'include_class_docblocks' => false,
  ),
);
