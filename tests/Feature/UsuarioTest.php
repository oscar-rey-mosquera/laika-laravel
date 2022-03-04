<?php

namespace Tests\Feature;

use App\Models\TipoDocumento;
use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Support\Str;


class UsuarioTest extends TestCase
{

    private $headers = ['api-key-laika' => 'laika'];

    /** @test */
    public function consultar_usuarios()
    {
        $tipo_documento = TipoDocumento::factory()->create();
        $usuario = Usuario::factory()->create(['tipo_documento_id' => $tipo_documento->id]);

        $response = $this->getJson(route('usuarios.get'), $this->headers);

        $response->assertSee($usuario->nombre);
        $response->assertSee($tipo_documento->nombre);

        return [$tipo_documento, $usuario];

    }

    /** @test*/
    public function error_usuario_no_encontrado(){

        $response = $this->getJson(route('usuarios.show', 100),$this->headers);
        $response->assertStatus(404);
    }

    /**
     *  @test
     * @depends consultar_usuarios
     *
    */
    public function consultar_usuario($data) {

         /**cosultar un usuario */
         list($tipo_documento, $usuario) = $data;

         $response = $this->getJson(route('usuarios.show', $usuario->id),$this->headers);

         $response->assertSee($usuario->nombre);
         $response->assertSee($tipo_documento->nombre);
         /*--- */
    }



    /**
     *  @test
     * @depends consultar_usuarios
     */
    public function crear_usuario_valido($data)
    {
        list(,$usuario) = $data;
        $string_256 = Str::random(256);

        $datas = [
            'nombre' => ['', [],'jhon123', $string_256],
            'documento' => ['', [], $usuario->documento, $string_256],
            'tipo_documento_id' => ['', 'ds', [], 100]
        ];


        $data = [
            'nombre' => 'Jorge',
            'documento' => '107892859',
            'tipo_documento_id' => $usuario->tipo_documento_id
        ];

        foreach ($datas as $name => $values) {
            foreach ($values as $key => $value) {

                $data[$name] = $value;
                $response = $this->postJson(route('usuarios.create'), $data,$this->headers);

                $response->assertJsonStructure([
                    'errors' => [
                        $name
                    ]
                ]);
            }
        }
    }

    /** @test
     * @depends consultar_usuarios
    */
    public function crear_usuario($data)
    {
        list($tipo_documento, $usuario) = $data;
        $usuarioData = Usuario::factory()->make();

        $data = [
            'nombre' => $usuarioData->nombre,
            'documento' => $usuarioData->documento,
            'tipo_documento_id' => $usuario->tipo_documento_id
        ];


         $this->postJson(route('usuarios.create'), $data,$this->headers);


        $this->assertDatabaseHas('usuarios', ['documento' => $data['documento']]);


      return [$tipo_documento, $usuario, $usuarioData];



    }

    /**
     * @test
     * @depends crear_usuario
     */
    public function actualizar_usuario($data){

        list(, $usuario,) = $data;

        $data = [
            'nombre' => 'romeo',
            'documento' => $usuario->documento,
            'tipo_documento_id' => $usuario->tipo_documento_id
        ];


        $this->putJson(route('usuarios.update', $usuario->id), $data, $this->headers);

        $this->assertDatabaseHas('usuarios', ['nombre' => $data['nombre']]);

    }

    /** @test
     * @depends crear_usuario
    */
    public function eliminar_usuario($data){
        list(,$usuario, ) = $data;
        $this->deleteJson(route('usuarios.delete',$usuario->id),[],$this->headers);

        $this->assertDatabaseMissing('usuarios', ['nombre' => $usuario->nombre]);
    }




}
