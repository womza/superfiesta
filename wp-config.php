<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'superfiesta');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'U+>|POtzc_++E-T6`YN}-q&ue>9/ la>1vW,+6<.R%pythlOky3`#=iDLCBsLt{+');
define('SECURE_AUTH_KEY', 'CsW_k> RM-24A&?SP^NkK%g=1[G#wD~xr~Jt^P;Kg3u|I<A; })J{<!2 #3HK E+');
define('LOGGED_IN_KEY', 'u~rMh]*as>HoDl.ap7mShO*1sbpj$PQA5Kdi!3-N-4;1?O-$8CHj-Ln^8@~DA%As');
define('NONCE_KEY', 'N -,M$|iP3xaR3QHemPh=?LM+O-3A4YWlUe,-LYbFTT96Q+F0,)/6RpI=z1-@[zy');
define('AUTH_SALT', 'A*ru:RA,M_9PxXjZ2[m,k[stkVh6#r,$Sf&]>]5plA388k$l_>$QffE3gRPv>aAM');
define('SECURE_AUTH_SALT', 'Glpi;y+BR9O;y<{WXAx2ui:Q-k+i`iH)]>Ig|f@[:s;cMERNF,kdl>`C|,#>s|w;');
define('LOGGED_IN_SALT', 'Ks<+L:(0Y)TWi(;H1[ChKD:=-}[$MU87VO2g0`L^LI[~9c=7P|x#6eFSQ{=KGE?`');
define('NONCE_SALT', 'v%#c}=&%L2r~|xb-CHIS4R`J#oN|ICSw9(],C6oYw#yZ/kqNMCmg{pK+*Uh,DE_o');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

