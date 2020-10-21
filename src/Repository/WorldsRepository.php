<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\WorldsException;

final class WorldsRepository
{
    protected $database;

    protected function getDb(): \PDO
    {
        return $this->database;
    }

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGet(int $worldsId)
    {
        $query = 'SELECT * FROM `worlds` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $worldsId);
        $statement->execute();
        $worlds = $statement->fetchObject();
        if (empty($worlds)) {
            throw new WorldsException('Worlds not found.', 404);
        }

        return $worlds;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `worlds` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create(object $worlds)
    {
        $query = 'INSERT INTO `worlds` (`terrain`) VALUES (:terrain)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('terrain', $worlds->terrain);
        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $worlds, object $data)
    {
        if (isset($data->terrain)) { $worlds->terrain = $data->terrain; }

        $query = 'UPDATE `worlds` SET `terrain` = :terrain, `last_modified` = :last_modified WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $worlds->id);
        $statement->bindParam('terrain', $data->terrain);
        $statement->bindParam('last_modified', date("Y-m-d H:i:s"));
        $statement->execute();

        return $this->checkAndGet((int) $worlds->id);
    }

    public function delete(int $worldsId): void
    {
        $query = 'DELETE FROM `worlds` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $worldsId);
        $statement->execute();
    }
}
