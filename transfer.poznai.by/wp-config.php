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
define('AUTH_KEY',         '((0IeT]q#y2!;*xF^_Nl[c[qA1^&oNL5k>IX-iPs!-O&Ivww:TXe/wja w0~VdxL');
define('SECURE_AUTH_KEY',  '<Sz{Y&w;0x[mc[}y:sI7tyu.X7eK#57F`/1OWV|5#y:8%DM`:%WG,Zxr]NIolTtQ');
define('LOGGED_IN_KEY',    'lt5X`Zu=N>aEkt74&/2gG1-5wxc75m(>H(v >CVc0GFc~+bVtw`Ri3gFY%+O,:6!');
define('NONCE_KEY',        'MG-]!63YHj^huARIIn:T<t.v9J2pD2;x)+[w1XePxmz=RnI{+!5bFT f=DD?.mb%');
define('AUTH_SALT',        'XR=gB3Pm)a(u>GG{w0?* pi=du/ eWER!ti[Vn;A`B#>o-rn?#[sI.[jP~c9e!s@');
define('SECURE_AUTH_SALT', 'Z%UK~K0)BU>PV`8$vCsbn<4W}|k<.pSHu$[vUkS/J* .u;eUkr@:{8Gf8s.z=41[');
define('LOGGED_IN_SALT',   '}Jg]#W)vyst(Hh;;n=ISEYn)ycr!M81O&K;HeI,~Ol%e0g4B`(2.eP^7sBz?RcOX');
define('NONCE_SALT',       '#;YQxPNK{woT*XG*u2~sUbTR4)z$d`7{k1o qx5ZHtt{P!<9:xm`SeoRa=OF=vdT');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'tran_';

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
