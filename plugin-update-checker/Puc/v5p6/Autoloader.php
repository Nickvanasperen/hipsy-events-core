<?php

namespace YahnisElsts\PluginUpdateChecker\v5p6;

if ( !class_exists(Autoloader::class, false) ):

	class Autoloader {
		const DEFAULT_NS_PREFIX = 'YahnisElsts\\PluginUpdateChecker\\';

		private $prefix;
		private $rootDir;
		private $libraryDir;

		private $staticMap;

		public function __construct() {
			$this->rootDir = dirname(__FILE__) . '/';

			$namespaceWithSlash = __NAMESPACE__ . '\\';
			$this->prefix = $namespaceWithSlash;

			$this->libraryDir = $this->rootDir . '../..';
			if ( !self::isPhar() ) {
				$this->libraryDir = realpath($this->libraryDir);
			}
			$this->libraryDir = $this->libraryDir . '/';

			$isCustomNamespace = (
				substr($namespaceWithSlash, 0, strlen(self::DEFAULT_NS_PREFIX)) !== self::DEFAULT_NS_PREFIX
			);
			$libraryPrefix = $isCustomNamespace ? $namespaceWithSlash : '';

			$this->staticMap = array(
				$libraryPrefix . 'PucReadmeParser' => 'vendor/PucReadmeParser.php',
				$libraryPrefix . 'Parsedown'       => 'vendor/Parsedown.php',
			);

			// Add the generic, major-version-only factory class to the static map.
			// This repository contains Puc/v5/PucFactory.php, not Puc/v5/Factory.php.
			$versionSeparatorPos = strrpos(__NAMESPACE__, '\\v');
			if ( $versionSeparatorPos !== false ) {
				$versionSegment = substr(__NAMESPACE__, $versionSeparatorPos + 1);
				$pointPos = strpos($versionSegment, 'p');
				if ( ($pointPos !== false) && ($pointPos > 1) ) {
					$majorVersionSegment = substr($versionSegment, 0, $pointPos);
					$majorVersionNs = __NAMESPACE__ . '\\' . $majorVersionSegment;
					$this->staticMap[$majorVersionNs . '\\PucFactory'] =
						'Puc/' . $majorVersionSegment . '/PucFactory.php';
				}
			}

			spl_autoload_register(array($this, 'autoload'));
		}

		private static function isPhar() {
			static $pharProtocol = 'phar://';
			return (substr(__FILE__, 0, strlen($pharProtocol)) === $pharProtocol);
		}

		public function autoload($className) {
			if ( isset($this->staticMap[$className]) && file_exists($this->libraryDir . $this->staticMap[$className]) ) {
				include($this->libraryDir . $this->staticMap[$className]);
				return;
			}

			if ( strpos($className, $this->prefix) === 0 ) {
				$path = substr($className, strlen($this->prefix));
				$path = str_replace(array('_', '\\'), '/', $path);
				$path = $this->rootDir . $path . '.php';

				if ( file_exists($path) ) {
					include $path;
				}
			}
		}
	}

endif;
