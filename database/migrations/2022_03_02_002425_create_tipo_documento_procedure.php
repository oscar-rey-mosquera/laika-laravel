<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
       DROP PROCEDURE IF EXISTS `get_usuarios`;
       DROP PROCEDURE IF EXISTS `get_usuario_by_id`;
       DROP PROCEDURE IF EXISTS `delete_usuarios`;
       DROP PROCEDURE IF EXISTS `crear_usuario`;
       DROP PROCEDURE IF EXISTS `actualizar_usuario`;

       CREATE PROCEDURE `get_usuarios` ()
        BEGIN
        SELECT
        us.*,
        tp.nombre as tipo_documento
        FROM usuarios AS us JOIN tipo_documentos AS tp ON us.tipo_documento_id = tp.id;
        END;

        CREATE PROCEDURE `get_usuario_by_id` (IN idx INT)
        BEGIN
        SELECT
        us.*,
        tp.nombre as tipo_documento
        FROM usuarios AS us
        JOIN tipo_documentos AS tp ON us.tipo_documento_id = tp.id
        WHERE us.id = idx;
        END;

        CREATE PROCEDURE `delete_usuarios` (IN idx INT)
        BEGIN
        DELETE FROM usuarios WHERE id = idx;
        END;

        CREATE PROCEDURE `crear_usuario` (
            nombrex VARCHAR(255),
            documentox VARCHAR(255),
            tipo_documento_idx INT
            )
        BEGIN
        INSERT INTO usuarios (nombre,documento,tipo_documento_id,created_at, updated_at) VALUES (nombrex,documentox,tipo_documento_idx,NOW(), NOW());
        END;

        CREATE PROCEDURE `actualizar_usuario` (
            nombrex VARCHAR(255),
            documentox VARCHAR(255),
            tipo_documento_idx INT,
            idx INT
            )
        BEGIN
        UPDATE usuarios SET nombre = nombrex, documento = documentox, tipo_documento_id = tipo_documento_idx , updated_at=NOW() WHERE id = idx;
        END;

        ";

        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
