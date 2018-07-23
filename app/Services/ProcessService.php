<?php

namespace App\Services;


use App\Repositories\ProcessRepository;

class ProcessService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProcessRepository();
    }

    public function getAllProcesses($boardId)
    {
        return $this->repository->getByBoard($boardId);
    }

    public function addProcess($data)
    {
        return $this->repository->create($data);
    }

    public function updateProcess()
    {

    }

    public function deleteProcess()
    {

    }
}