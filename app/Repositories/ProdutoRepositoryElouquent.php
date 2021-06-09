<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Repositories\ProdutoRepositoryInterface;
use App\Produto;
class ProdutoRepositoryElouquent implements ProdutoRepositoryInterface
{
	 private $model;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
} 