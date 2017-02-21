<?php

namespace Drupal\Tests\facebook_flush_cache\Unit;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Tests\UnitTestCase;
use GuzzleHttp\ClientInterface;
use Drupal\facebook_flush_cache\FacebookFlushCacheService;
use Eris\Generator;
use Eris\TestTrait;
use Psr\Log\LoggerInterface;

/**
 * @coversDefaultClass \Drupal\facebook_flush_cache\FacebookFlushCacheService
 * @group facebook_flush_cache_unit
 */
class ServiceTest extends UnitTestCase {

  use TestTrait;

  protected $container;

  /**
   * Http mock.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClientMock;

  /**
   * Logger mock.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $loggerMock;

  /**
   * Facebook mock.
   *
   * @var \Drupal\facebook_flush_cache\FacebookFlushCacheService
   */
  protected $facebookMock;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {

    parent::setUp();

    $this->httpClientMock = $this->getMockBuilder(ClientInterface::class)
      ->disableOriginalConstructor()
      ->getMock();

    $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
      ->disableOriginalConstructor()
      ->getMock();

    $this->facebookMock = $this->getMockBuilder(FacebookFlushCacheService::class)
      ->disableOriginalConstructor()
      ->setConstructorArgs([$this->httpClientMock, $this->loggerMock])
      ->getMock();

    $this->container = new ContainerBuilder();

    $this->container->set('http_client', $this->httpClientMock);

    $this->container->set('logger.factory', $this->loggerMock);

    $this->container->set('facebook_flush_cache.service', $this->facebookMock);
  }

  /**
   * Test the class can be instantiated.
   */
  public function testServiceContainer() {

    $this->assertInstanceOf(
      'Drupal\facebook_flush_cache\FacebookFlushCacheService',
      $this->facebookMock,
      'There is a problem with the instantiated class');
  }

  /**
   * Test Url builder.
   */
  public function testUrlBuilder() {

    $service = new FacebookFlushCacheService($this->httpClientMock, $this->loggerMock);

    $generator = Generator\regex("[a-zA-Z0-9 #?+&_()*,;=@!$\/~.-]");

    $this->forAll($generator)->then(function ($string) use ($service) {

      $url = $service->buildUrl($string);

      $string = urlencode($string);

      $this->assertEquals("{$service->facebookUrl}/?id={$string}&scrape=true", $url);

    });

  }

}
