<?php

namespace Drupal\client_url\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'ClientUrlDefaultWidget' widget.
 *
 * @FieldWidget(
 *   id = "ClientUrlDefaultWidget",
 *   label = @Translation("Client Url"),
 *   field_types = {
 *     "client_url"
 *   }
 * )
 */
class ClientUrlDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'url_select' => 0,
    ] + parent::defaultSettings();
  }

  /**
   * Define the form for the field type.
   *
   * Inside this method we can define the form used to edit the field type.
   *
   * Here there is a list of allowed element types: https://goo.gl/XVd4tA
   */
  public function formElement(
    FieldItemListInterface $items,
    $delta,
    Array $element,
    Array &$form,
    FormStateInterface $formState
  ) {

    // Client URL.
    $file = file('modules/custom/client_url/source/domain.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $element['url'] = [
      '#type' => 'textfield',
      '#title' => t('Client URL'),
      '#size' => 7,
      '#maxlength' => 7,
      '#empty_value' => '',
      '#default_value' => $items[$delta]->url,
      '#placeholder' => t('Client Url'),
    ];

    $element += [
      'url_select' => [
        '#type' => 'checkbox',
        '#title' => $this->t('Select domain'),
        '#default_value' => $items[$delta]->url_select,
      ],
    ];
    return $element;
  }

}
