<?php

namespace Drupal\facebook_flush_cache\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\facebook_flush_cache\FacebookFlushCacheService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

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

    $notFoundUrl = \Drupal::config('system.site')->get('page.404');

    if (!empty($notFoundUrl)) {
      return new RedirectResponse($notFoundUrl);
    }

    return new Response(t('Url was not found or is invalid'), 404);

  }

}
