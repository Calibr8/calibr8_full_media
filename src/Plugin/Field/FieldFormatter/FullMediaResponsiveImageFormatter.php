<?php

namespace Drupal\calibr8_full_media\Plugin\Field\FieldFormatter;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Url;
use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatterBase;
use Drupal\responsive_image\Entity\ResponsiveImageStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Utility\LinkGeneratorInterface;
use Drupal\responsive_image\Plugin\Field\FieldFormatter\ResponsiveImageFormatter;

/**
 * Plugin for responsive image formatter.
 *
 * @FieldFormatter(
 *   id = "full_media_responsive_image",
 *   label = @Translation("Full Media: Responsive image"),
 *   field_types = {
 *     "image",
 *   },
 *   quickedit = {
 *     "editor" = "image"
 *   }
 * )
 */
class FullMediaResponsiveImageFormatter extends ResponsiveImageFormatter implements ContainerFactoryPluginInterface {


  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
    

    $entity = $items->getEntity();
    foreach ($elements as $delta => $element) {
    	//$item = $element['item'];
    	$elements[$delta]['#item']->alt = $entity->get('field_alt')->getString();
    	$elements[$delta]['#item']->title = $entity->get('field_title')->getString();
    	$elements[$delta]['#item_attributes']['data-caption'] = $entity->get('field_caption')->getString();
    }

    return $elements;
  }


}
