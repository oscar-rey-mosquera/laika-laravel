<?php
namespace App\Repositories;

 abstract class Repository {


    public function getWithRelations(){

        return $this->model::with($this->relations)->get();
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
