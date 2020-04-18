<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 30/10/19
 * Time: 17:53
 */

namespace Drupal\citywidgets\Plugin\CityWidgets;

use Drupal\citywidgets\CityWidgetsBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a weather widget.
 *
 * Because the plugin manager class for our plugins uses annotated class
 * discovery, our weather widget only needs to exist within the
 * Plugin\CityWidgets namespace, and provide a CityWidgets annotation to be declared
 *  as a plugin. This is defined in
 * \Drupal\citywidgets\CityWidgetsManager::__construct().
 *
 * The following is the plugin annotation. This is parsed by Doctrine to make
 * the plugin definition. Any values defined here will be available in the
 * plugin definition.
 *
 * This should be used for metadata that is specifically required to instantiate
 * the plugin, or for example data that might be needed to display a list of all
 * available plugins where the user selects one. This means many plugin
 * annotations can be reduced to a plugin ID, a label and perhaps a description.
 *
 * @CityWidgets(
 *   id = "weather_widget",
 *   description = @Translation("This is a widget that gives a 5 day weather forecast for a city."),
 * )
 */

class WeatherWidget extends CityWidgetsBase implements ContainerFactoryPluginInterface
{

  /**
   * @var \Drupal\http_client_manager\HttpClient
   */
  private $http_client;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, Client $http_client){
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->http_client = $http_client;
  }
  public function getForecast($city) {
    $query_string['query'] = [
      'q' => $city,
      'APPID' => '9665bbaa3b0011dcfbc49af0a7115655',
      'units' => 'metric',
      ];
    $request = $this->http_client->request('GET', 'http://api.openweathermap.org/data/2.5/weather', $query_string);
    $response= $request->getBody()->getContents();
    $weather_data = json_decode($response);
    //dd($weather_data);
    $attached['drupalSettings']['weather_data'] = ['city' => $city, 'temperature' => $weather_data->main->temp, 'icon' => $weather_data->weather[0]->icon];
    return [
      '#theme' => 'citywidgets_weather_widget',
      '#attached' => $attached,
    ];
  }


  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('http_client')
    );
  }
}