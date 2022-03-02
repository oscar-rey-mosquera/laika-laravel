<?php
namespace App\Repositories;

 abstract class Repository {

    public function get($pagination = 10){

        return $this->model::paginate($pagination);
    }

    public function getWithRelations($pagination = 10){

        return $this->model::with($this->relations)->paginate($pagination);
    }

    public function findByIdWithRelations(int $id) {
        return $this->model::with($this->relations)->findOrFail($id);
      }

    public function findById(int $id) {
      return $this->model::findOrFail($id);
    }


    public function delete($id)
    {

        $query = $this->findById($id);
        $query->delete();

        return $query;
    }

}
