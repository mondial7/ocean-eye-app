<?php

/**
 * Load application core and initiate request evaluation
 */
class EKE {

	/**
	 * List of file to be included
	 * @var Array[String]
	 */
	private static $files = [
		'config/config.php', // Global variables
		'controller/_functions.php', // Controllers functions
		'controller/EKEApiController.php', // Api controller
		'controller/EKETwig.php', // Twig Loader
		'database/EKEDB.php', // Database connection
		'model/EKELog.php', // Log Model (stores in core/logs/)
		'model/EKEMail.php', // Email Model
		'model/EKEModel.php', // Abstract Model -> modifiers / db interactions
		'model/EKEEntityModel.php', // Entity Model -> validation/sanitization
		'router/DumpRouter.php' // Router -> select controller
	];

	/**
	 * Run application
	 *
	 * @param Array[Mixed]	application setup
	 * @return Void
	 */
	public static function go($setup = null) {
		// validate configs
		if (self::_validSetup($setup)) {
			exit('Invalid setup');
		}
		// Require all core scripts
		foreach (self::$files as $path) {
		  require_once __DIR__ . DIRECTORY_SEPARATOR . $path;
		}
		// include 'before' scripts
		if (isset($setup['before']) && count($setup['before'])>0) {
			foreach ($setup['before'] as $script) {
				require_once CONTROLLERS_DIR . "/helpers/$script.php";
			}
		}
		// register routes
		if (isset($setup['routes']) && count($setup['routes'])>0) {
			foreach ($setup['routes'] as $route => $options) {
				DumpRouter::route($route, $options);
			}
		}
		// enable api controller
		if (isset($setup['api']) && $setup['api'] === true) {
			DumpRouter::route('api',['pretty_parameters' => ['feature','action']]);
		}
		// evaluate uri path and include the selected controller
		require DumpRouter::loadController(
		  $_SERVER['REQUEST_URI'],
			$setup['controllersDir'] ?? null
		);
		// include 'after' scripts
		if (isset($setup['after']) && count($setup['after'])>0) {
			foreach ($setup['after'] as $script) {
				require_once CONTROLLERS_DIR . $script;
			}
		}
	}

	/**
	 * Validate setup configurations
	 *
	 * @param Array[Mixed] application setup
	 * @return Boolean
	 */
	private static function _validSetup($setup) {
		return !$setup || count($setup)<1;
	}

}
