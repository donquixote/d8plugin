<?php
namespace Drupal\d8plugin_field\Formatter\Context;

use Drupal\d8plugin_field\FieldInfo\EntityTypeFieldInterface;

interface FormatterPrepareViewContextInterface extends \ArrayAccess, EntityTypeFieldInterface {

  /**
   * @param int $entityId
   *
   * @return object
   */
  function getEntity($entityId);

  /**
   * @param int $entityId
   *
   * @return array
   */
  function getInstance($entityId);

  /**
   * @param int $entityId
   *
   * @return array
   */
  function getDisplay($entityId);

  /**
   * @param int $entityId
   *
   * @return mixed
   */
  function getSettings($entityId);

  /**
   * @return string
   */
  function getLangcode();

}
