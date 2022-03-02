<?php

namespace App\Repositories;

use App\Models\TipoDocumento;
use Illuminate\Support\Facades\DB;

class TipoDocumentoRepositoy
{

    protected $model = TipoDocumento::class;

    public function get()
    {
        try {
            $data = DB::select('CALL get_tipo_documentos()');

            return $data;
        } catch (\Throwable $th) {
            $this->error();
        }
    }

    public function findById(int $id)
    {
        try {
            $data = DB::select("CALL get_tipo_documento_by_id({$id})");

            return $data;
        } catch (\Throwable $th) {
            $this->error();
        }
    }


    public function create(array $data)
    {
        try {
            $nombre = $data['nombre'];
            DB::select("CALL crear_tipo_documento(?)", [$nombre]);
        } catch (\Throwable $th) {
            $this->error();
        }
    }


    public function update(array $data, int $id)
    {
        try {
            $nombre = $data['nombre'];

            DB::select("CALL actualizar_tipo_documento(?,?)", [$nombre, $id]);

        } catch (\Throwable $th) {
            $this->error();
        }
    }

    public function delete(int $id)
    {
        try {
            $data = $this->findById($id);

            DB::select("CALL delete_tipo_documento_by_id({$id})");

            return $data;
        } catch (\Throwable $th) {
            $this->error();
        }
    }

    private function error()
    {
        return response()->json(['error' => 'Algo anda mal'], 500);
    }
}
