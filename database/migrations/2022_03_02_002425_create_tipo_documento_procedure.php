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
       DROP PROCEDURE IF EXISTS `get_tipo_documentos`;
       DROP PROCEDURE IF EXISTS `get_tipo_documento_by_id`;
       DROP PROCEDURE IF EXISTS `delete_tipo_documento_by_id`;
       DROP PROCEDURE IF EXISTS `crear_tipo_documento`;
       DROP PROCEDURE IF EXISTS `actualizar_tipo_documento`;

       CREATE PROCEDURE `get_tipo_documentos` ()
        BEGIN
        SELECT * FROM tipo_documentos;
        END;

        CREATE PROCEDURE `get_tipo_documento_by_id` (IN idx INT)
        BEGIN
        SELECT * FROM tipo_documentos WHERE id = idx;
        END;

        CREATE PROCEDURE `delete_tipo_documento_by_id` (IN idx INT)
        BEGIN
        DELETE FROM tipo_documentos WHERE id = idx;
        END;

        CREATE PROCEDURE `crear_tipo_documento` (nombrex VARCHAR(255))
        BEGIN
        INSERT INTO tipo_documentos (nombre, created_at, updated_at) VALUES (nombrex, NOW(), NOW());
        END;

        CREATE PROCEDURE `actualizar_tipo_documento` (
            nombrex VARCHAR(255),
            idx INT
            )
        BEGIN
        UPDATE tipo_documentos SET nombre = nombrex, updated_at=NOW() WHERE id = idx;
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
