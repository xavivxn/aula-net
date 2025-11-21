<?php
/**
 * The base configuration for WordPress
 *
 * @package WordPress
 */

// ** Database settings - XAMPP configuration ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'aula_net_wp' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 */
define( 'AUTH_KEY',         'W3e!x@Kp#7mZ$qR8*vL2&hN9^jC5+bT1-dF6<sG4>yU0%aI3~wM' );
define( 'SECURE_AUTH_KEY',  'P8*rQ2@nV5#xL1!kM9&jH4^zC7+bD6-fT3<sY0>wG5%aU2~iN8' );
define( 'LOGGED_IN_KEY',    'L5!mK9@pH3#wN7*xQ1&jV4^zB8+cT2-dF6<sY0>rG5%aU3~iM9' );
define( 'NONCE_KEY',        'N7@xM3!pQ9#wK5*rL1&jH8^zV4+bC2-dT6<sF0>yG5%aU3~iN9' );
define( 'AUTH_SALT',        'Q9*xN5@pM1#wL7!rK3&jV8^zH4+bC2-dT6<sF0>yG5%aU9~iM3' );
define( 'SECURE_AUTH_SALT', 'M3!xQ7@pN9#wK1*rL5&jH8^zV4+bC2-dT6<sF0>yG5%aU3~iN9' );
define( 'LOGGED_IN_SALT',   'K5@xM9!pN3#wQ7*rL1&jV8^zH4+bC2-dT6<sF0>yG5%aU3~iM9' );
define( 'NONCE_SALT',       'L1*xN5@pM9#wK3!rQ7&jH8^zV4+bC2-dT6<sF0>yG5%aU3~iM9' );

/**#@-*/

/**
 * WordPress database table prefix.
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
