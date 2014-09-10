<?php


namespace Drupal\d8plugin_field;


use Drupal\d8plugin\Plugin\ConfigurablePluginInterface;
use Drupal\d8plugin_field\FieldInfo\EntityTypeField;
use Drupal\d8plugin_field\FieldInfo\FieldDisplay;
use Drupal\d8plugin_field\Formatter\FormatterPluginManager;
use Drupal\d8plugin_field\Formatter\FormatterPrepareViewInterface;
use Drupal\d8plugin_field\ItemList\AlterableFieldItemList;

/**
 * prepare_view() is complex, because we need to distribute the arguments to the
 * correct plugins.
 *
 * @see hook_field_formatter_prepare_view()
 * @see d8plugin_field_field_formatter_prepare_view()
 * @see PrepareViewInterface
 */
class PrepareViewHandler {

  /**
   * @var FormatterPluginManager
   */
  private $manager;

  /**
   * @param FormatterPluginManager $manager
   */
  function __construct(FormatterPluginManager $manager) {
    $this->manager = $manager;
  }

  /**
   * @param string $entity_type
   * @param object[] $entities
   * @param array $field
   * @param array[] $instances
   * @param string $langcode
   * @param array[][] $items
   * @param array[] $displays
   *
   * @see hook_field_formatter_prepare_view()
   * @see d8plugin_field_field_formatter_prepare_view()
   */
  function handlePrepareView($entity_type, $entities, $field, $instances, $langcode, &$items, $displays) {
    $filteredIds = $this->filterDisplaysByFormatterId($displays);
    if (empty($filteredIds)) {
      return;
    }
    $entityTypeField = new EntityTypeField($entity_type, $field);
    foreach ($filteredIds as $pluginId => $entityIds) {
      $plugin = $this->manager->createInstance($pluginId);
      if (!$plugin instanceof FormatterPrepareViewInterface) {
        continue;
      }
      $distinctDisplays = array();
      $entityIds = array();
      foreach ($entityIds as $entityId) {
        $display = $displays[$entityId];
        $md5 = md5(serialize($display));
        $entityIds[$md5][] = $entityId;
        $distinctDisplays[$md5] = $display;
      }
      foreach ($distinctDisplays as $md5 => $display) {
        if ($plugin instanceof ConfigurablePluginInterface) {
          $plugin->setConfiguration($display['settings']);
        }
        $itemLists = [];
        foreach ($entityIds[$md5] as $entityId) {
          $itemLists[$entityId] = new AlterableFieldItemList(
            $entities[$entityId],
            new FieldDisplay($entity_type, $field, $instances[$entityId], $display),
            $langcode,
            $items[$entityId]
          );
        }
        $plugin->prepareView($itemLists, $entityTypeField);
      }
    }
  }

  /**
   * @param array[] $displays
   *   Format: $[$entityId] = $display
   *
   * @return int[][]
   *   Format: $[$pluginId][] = $entityId
   */
  private function filterDisplaysByFormatterId($displays) {
    $pluginIds = array();
    foreach ($this->groupDisplaysByFormatterId($displays) as $pluginId => $entityIds) {
      $pluginDefinition = $this->manager->getDefinition($pluginId);
      if ($pluginDefinition && $pluginDefinition->hasPrepareView()) {
        $pluginIds[$pluginId] = $entityIds;
      }
    }
    return $pluginIds;
  }

  /**
   * @param array[] $displays
   *   Format: $[$entityId] = $display
   *
   * @return int[][]
   *   Format: $[$pluginId][] = $entityId
   */
  private function groupDisplaysByFormatterId($displays) {
    $pluginIds = [];
    foreach ($displays as $entityId => $display) {
      $pluginIds[$display['type']][] = $entityId;
    }
    return $pluginIds;
  }

} 
