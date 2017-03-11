<?php

namespace Drupal\facebook_flush_cache\Plugin\Action;

use Drupal\Core\Action\ActionBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\facebook_flush_cache\FacebookFlushCacheService;

/**
 * Flush Facebook cache for given node and its url.
 *
 * @Action(
 *   id = "facebook_flush_cache_action",
 *   label = @Translation("Flush Facebook Cache"),
 *   type = "node"
 * )
 */
class FacebookFlushCache extends ActionBase {

  /**
   * FacebookFlushCacheService.
   *
   * @var \Drupal\facebook_flush_cache\FacebookFlushCacheService
   */
  protected $facebookCacheService;

  /**
   * {@inheritdoc}
   */
  public function execute($node) {

    $url = Url::fromRoute('entity.node.canonical', ['node' => $node], ['absolute' => TRUE]);

    if ($url) {

      $url = $url->toString();

      $this->facebookCacheService->clearCache($url);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE) {
    $access = $object->access('update', $account, TRUE)
      ->allowedIf($account->hasPermission('flush facebook cache'));
    return $return_as_object ? $access : $access->isAllowed();
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('facebook_flush_cache.service')
    );
  }

}
