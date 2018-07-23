<?php

namespace App\Services;


use App\Repositories\BoardRepository;

class BoardService
{
    private $boardRepository;

    public function __construct()
    {
        $this->boardRepository = new BoardRepository();
    }

    public function getAllBoards($projectId)
    {
        return $this->boardRepository->getByProject($projectId);
    }

    public function create($data)
    {
        return $this->boardRepository->create($data);

    }

    public function update($data, $id)
    {
        return $this->boardRepository->update($id,$data);

    }

    public function delete($id)
    {
        return $this->boardRepository->delete($id);
    }
}