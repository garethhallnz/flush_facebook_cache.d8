<?php

namespace Drupal\facebook_flush_cache\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\facebook_flush_cache\FacebookFlushCacheService;

/**
 * Default controller for the simple_currency_converter module.
 */
class DefaultController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function execute($entity = NULL) {

    $url = Url::fromRoute('entity.node.canonical', ['node' => $entity->id()], ['absolute' => TRUE]);

    $service = new FacebookFlushCacheService();

    $service->execute($url->toString());

  }

}
