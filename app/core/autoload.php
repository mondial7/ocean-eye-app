<?php

/**
 * Load application core
 */
class CoreLoader {

	/**
	 * List of file to be included
	 * @var Array[String]
	 */
	public static $files = [
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

}

/**
 * Require all core scripts
 */
foreach (CoreLoader::$files as $path) {

  require_once __DIR__ . DIRECTORY_SEPARATOR . $path;

}
