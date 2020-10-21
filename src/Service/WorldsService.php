<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\WorldsException;
use App\Repository\WorldsRepository;

final class WorldsService
{
    protected $worldsRepository;

    public function __construct(WorldsRepository $worldsRepository)
    {
        $this->worldsRepository = $worldsRepository;
    }

    protected function checkAndGet(int $worldsId)
    {
        return $this->worldsRepository->checkAndGet($worldsId);
    }

    public function getAll(): array
    {
        return $this->worldsRepository->getAll();
    }

    public function getOne(int $worldsId)
    {
        return $this->checkAndGet($worldsId);
    }

    public function create(array $input)
    {
        $worlds = json_decode(json_encode($input), false);

        return $this->worldsRepository->create($worlds);
    }

    public function update(array $input, int $worldsId)
    {
        $worlds = $this->checkAndGet($worldsId);
        $data = json_decode(json_encode($input), false);

        return $this->worldsRepository->update($worlds, $data);
    }

    public function delete(int $worldsId): void
    {
        $this->checkAndGet($worldsId);
        $this->worldsRepository->delete($worldsId);
    }
}
