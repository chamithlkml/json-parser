<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'inc.php';

final class ConfigurationTest extends TestCase
{
	public function testPathDoesNotExist(): void
	{
		$this->expectExceptionMessage("path does not exist");
		$configuration = new divido\Configuration();
		$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.invalid-path.json");

	}

	public function testInvalidJsonContent(): void
	{
		$this->expectExceptionMessage("Invalid json content found");

		$configuration = new divido\Configuration();
		$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.invalid.json");
	}

	public function testDirectKey(): void
	{
		$configuration = new divido\Configuration();
		$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.json");
		$this->assertSame($configuration->get('environment'), "production");
	}

	public function testIndividualKey(): void
	{
		$configuration = new divido\Configuration();
		$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.json");
		$this->assertSame($configuration->get('database.host'), "mysql");
	}

	public function testSectionKey(): void
	{
		$configuration = new divido\Configuration();
		$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.json");

		/*
		    "redis": {
		      "host": "redis",
		      "port": 6379
		    }
		 */

		$this->assertSame($configuration->get('cache.redis')->host, "redis");
		$this->assertSame($configuration->get('cache.redis')->port, 6379);
	}

	public function testMergeConfigurations(): void
	{
		$configuration = new divido\Configuration();
		# Loading config.local.json where cache.redis.host=127.0.0.1
		$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.local.json");

		$this->assertSame($configuration->get('cache.redis.host'), '127.0.0.1');

		# Loading config.json where cache.redis.host=redis
		$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.json");

		$this->assertSame($configuration->get('cache.redis.host'), 'redis');

	}
}
