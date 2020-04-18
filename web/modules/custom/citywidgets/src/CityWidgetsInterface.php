<?php

namespace Drupal\citywidgets;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for City widgets plugins.
 */
interface CityWidgetsInterface extends PluginInspectionInterface {


  // Add get/set methods for your plugin type here.

    public function getForecast($city);

}
