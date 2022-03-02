<?php

namespace App\Repositories;

use App\Models\TipoDocumento;
use App\Models\Usuario;

class UsuarioRepository extends Repository
{

    protected $model = Usuario::class;

    protected $relations = ['tipo_documento'];

    public function create(array $data): Usuario
    {

        return $this->model::create([

            'nombre' => $data['nombre'],
            'documento' => $data['documento'],
            'tipo_documento_id' => $data['tipo_documento_id']
        ]);
    }


    public function update(int $id, array $data): Usuario
    {
        $usuario = $this->findById($id);

        $usuario->update([
            'nombre' => $data['nombre'] ?? $usuario->nombre,
            'documento' => $data['documento'] ?? $usuario->documento,
            'tipo_documento_id' => $data['tipo_documento_id'] ?? $usuario->tipo_documento_id,
        ]);

        return $usuario;
    }


}
