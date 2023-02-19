<?php

declare(strict_types=1);

namespace Warp\manager;

use Database\provider\SQL;
use Pattern\utils\JsonMapper;
use Warp\utils\JsonObject;

class WarpManager
{

	//Хеш-таблица с данными о варпах
	public static array $warps = [];

	//Инициализирует таблицу базы данных
	public static function initTable(): void {
		//Создаём таблицу warps, если её нет
		$connection = SQL::getConnection();
		$connection->query(
			"CREATE TABLE IF NOT EXISTS `warps`(
				`name` VARCHAR(10) NOT NULL,
				`json` JSON NOT NULL
			);"

		);
		$connection->query("ALTER TABLE `warps` ADD UNIQUE KEY `name` (`name`);");
	}

	//Преобразует все данные из запросов в хеш
	public static function initData(): void {
		//Перебираем все поля таблицы, преобразуем их в Warp объекты и хешируем их в $warps 
		if($result = SQL::getConnection()->query("SELECT * FROM warps;")){
			foreach($result as $row) {
				self::$warps[] = new Warp($row["name"], (new JsonMapper)->map(json_decode($row["json"], true), new JsonObject()));
			}

		}

	}

	//Создаст новый варп
	public static function setWarp(array $data): void {
		$jsonData = new JsonObject();
		$jsonData->x = (float)$data["x"];
		$jsonData->y = (float)$data["y"];
		$jsonData->z = (float)$data["z"];
		$jsonData->worldName = $data["worldName"];
		$jsonData->yaw = (float)$data["yaw"];
		$jsonData->pitch = (float)$data["pitch"];

		self::$warps[] = new Warp($data["name"], $jsonData);
	}

	//Вернет данные о варпе с таким именем
	public static function getWarp(string $name): ?Warp {
		foreach (self::$warps as $warp) {
			if($warp->getName() === $name) {
				return $warp;
			}

		}
		return null;
	}

	//Проверит, существует ли варп с таким именем
	public static function isExistWarp(string $name): bool {
		foreach (self::$warps as $warp) {
			if($warp->getName() === $name) {
				return true;
			}
			
		}
		return false;
	}

	public static function removeWarp(string $name): void {
		SQL::getConnection()->query("DELETE FROM `warps` WHERE `name` = '".$name."'");
	}

	//Вернет всю хеш-таблицу с варпами
	public static function getWarps(): ?array {
		return self::$warps;
	}

	//Отправит все данные из хеш-таблицы в таблицу базы данных
	public static function saveData(): void {
		$connection = SQL::getConnection();

		foreach(self::$warps as $warp) {
			if($connection->query("SELECT *  FROM `warps` WHERE `name` = '".$warp->getName()."'")->fetch_assoc() === null) {
				$connection->query("INSERT INTO `warps`(`name`, `json`) VALUES (
					'".$warp->getName()."',
					'".json_encode($warp->getData())."'
				)");

			}

		}

	}

}