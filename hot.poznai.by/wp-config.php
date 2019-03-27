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
define('AUTH_KEY',         'd?nxEyCn4L]gVN`E#E>(Zy$4Ktr`gm0kTL#g]ntzKAZ;N W7rRp1<j63h>*`Y~OL');
define('SECURE_AUTH_KEY',  'cr4:#lKz9lvzF*6]E~j3KLd#NQ_]G|+icJg>.,*ht:ZYU.r~mce^/`6M?2w $8Py');
define('LOGGED_IN_KEY',    'V+R:na_[Mj}%>YlmNP|vFx*yv-9>igh[Rdmj%FgY.6Ffq=~*Rp?OR(ruv+NW||pH');
define('NONCE_KEY',        'F]@$!FOx/jDws0ETr.jeDnnocB< dk.B?/k[Q0fuupLq#B(#?Mzy+1l~rlqcP-y8');
define('AUTH_SALT',        'ptNb}yq*u6E|2j{F=FAZxP2^,wr,x+NE,GY3}n.w9i`;r%)z%krq/1h^K0;BZ)|F');
define('SECURE_AUTH_SALT', '$7mYc8MVyXM mk*16rXxHh>ZtvW:{ef;NGTZeu-g>EQ>Hpf<Q^wV;`Z}yoF%3:ci');
define('LOGGED_IN_SALT',   'M3/b:bDkbpmzXN!]K9CSB!ALf9J%X9{Cg;PRV#TcpKI>zd~GKaq#suM7@0L #|Z)');
define('NONCE_SALT',       'EWADEL.QpejjqMs]l~qTRBfa5&9V!*qvJl,IOIh4^Of!ysx=:-f z$sD#Qd>&(1P');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'hot_';

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
