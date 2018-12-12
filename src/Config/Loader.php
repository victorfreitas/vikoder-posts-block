<?php
/**
 *
 * Loader controllers
 *
 * @package Vikoder\Config\Loader
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

namespace Vikoder\Config;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

abstract class Loader {

	protected $controllers = [];

	protected function __construct() {
		$this->setup();
		$this->init_controllers();
	}

	protected function setup() {

	}

	protected function init_controllers() {
		foreach ( $this->controllers as $controller ) :
			$class = sprintf( 'Vikoder\Controller\%s', $controller );

			if ( class_exists( $class ) ) {
				new $class();
			}
		endforeach;
	}
}
