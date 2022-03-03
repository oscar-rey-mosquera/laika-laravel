<?php

namespace App\Repositories;

use App\Models\TipoDocumento;
use Illuminate\Support\Facades\DB;

class TipoDocumentoRepositoy
{

    protected $model = TipoDocumento::class;

    public function get(int $paginate = 10)
    {

            return TipoDocumento::paginate($paginate);

    }

    public function findById(int $id)
    {

            return TipoDocumento::findOrFail($id);

    }


    public function create(array $data)
    {

        TipoDocumento::create(['nombre' => $data['nombre']]);


    }


    public function update(array $data, int $id)
    {

            $tipo_documento = $this->findById($id);

           $tipo_documento->update(['nombre' => $data['nombre']]);


    }

    public function delete(int $id)
    {
            $tipo_documento = $this->findById($id);

             $tipo_documento->delete();
    }


}
