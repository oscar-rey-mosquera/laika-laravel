<?php

namespace Tests\Feature;

use App\Models\TipoDocumento;
use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuarioTest extends TestCase
{
    use RefreshDatabase;

    private $headers = ['api-key-laika' => 'laika'];

    /** @test */
    public function consultar_usuarios()
    {
        $tipo_documento = TipoDocumento::factory()->create();
        $usuario = Usuario::factory()->create(['tipo_documento_id' => $tipo_documento->id]);

        $response = $this->getJson(route('usuarios.get'), $this->headers);

        $response->assertSee($usuario->nombre);
        $response->assertSee($tipo_documento->nombre);

        /**cosultar un usuario */

        $response = $this->getJson(route('usuarios.show', $usuario->id),$this->headers);

        $response->assertSee($usuario->nombre);
        $response->assertSee($tipo_documento->nombre);
        /*--- */

        $response = $this->getJson(route('usuarios.show', 100),$this->headers);
        $response->assertStatus(404);

    }



    /** @test */
    public function crear_usuario_valido()
    {

        $usuario = Usuario::factory()->create();
        $string_256 = Str::random(256);

        $datas = [
            'nombre' => ['', [], $string_256],
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

    /** @test */
    public function crear_usuario_y_eliminar()
    {

        $usuario = Usuario::factory()->create();
        $usuarioData = Usuario::factory()->make();

        $data = [
            'nombre' => $usuarioData->nombre,
            'documento' => $usuarioData->documento,
            'tipo_documento_id' => $usuario->tipo_documento_id
        ];


         $this->postJson(route('usuarios.create'), $data,$this->headers);


        $this->assertDatabaseHas('usuarios', ['documento' => $data['documento']]);



        $this->deleteJson(route('usuarios.delete',$usuario->id),[],$this->headers);

        $this->assertDatabaseMissing('usuarios', ['nombre' => $usuario->nombre]);


    }

    /** @test */
    public function actualizar_usuario(){

        $usuario = Usuario::factory()->create();
        $usuarioData = Usuario::factory()->make();

        $data = [
            'nombre' => $usuarioData->nombre,
            'documento' => $usuario->documento,
            'tipo_documento_id' => $usuario->tipo_documento_id
        ];


        $this->putJson(route('usuarios.update', $usuario->id), $data, $this->headers);

        $this->assertDatabaseHas('usuarios', ['nombre' => $usuarioData->nombre]);

    }




}
