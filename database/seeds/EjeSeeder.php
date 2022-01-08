<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "SET FOREIGN_KEY_CHECKS = 0; TRUNCATE table ejes; SET FOREIGN_KEY_CHECKS = 1;";
        DB::connection()->getPdo()->exec($sql);
        //
        DB::insert("insert into ejes (id, code, nombre, created_at, updated_at) values('1','simplificacion_tramite','Simplificación de Trámites',NULL,NULL);");
        DB::insert("insert into ejes (id, code, nombre, created_at, updated_at) values('2','prevencion_corrupcion','Prevencion de la Corrupción',NULL,NULL);");
        DB::insert("insert into ejes (id, code, nombre, created_at, updated_at) values('3','funcion_publica','Evaluación de la Función Pública',NULL,NULL);");
    }
}
