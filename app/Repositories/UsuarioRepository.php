<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuarioRepository
{


    protected $relations = ['tipo_documento'];

    public function get()
    {

        $data = DB::select('CALL get_usuarios()');

        return $data;
    }

    public function findById(int $id)
    {

        $data = DB::select("CALL get_usuario_by_id({$id})");

        if (count($data) === 0) {
            throw new ModelNotFoundException("Recurso con id {$id} no encontrado");
        }

        return $data;
    }

    public function create(array $data)
    {

        DB::select("CALL crear_usuario(?,?,?)", [$data['nombre'], $data['documento'], $data['tipo_documento_id']]);
    }


    public function update(int $id, array $data)
    {
        $usuario = $this->findById($id);

        DB::select("CALL actualizar_usuario(?,?,?,?)", [$data['nombre'], $data['documento'], $data['tipo_documento_id'], $usuario[0]->id]);
    }


    public function  delete(int $id)
    {
        $usuario = $this->findById($id);
        DB::select("CALL delete_usuarios({$usuario[0]->id})");
    }
}
