<?php

namespace Tests\Feature;

use App\Models\TipoDocumento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TipoDocumentoTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->tipoDocumentos = TipoDocumento::factory(4)->create();
    }

    /** @test */
    public function un_usuario_puede_ver_los_tipo_de_documento()
    {

        $response = $this->getJson(route('tipo-documentos.get'));

        $response->assertJson([
            'data' => $this->tipoDocumentos->toArray()
        ]);
    }

    /** @test */
    public function un_usuario_puede_ver_un_tipo_de_documento(){
        $tipoDocumento = $this->tipoDocumentos[0];

        $response = $this->getJson(route('tipo-documentos.show', $tipoDocumento->id));

        $response->assertJson($tipoDocumento->toArray());

    }

    /** @test */
    public function nombre_tipo_de_documento_valido()
    {

        $name = 'nombre';
        $values = ['', [], 'cc1', '', $this->tipoDocumentos[0]->nombre];

        foreach ($values as $key => $value) {

            $response = $this->postJson(route('tipo-documentos.create'), [
                $name => $value
            ]);

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
        $response = $this->postJson(route('tipo-documentos.create'), [
            'nombre' => $value
        ]);

        $this->assertDatabaseHas('tipo_documentos', ['nombre' => $value]);
        $response->assertSee($value);
    }

    /** @test*/
    public function un_usuario_puede_actualizar_un_tipo_de_documento()
    {
        $tipoDocumento = $this->tipoDocumentos[0];

        $response = $this->putJson(route('tipo-documentos.update', $tipoDocumento->id), [
            'nombre' => 'cc'
        ]);

        $this->assertDatabaseHas('tipo_documentos', [
            'nombre' => 'cc'
        ]);

        $response->assertSee('cc');

    }

    /** @test */
    public function un_usuario_puede_eliminar_un_tipo_de_documento(){

        $tipoDocumento = $this->tipoDocumentos[0];

        $response = $this->deleteJson(route('tipo-documentos.delete', $tipoDocumento->id));

        $this->assertDatabaseMissing('tipo_documentos', [
            'nombre' => $tipoDocumento->nombre
        ]);

        $response->assertSee($tipoDocumento->nombre);

    }
}
