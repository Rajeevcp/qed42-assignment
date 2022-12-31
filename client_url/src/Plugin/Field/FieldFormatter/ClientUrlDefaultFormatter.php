<?php

namespace Drupal\client_url\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'ClientUrlDefaultFormatter' formatter.
 *
 * @FieldFormatter(
 *   id = "ClientUrlDefaultFormatter",
 *   label = @Translation("Client Url"),
 *   field_types = {
 *     "client_url"
 *   }
 * )
 */
class ClientUrlDefaultFormatter extends FormatterBase {

  /**
   * Define how the field type is showed.
   *
   * Inside this method we can customize how the field is displayed inside
   * pages.
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#type' => 'markup',
        '#markup' => $item->url_select ? str_replace('www.', '', $item->url) : '',
      ];
    }

    return $elements;
  }

}
