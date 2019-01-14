<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'lXQ5ngPRHTqEIgnwmkZPcfUoHTkbkzgKSYfG3QvtTC0XexD+pduEU6hwkbx4C4KTG9kSDpDhD+7EnHyknFXPcA==');
define('SECURE_AUTH_KEY',  'XVKCE3VdKUcj/nxX3jTvFn6DYsmxbQ8c62Tdg/80/UDhLGQAdbRMwWS497zrZNfBDHBbadzFdmEPd5OBP/eMIQ==');
define('LOGGED_IN_KEY',    'uiLgIAeLoJaCuaOyQUAqaeld1zvCFzNsAnALOgQrQ8X2QXjfLNdy6IQXuIuKuBaqvCxolYIA1oRzzxkwII2LIQ==');
define('NONCE_KEY',        'q0V3I7smrSfsbO05iRokKCkZnv2UR6MGDx+u+vY1gcxGG8HixTQncTV4mIAiclhOzDEG4GPmGrZHSp0qbAqDWw==');
define('AUTH_SALT',        'aMpxlk+TvNPo1TwJNSi3k96pLWEmcRfNI3onU5SeJL/BsEequH1xrMEXvrpJ3sPwSTuv3qvMTD9AuNjsP4FCFw==');
define('SECURE_AUTH_SALT', 'zFHzMlQIohhqrnFrjPUbL9u6WmJui9cnUliMd+oX51sjhFIsv+83YumbAgVlchnGjM2zxkix/FW3WUuOB82pZw==');
define('LOGGED_IN_SALT',   'hTWs3E3ttDBuZzY4vm//H0aDs0eIrCemVlVIGDQLcCAVqrmRlupNH/V1NL/9BDOlssrdMlrTPCktTV/Olydj5w==');
define('NONCE_SALT',       'QusQaFJbSAOKyhs+KEEWr8b4qjnawofoCyIxZu948roTZbluzIiE3od3l5GtGuhZbF4a+w38rpLYNmNvh7qSXw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
