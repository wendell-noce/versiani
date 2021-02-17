<?php

/** Enable W3 Total Cache */

//define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'db_versiani-v3-prod' );


/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'versiani-db-user' );


/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'ms8Z!C3cgc4DPU6' );


/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );


/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );


/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
// define( 'AUTH_KEY',         'ln:Vgwr82C,?46OuJz?$!e`z2}]OWR]>Vm[|H|UL|ScFYy&[:M4[x=HE;]]M<%/k' );

// define( 'SECURE_AUTH_KEY',  'Uv}>.]k8d}Qbo]#P]@|M<;StNV f)VvBDW,fMuq?)6Xu[&BJWid,5n%,/[#h,{%;' );

// define( 'LOGGED_IN_KEY',    ';QT3OC6S5sNu]i/,V7S)Hi`*p|ERgjdHp]f1fIZ`=F|$pnN_G&5a0 wlYU~_<`bA' );

// define( 'NONCE_KEY',        'ei>sw@Kl`>USKlz#EPNC3!#$Eim>2UGR6f!M?J(-H*Xa Qk1l(:fA8l@4-a3l#Zo' );

// define( 'AUTH_SALT',        '.I6TjCcp2(^ u$;a[l.!bEBTRA|A`ylU5-t0=O02DEYB;q[EJGcu[|@R9bX^`<^I' );

// define( 'SECURE_AUTH_SALT', 'T7G~kIRV3rFO:ACsNb0+{l-J/5BJwOCn>Yv=ne=bFf5/M7oOE>PIqg3pLe?PGjWa' );

// define( 'LOGGED_IN_SALT',   ',8.,x>o5l|4_QV[pdyOXb{m&|`ylMPsl*m?^`i/FWkjwv$U`9&gSh[Q6PoTRpKlC' );
// define( 'NONCE_SALT',       '%rWR>?x!K7(RcB%w:YiM1?g^CkG+{-RKEX!Vu2[F;yYG?yzG((d6shF`GaSqpa+A' );

	define( 'AUTH_KEY',         'BSMt2[sMGO-9-L]>mrNqRME,y|8C-H-3iRtG2%GRQCSyH S<m3Es$XBZrc=is!aI' );
define( 'SECURE_AUTH_KEY',  '_=_)Ol$,^njMQKX?&O@=DklL0]0.KER/c}k<kLy34XaIx7#4a4&QReL 8}2Y{yCe' );
define( 'LOGGED_IN_KEY',    '3bkAn#-72Y67%pOD<(2ek(-R]4o&f^d]*usyyBY&f98Q[7XLqUZ.1}Yw%Fzc0$NR' );
define( 'NONCE_KEY',        'l,<BBhh!# F&r[OR*BgROPRmhE76+ubhOOOunW,Q?-Ilw%_Qg9R=Xz_;1>QBcS7J' );
define( 'AUTH_SALT',        '|Gt<tm-I2##/^C#mP=a$1&Fyq$jm3%D(IF2jdh|@X?s*o;3?d%LmHT>4)?JMPp;b' );
define( 'SECURE_AUTH_SALT', 'L%`ux! !=Tu=RnV]uy/C[e^#t_,4D#V8-G^G/ATaI2cJX?Flmb@I6G^=i8l)6D},' );
define( 'LOGGED_IN_SALT',   'T^=k}HOU3yN@4^*_FyY7NTJw~m}]-._O@STaaR%t0~-IZC^t;3-9L0C)!m[_&0g{' );
define( 'NONCE_SALT',       'B) Q?!3PMZw;;MGn{deZ9<)d/tVKn],CA%Gs480]7JtVgN~27%`6Z2,[O%|L>{d;' );


/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';


/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
