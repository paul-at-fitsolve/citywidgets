<?php

namespace Drupal\citywidgets;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the City widgets plugin manager.
 */
class CityWidgetsManager extends DefaultPluginManager {

  /**
   * Constructs a new CityWidgetsManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/CityWidgets', $namespaces, $module_handler, 'Drupal\citywidgets\CityWidgetsInterface', 'Drupal\citywidgets\Annotation\CityWidgets');
    $this->alterInfo('citywidgets_city_widgets_info');
    $this->setCacheBackend($cache_backend, 'citywidgets_city_widgets_plugins');
  }

  public function getWidgets() {
    $plugins = array_keys($this->getDefinitions());
    $enabled_plugins = [];
    foreach ($plugins as $plugin_id) {
      $plugin = $this->createInstance($plugin_id);
      $enabled_plugins[] = $plugin;
    }
    // Always return plugins in the same order.
    asort($enabled_plugins);
    return $enabled_plugins;
  }
}
