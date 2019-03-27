<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'poznaiby_bonus');

/** Имя пользователя MySQL */
define('DB_USER', 'poznaiby_bonus');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'WQDRh2BLP0');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&yAJO2K2F9gU=P%N.B2Z[JpB{DYB|<h}W%^_JUA_jwfOY=F|cPA_n4hkom(U|FcN');
define('SECURE_AUTH_KEY',  'v+,0J-FZ%~`,rOq?+FVlv?%Bm07sfCEFSxYfjbn l-;w.|(/E.66Jfdz[J?vNdwb');
define('LOGGED_IN_KEY',    'U>]qd3~6;!`;NUYAG^3MV[gq-B)p+z5|OE!T@Xy-}#1mA,o)|JN:;h/=[m!wKb&F');
define('NONCE_KEY',        'wtC_6%9.9},<k?ko#a<+{-%7xwaqQYYu+u;NC$g&Vu,DB0gGysP<}*=V@3O]3 w6');
define('AUTH_SALT',        'd=$wHy]T-T0!:|RZGxFgb.M/h1,?^a?bWzf3KCa%Q<lhf5Ok-uZD~GWGwN83Nk<X');
define('SECURE_AUTH_SALT', '8$_lkRcvm$?7D[ucdG]GYyXCR(~B/XTD_^4,oW.$7G9 =~[acK^st$9J)$cWd|q ');
define('LOGGED_IN_SALT',   '50jvgwr/l@#`-2p5~>kOp=ET4iw$Dw%CUj6ecVY]ua]NHOm)q87VXjehpm->#rLI');
define('NONCE_SALT',       'b`fz4jak[Sf&TI(;bp}OCq)#!,+C4S+4{aF4P?Z*j}}`^Pzt;F6,#I)&TY-Pnsx!');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'trakai_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
