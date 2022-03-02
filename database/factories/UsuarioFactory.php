<?php

namespace Database\Factories;

use App\Models\TipoDocumento;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->name(),
            'documento' => Str::random(10),
            'tipo_documento_id' => function () {
                return TipoDocumento::factory()->create();
            }
        ];
    }
}
