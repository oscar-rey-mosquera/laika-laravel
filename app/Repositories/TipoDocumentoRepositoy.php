<?php

namespace App\Repositories;

use App\Models\TipoDocumento;
use Illuminate\Support\Facades\DB;

class TipoDocumentoRepositoy
{

    protected $model = TipoDocumento::class;

    public function get()
    {
        $data = DB::select('CALL get_tipo_documentos()');

        return $data;
    }

    public function find_by_id(int $id)
    {
        $data = DB::select("CALL get_tipo_documento_by_id({$id})");

        return $data;
    }

    public function create(array $data)
    {
        $nombre = $data['nombre'];
        DB::select("CALL crear_tipo_documento(?)", [$nombre]);
    }


    public function update( array $data, int $id)
    {
        $nombre = $data['nombre'];

        DB::select("CALL actualizar_tipo_documento(?,?)",[$nombre, $id]);

    }

    public function delete(int $id)
    {
          DB::select("CALL delete_tipo_documento_by_id({$id})");
    }
}
