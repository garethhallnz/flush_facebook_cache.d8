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
  public function execute($nid) {

    $url = Url::fromRoute('entity.node.canonical', ['node' => $nid], ['absolute' => TRUE]);

    if ($url) {

      $service = new FacebookFlushCacheService();

      $url = $url->toString();

      $service->execute($url);

      return new RedirectResponse($url);
    }

    // @todo Need to return a Response
  }

}
