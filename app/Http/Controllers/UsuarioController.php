<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Repositories\UsuarioRepository;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    private $usuario;

    public function __construct(UsuarioRepository $usuario){
       $this->usuario = $usuario;
    }

    public function index() {
        return $this->usuario->getWithRelations();
    }

    public function show($id){
        return $this->usuario->findByIdWithRelations($id);
    }

    public function create(UsuarioRequest $request){
        return $this->usuario->create($request->all());
    }

    public function update(UsuarioRequest $request, $id){
       return $this->usuario->update($id, $request->all());
    }

    public function delete($id){

       return $this->usuario->delete($id);

    }
}
