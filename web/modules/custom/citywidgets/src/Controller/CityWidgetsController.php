<?php

namespace Drupal\citywidgets\Controller;

use Drupal\citywidgets\CityWidgetsManager;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CityWidgetsController.
 */
class CityWidgetsController extends ControllerBase
{

    protected $cityWidgetManager;
    private $loggerChannelFactoryInterface;

  /**
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  private $weatherGetter;


  /**
   * CityWidgetsController constructor.
   *
   * @param \Drupal\citywidgets\CityWidgetsManager $city_widget_manager
   */
    public function __construct(CityWidgetsManager $city_widget_manager)
    {
      $this->cityWidgetManager = $city_widget_manager;
    }

  /**
   * @param $city
   *
   * @return array
   */
    public function displayWidgets($city)
    {
        $markup = '<p>No widgets to display</p>';
        $widgets = $this->cityWidgetManager->getWidgets();
        foreach ($widgets as $widget) {
          if ($widget->getPluginId() == 'weather_widget') {
            $markup = $widget->getForecast($city);
          }
        }
        return $markup;
    }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return \Drupal\citywidgets\Controller\CityWidgetsController|\Drupal\Core\Controller\ControllerBase
   */
    public static function create(ContainerInterface $container) {
        // Inject the plugin.manager.citywidgets service that represents our plugin
        // manager as defined in the city_widgets.services.yml file.
        $citywidgets = $container->get('plugin.manager.citywidgets');
        return new static($citywidgets);
    }

}
