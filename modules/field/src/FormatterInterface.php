<?php

namespace Drupal\d8plugin_field;

use Drupal\d8plugin_field\FieldInfo\EntityTypeFieldInterface;
use Drupal\d8plugin_field\FieldInfo\ViewModeFieldDisplayFormContextInterface;
use Drupal\d8plugin_field\FieldInfo\ViewModeFieldDisplayInterface;
use Drupal\d8plugin_field\ItemList\AlterableFieldItemListInterface;
use Drupal\d8plugin_field\ItemList\FieldItemListInterface;
use Drupal\d8plugin\Plugin\ConfigurablePluginInterface;

/**
 * Interface definition for field formatter plugins.
 *
 * @ingroup field_formatter
 *
 * @see \Drupal\pluginapi\Field\Annotation\FieldFormatter
 */
interface FormatterInterface extends ConfigurablePluginInterface {

  /**
   * Returns a form to configure settings for the formatter.
   *
   * Invoked from \Drupal\field_ui\Form\FieldInstanceEditForm to allow
   * administrators to configure the formatter. The field_ui module takes care
   * of handling submitted form values.
   *
   * @param ViewModeFieldDisplayFormContextInterface $context
   *
   * @return array
   *   The form elements for the formatter settings.
   *
   * @see hook_field_formatter_settings_form
   */
  public function settingsForm(ViewModeFieldDisplayFormContextInterface $context);

  /**
   * Returns a short summary for the current formatter settings.
   *
   * If an empty result is returned, a UI can still be provided to display
   * a settings form in case the formatter has configurable settings.
   *
   * @param ViewModeFieldDisplayInterface $context
   *
   * @return string
   *   A short summary of the formatter settings.
   *
   * @see hook_field_formatter_settings_summary()
   */
  public function settingsSummary(ViewModeFieldDisplayInterface $context);

  /**
   * Allows formatters to load information for field values being displayed.
   *
   * This should be used when a formatter needs to load additional information
   * from the database in order to render a field, for example a reference
   * field that displays properties of the referenced entities such as name or
   * type.
   *
   * This method operates on multiple entities. The $entities_items parameter
   * is an array keyed by entity ID. For performance reasons, information for
   * all involved entities should be loaded in a single query where possible.
   *
   * Changes or additions to field values are done by directly altering the
   * items.
   *
   * @param AlterableFieldItemListInterface[] $entities_items
   *   Alterable field items by entity.
   *   Format: $[$entity_id] = $items
   * @param EntityTypeFieldInterface $entity_type_field
   *   Entity type and field definition.
   *   This is the same across all entities and instances.
   *
   * @return
   * @see hook_field_formatter_prepare_view()
   */
  public function prepareView(array $entities_items, EntityTypeFieldInterface $entity_type_field);

  /**
   * Builds a renderable array for a fully themed field.
   *
   * @param FieldItemListInterface $items
   *   The field values to be rendered.
   *   Also provides the entity and the context.
   *
   * @return array
   *   A renderable array for a themed field with its label and all its values.
   *
   * @see hook_field_formatter_view()
   */
  public function view(FieldItemListInterface $items);

} 
