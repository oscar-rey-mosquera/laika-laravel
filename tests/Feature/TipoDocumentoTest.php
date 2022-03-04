<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\TipoDocumento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TipoDocumentoTest extends TestCase
{

       private $headers = ['api-key-laika' => 'laika'];


    /** @test */
    public function ver_los_tipos_de_documentos()
    {

        $tipoDocumento = TipoDocumento::factory()->create();

        $response = $this->getJson(route('tipo-documentos.get'), $this->headers);

        $response->assertSee($tipoDocumento->nombre);

        return [$tipoDocumento];

    }

    /**
     * @test
     * @depends  ver_los_tipos_de_documentos
    */
    public function ver_un_tipo_de_documento($data){

        list($tipoDocumento) = $data;
        /** consultar un tipo de documento */

        $response = $this->getJson(route('tipo-documentos.show', $tipoDocumento->id),$this->headers);

        $response->assertSee($tipoDocumento->nombre);

    }

    /**
     *  @test
     * @depends ver_los_tipos_de_documentos
    */
    public function nombre_tipo_de_documento_valido($data)
    {
        list($tipoDocumento) = $data;

        $name = 'nombre';
        $values = ['', [], $tipoDocumento->nombre, Str::random(256)];

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
    public function crear_un_tipo_de_documento()
    {

        $tipoDocumento = TipoDocumento::factory()->make();

        $this->postJson(route('tipo-documentos.create'), [
            'nombre' => $tipoDocumento->nombre
        ],$this->headers);



        $this->assertDatabaseHas('tipo_documentos', ['nombre' => $tipoDocumento->nombre]);

    }

    /**
     *  @test
     * @depends  ver_los_tipos_de_documentos
    */
    public function actualizar_un_tipo_de_documento($data)
    {
        list($tipoDocumento) = $data;

       $this->putJson(route('tipo-documentos.update', $tipoDocumento->id), [
            'nombre' => 'TI'
        ],$this->headers);



        $this->assertDatabaseHas('tipo_documentos', [
            'nombre' => 'TI'
        ]);


    }

    /**
     *  @test
     * @depends  ver_los_tipos_de_documentos
     */
    public function eliminar_tipo_de_documento($data){

        list($tipoDocumento) = $data;
          /** eliminar */
          $this->deleteJson(route('tipo-documentos.delete', $tipoDocumento->id),[],$this->headers);

          $this->assertDatabaseMissing('tipo_documentos', [
              'nombre' => $tipoDocumento->nombre
          ]);
    }


}
