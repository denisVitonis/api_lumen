<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Repositories\ProdutoRepositoryInterface; 


class ProdutoService
{
    protected $repo;

    public function __construct(ProdutoRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function destroy($id)
    {
        return $this->repo->destroy($id);
    }
}
