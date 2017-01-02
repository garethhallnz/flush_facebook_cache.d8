<?php

namespace Drupal\facebook_flush_cache\Plugin\Action;

use Drupal\Core\Action\ActionBase;
use Drupal\Core\Session\AccountInterface;

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

    $url = \Drupal\Core\Url::fromRoute('entity.node.canonical', ['node' => $entity->id()], ['absolute' => TRUE]);

    $client = \Drupal::httpClient();
    $request = $client->post('https://graph.facebook.com/?id=' . $url->toString() . '&scrape=true');

    kint($request->getBody()->getContents());
    die;





//    $url = drupal_get_path_alias('node/' . $node->nid);
//
//    $page_url = $base_url . '/' . $url;
//
//    $fb_url = 'https://graph.facebook.com/?id=' . $page_url . '&scrape=true';
//
//    $response = drupal_http_request($fb_url, array('method' => 'POST'));
//
//    watchdog(
//      'Facebook cache',
//      'Flush FB Node: @nid <pre>@data<pre>',
//      array('@nid' => $node->nid, '@data' => print_r($response, TRUE))
//    );
//
//    return $response;



  }

  /**
   * {@inheritdoc}
   */
  public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE) {
    $access = $object->access('update', $account, TRUE)
      ->allowedIf($account->hasPermission('can flush facebook cache'));
    return $return_as_object ? $access : $access->isAllowed();
  }

}
