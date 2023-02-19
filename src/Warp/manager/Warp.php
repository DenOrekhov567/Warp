<?php

declare(strict_types=1);

namespace Warp\manager;

use Warp\utils\JsonObject;

class Warp
{

	private string $name;
	private JsonObject $data;

	public function __construct(string $name, JsonObject $data) {
		$this->name = $name;
		$this->data = $data;
	}

	public function getName(): string {
		return $this->name;
	}

	public function setName(string $name): void {
		$this->name = $name;
	}

	public function getData(): JsonObject {
		return $this->data;
	}

	public function setData(JsonObject $data): void {
		$this->data = $data;
	}

}