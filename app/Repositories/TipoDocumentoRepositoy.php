<?php
namespace App\Repositories;

use App\Models\TipoDocumento;

 class TipoDocumentoRepositoy extends Repository {

    protected $model = TipoDocumento::class;

    public function create(array $data) : TipoDocumento {

        return $this->model::create([

            'nombre' => $data['nombre']
        ]);
    }


    public function update(TipoDocumento $tipoDocumento,array $data): TipoDocumento{

        $tipoDocumento->update([
            'nombre' => $data['nombre']
        ]);

        return $tipoDocumento;
    }


    public function delete(TipoDocumento $tipoDocumento): TipoDocumento{

        $tipoDocumento->delete();

        return $tipoDocumento;
    }

}
