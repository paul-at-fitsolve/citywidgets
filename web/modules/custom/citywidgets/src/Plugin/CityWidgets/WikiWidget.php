<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 05/07/20
 * Time: 11:07
 */

namespace Drupal\citywidgets\Plugin\CityWidgets;

use Drupal\citywidgets\CityWidgetsBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* Provides a wiki widget.
 *
 * Because the plugin manager class for our plugins uses annotated class
 * discovery, our wiki widget only needs to exist within the
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
 *   id = "wiki_widget",
 *   description = @Translation("This is a widget that gives a Wikipedia overview for a city."),
 * )
 */

class WikiWidget extends CityWidgetsBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\http_client_manager\HttpClient
   */
  private $http_client;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, Client $http_client){
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->http_client = $http_client;
  }

  /**
   * @param $city
   *
   * @return array
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function getWiki($city) {
    $query_string['query'] = [
      'action' => 'query',
      'prop' => 'revisions',
      'rvprop' => 'content',
      'rvsection' => 0,
      'titles' => $city,
      'format' => 'json',
    ];

    $request = $this->http_client->request('GET', 'https://en.wikipedia.org/w/api.php', $query_string);
    $response= $request->getBody()->getContents();
    $wiki_data = json_decode($response);
    dd($wiki_data);
    $attached['drupalSettings']['weather_data'] = ['city' => $city, 'temperature' => $weather_data->main->temp, 'icon' => $weather_data->weather[0]->icon];
    return [
      '#theme' => 'citywidgets_weather_widget',
      '#attached' => $attached,
    ];
  }

}