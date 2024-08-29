<?php

/**
 * -------------------------------------------------------------------------
 * phpcas plugin for GLPI
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of phpcas.
 *
 * phpcas is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * any later version.
 *
 * phpcas is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with phpcas. If not, see <http://www.gnu.org/licenses/>.
 * -------------------------------------------------------------------------
 * @copyright Copyright (C) 2013-2022 by phpcas plugin team.
 * @license   GPLv2 https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/infotelglpi/phpcas
 * -------------------------------------------------------------------------
 */

define('PLUGIN_PHPCAS_VERSION', '1.0.0');

// Minimal GLPI version, inclusive
define("PLUGIN_PHPCAS_MIN_GLPI_VERSION", "10.0.1");
// Maximum GLPI version, exclusive
define("PLUGIN_PHPCAS_MAX_GLPI_VERSION", "10.0.99");

define('PLUGIN_PHPCAS_ROOT', Plugin::getPhpDir('phpcas'));
/**
 * Init hooks of the plugin.
 * REQUIRED
 *
 * @return void
 */
function plugin_init_phpcas()
{
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['phpcas'] = true;

    if (!Plugin::isPluginActive('phpcas')) {
        return false;
    }

    include_once(PLUGIN_PHPCAS_ROOT . "/vendor/autoload.php");
}


/**
 * Get the name and the version of the plugin
 * REQUIRED
 *
 * @return array
 */
function plugin_version_phpcas()
{
    return [
        'name'           => 'phpcas',
        'version'        => PLUGIN_PHPCAS_VERSION,
        'author'         => "<a href='https://blogglpi.infotel.com'>Infotel</a>, Xavier Caillaud",
        'license'        => 'GPL-2.0-or-later',
        'homepage'       => '',
        'requirements'   => [
            'glpi' => [
                'min' => PLUGIN_PHPCAS_MIN_GLPI_VERSION,
                'max' => PLUGIN_PHPCAS_MAX_GLPI_VERSION,
            ]
        ]
    ];
}

function plugin_phpcas_check_prerequisites()
{
    if (!is_readable(__DIR__ . '/vendor/autoload.php') || !is_file(__DIR__ . '/vendor/autoload.php')) {
        echo "Run composer install --no-dev in the plugin directory<br>";
        return false;
    }

    return true;
}
