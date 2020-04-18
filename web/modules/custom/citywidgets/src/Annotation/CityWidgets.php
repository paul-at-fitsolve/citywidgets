<?php

namespace Drupal\citywidgets\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a City widgets item annotation object.
 *
 * @see \Drupal\citywidgets\Plugin\CityWidgetsManager
 * @see plugin_api
 *
 * @Annotation
 */
class CityWidgets extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
