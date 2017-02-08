<?php

namespace Drupal\facebook_flush_cache;

use Drupal\Component\Serialization\Json;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\MessageInterface;

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

      $this->log($request);

    }
    catch (RequestException $error) {
      $this->logError($error);
    }

  }

  /**
   * Log successful.
   */
  public function log(MessageInterface $request) {

    $data = $request->getBody()->getContents();

    $data = Json::decode($data);

    \Drupal::logger('facebook_flush_cache')
      ->info("Cache cleared for @url", ['@url' => $data['id']]);
  }

  /**
   * Log Error.
   */
  public function logError(RequestException $error) {
    \Drupal::logger('facebook_flush_cache')
      ->error($error->getMessage());
  }

}
