<?php
/**
 *
 * Controller I18n
 *
 * @package Vikoder\Controller\I18n
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

namespace Vikoder\Controller;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

use Vikoder\Helper\Utils;
use Vikoder\Config\App;

class I18n {

	public function __construct() {
		add_action( 'init', [ $this, 'init' ] );
	}

	public function init() {
		load_plugin_textdomain( App::SLUG, false, Utils::basename( '/i18n/languages' ) );
	}
}
