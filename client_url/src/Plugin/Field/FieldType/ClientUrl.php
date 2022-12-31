<?php

namespace Drupal\client_url\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface as StorageDefinition;

/**
 * Plugin implementation of the 'client url' field type.
 *
 * @FieldType(
 *   id = "client_url",
 *   label = @Translation("Client URL"),
 *   description = @Translation("Stores client url."),
 *   category = @Translation("Custom"),
 *   default_widget = "ClientUrlDefaultWidget",
 *   default_formatter = "ClientUrlDefaultFormatter",
 *   locked = true,
 *   hidden = true
 * )
 */
class ClientUrl extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      'url_select' => 0,
    ];
  }

  /**
   * Field type properties definition.
   *
   * Inside this method we defines all the fields (properties) that our
   * custom field type will have.
   *
   * Here there is a list of allowed property types: https://goo.gl/sIBBgO
   */
  public static function propertyDefinitions(StorageDefinition $storage) {

    $properties = [];
    $properties['url_select'] = DataDefinition::create('boolean')
      ->setLabel(t('Select'))
      ->setDescription(t("Select URL"));

    $properties['url'] = DataDefinition::create('string')
      ->setLabel(t('URL'));
    return $properties;
  }

  /**
   * Field type schema definition.
   *
   * Inside this method we defines the database schema used to store data for
   * our field type.
   *
   * Here there is a list of allowed column types: https://goo.gl/YY3G7s
   */
  public static function schema(StorageDefinition $storage) {
    $file = file('modules/custom/client_url/source/domain.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $columns = [];
    $columns['url_select'] = [
      'description' => t("Select URL"),
      'type' => 'int',
      'unsigned' => TRUE,
      'default' => 0,
    ];
    $columns['url'] = [
      'type' => 'char',
      'length' => 255,
    ];

    return [
      'columns' => $columns,
      'indexes' => [],
    ];
  }

  /**
   * Define when the field type is empty.
   *
   * This method is important and used internally by Drupal. Take a moment
   * to define when the field fype must be considered empty.
   */
  public function isEmpty() {

    $isEmpty =
      empty($this->get('url')->getValue());

    return $isEmpty;
  }

}
