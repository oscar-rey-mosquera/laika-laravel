<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoDocumentoRequest;
use App\Repositories\TipoDocumentoRepositoy;


class TipoDocumentoController extends Controller
{
    private $tipoDocumento;

    public function __construct(TipoDocumentoRepositoy $tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function index(){

      return $this->tipoDocumento->get();

    }

    public function show($id){

        return $this->tipoDocumento->findById($id);
    }

    public function create(TipoDocumentoRequest $request){

       return $this->tipoDocumento->create($request->all());
    }

    public function update(TipoDocumentoRequest $request, $id){

        return $this->tipoDocumento->update($request->all(), $id);
    }

    public function delete($id){

        return $this->tipoDocumento->delete($id);
    }


}
