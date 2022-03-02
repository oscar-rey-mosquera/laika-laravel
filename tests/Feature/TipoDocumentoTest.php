<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\TipoDocumento;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TipoDocumentoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tipoDocumentos = TipoDocumento::factory(4)->create();
        $this->headers = ['api-key-laika' => 'laika'];
    }

    /** @test */
    public function un_usuario_puede_ver_los_tipo_de_documento()
    {

        $tipoDocumento = $this->tipoDocumentos[0];

        $response = $this->getJson(route('tipo-documentos.get'), $this->headers);

        $response->assertSee($tipoDocumento->nombre);

        /** consultar un tipo de documento */

        $response = $this->getJson(route('tipo-documentos.show', $tipoDocumento->id),$this->headers);

        $response->assertSee($tipoDocumento->nombre);
    }



    /** @test */
    public function nombre_tipo_de_documento_valido()
    {

        $name = 'nombre';
        $values = ['', [], 'cc1', '', $this->tipoDocumentos[0]->nombre, Str::random(256)];

        foreach ($values as $key => $value) {

            $response = $this->postJson(route('tipo-documentos.create'), [
                $name => $value
            ],$this->headers);

            $response->assertJsonStructure([
                'errors' => [
                    $name
                ]
            ]);
        }
    }

    /** @test*/
    public function un_usuario_puede_crear_un_tipo_de_documento()
    {

        $value = 'cc';
        $this->postJson(route('tipo-documentos.create'), [
            'nombre' => $value
        ],$this->headers);

        $this->assertDatabaseHas('tipo_documentos', ['nombre' => $value]);

    }

    /** @test*/
    public function un_usuario_puede_actualizar_un_tipo_de_documento()
    {
        $tipoDocumento = $this->tipoDocumentos[0];

       $this->putJson(route('tipo-documentos.update', $tipoDocumento->id), [
            'nombre' => 'cc'
        ],$this->headers);



        $this->assertDatabaseHas('tipo_documentos', [
            'nombre' => 'cc'
        ]);


          /** eliminar */
        $this->deleteJson(route('tipo-documentos.delete', $tipoDocumento->id),[],$this->headers);

        $this->assertDatabaseMissing('tipo_documentos', [
            'nombre' => $tipoDocumento->nombre
        ]);

    }


}
