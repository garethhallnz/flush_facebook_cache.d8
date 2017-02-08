<?php

namespace Drupal\facebook_flush_cache;

use GuzzleHttp\Exception\RequestException;

/**
 * Class FacebookService.
 *
 * @package Drupal\facebook_flush_cache
 */
class FacebookFlushCacheService {

  /**
   * The base url.
   *
   * @var string
   */
  public $facebookUrl = 'https://graph.facebook.com';

  /**
   * Provides HTTP client service.
   *
   * @var \GuzzleHttp\Client
   */
  protected $httpClient;

  /**
   * Constructs a new object.
   */
  public function __construct() {
    $this->httpClient = $client = \Drupal::httpClient();
  }

  /**
   * Clear make request to clear cache.
   */
  public function execute($uri) {

    try {

      $url = $this->facebookUrl . '/?id=' . $uri . '&scrape=true';

      $request = $this->httpClient->get($url);

      $this->log($request->getBody());

    }
    catch (RequestException $error) {
      $this->logError($error);
    }

  }

  /**
   * Log successful .
   */
  public function log($data) {
  //    watchdog(
//      'Facebook cache',
//      'Flush FB Node: @nid <pre>@data<pre>',
//      array('@nid' => $node->nid, '@data' => print_r($response, TRUE))
//    );
  }

  /**
   * Log Error.
   */
  public function logError($error) {
    //    watchdog(
//      'Facebook cache',
//      'Flush FB Node: @nid <pre>@data<pre>',
//      array('@nid' => $node->nid, '@data' => print_r($response, TRUE))
//    );
  }
}
