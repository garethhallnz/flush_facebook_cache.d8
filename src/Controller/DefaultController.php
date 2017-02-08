<?php

namespace Drupal\facebook_flush_cache\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\facebook_flush_cache\FacebookFlushCacheService;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Default controller for the simple_currency_converter module.
 */
class DefaultController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function execute($node) {

    $url = Url::fromRoute('entity.node.canonical', ['node' => $node], ['absolute' => TRUE]);

    if ($url) {

      $service = new FacebookFlushCacheService();

      $url = $url->toString();

      $service->execute($url);

      drupal_set_message(t("Facebook's cache has been cleared"));

      return new RedirectResponse($url);
    }

//    drupal_set_message(t("Could not determine the url to clear Facebook's cache."), 'warning');
  }

}
