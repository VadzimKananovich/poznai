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
define('AUTH_KEY',         'qYlx mLZE`2MSdfTx{wp^{r mO;w=AUV]Z?<Q,ytTLn>!mOeA,X#P=xAZdOD;~rA');
define('SECURE_AUTH_KEY',  'MzP?pf#$YnWm@:I4kyF/P_~]Lzkpwd<R_6 QbK;N5M8x0WaJWp{cKa .S1fP(LIU');
define('LOGGED_IN_KEY',    'lm^%c?F7PB G6t}/`&vEVt# AOo71)ATiWhp{_[,LhZb`eM62&udc0K6zD-4tBW#');
define('NONCE_KEY',        'V@X!$Al#1KwyDss[}[g&cABF}HySJJ0`GFry$rt3l&Gxz IniSe:VWxt</VM5lB~');
define('AUTH_SALT',        ' -*Y4zg.pO6amHfuNooagy%74r>3MIkHDjk_bpUY&0v6u:fT]@P -;{,3PZC=d!P');
define('SECURE_AUTH_SALT', '[upNC{^, KS$8qEu%]#nca&*~ERQUVO)gF`&!fRTiplEnbV,[3W#lm1e<w]?imcd');
define('LOGGED_IN_SALT',   '?tfx]I1k7E=yP*A+`J/3[qjUZ]n4R]?qA(Sd(R:?OOuvTwIEZt#3GZYTh-miMWds');
define('NONCE_SALT',       ' 4kxj|ee9tu4K*F9Rg4,pv/E0Re@O`8=d{}Q >2^m*%@9^-II em30Z$FK4q^05 ');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'lpzat_';

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
