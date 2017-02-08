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
   * {@inheritdoc}
   */
  public function execute($entity = NULL) {

    /* @var $entity \Drupal\Core\Entity\Entity */
    $url = Url::fromRoute('entity.node.canonical', ['node' => $entity->id()], ['absolute' => TRUE]);

    $service = new FacebookFlushCacheService();

    $service->execute($url->toString());

  }

  /**
   * {@inheritdoc}
   */
  public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE) {
    $access = $object->access('update', $account, TRUE)
      ->allowedIf($account->hasPermission('flush facebook cache'));
    return $return_as_object ? $access : $access->isAllowed();
  }

}
