<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 26/12/19
 * Time: 11:21
 */

namespace Drupal\citywidgets\Plugin\Block;


use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Class HelloBlock
 *
 * @Block(
 *   id="hello_block",
 *   admin_label=@Translation("Hello Block"),
 *   category=@Translation("Hello World"),
 * )
 * @package Drupal\citywidgets\Plugin\Block
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   * @return array
   */
  public function build() {
    return [
      '#markup' => $this->t('Hello Monkey!'),
    ];
  }


}