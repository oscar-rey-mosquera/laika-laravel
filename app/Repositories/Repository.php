<?php
namespace App\Repositories;

 abstract class Repository {

    public function get($pagination = 10){

        return $this->model::paginate($pagination);
    }

    public function findById(int $id) {
      return $this->model::findOrFail($id);
    }

}
