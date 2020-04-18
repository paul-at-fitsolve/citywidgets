<?php

namespace Drupal\citywidgets;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for City widgets plugins.
 */
abstract class CityWidgetsBase extends PluginBase implements CityWidgetsInterface {

    protected $city;

  // Add common methods and abstract methods for your plugin type here.

    public function buildWidget() {

        return [
            '#type' => 'markup',
            '#markup' => $this->t('Implement method: buildWidget')
        ];

    }

    abstract public function getForecast($city);

}
