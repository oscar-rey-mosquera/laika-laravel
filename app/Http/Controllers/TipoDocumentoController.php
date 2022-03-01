<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoDocumentoRequest;
use App\Models\TipoDocumento;
use App\Repositories\TipoDocumentoRepositoy;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    private $tipoDocumento;

    public function __construct(TipoDocumentoRepositoy $tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function index(){

      return $this->tipoDocumento->get();
    }

    public function create(TipoDocumentoRequest $request){

       return  $this->tipoDocumento->create($request->all());
    }

    public function update(TipoDocumentoRequest $request, TipoDocumento $tipoDocumento){

        return $this->tipoDocumento->update($tipoDocumento, $request->all());
    }

    public function delete(TipoDocumento $tipoDocumento){

        return $this->tipoDocumento->delete($tipoDocumento);
    }
}
