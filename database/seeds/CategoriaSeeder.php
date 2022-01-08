<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "SET FOREIGN_KEY_CHECKS = 0; TRUNCATE table categorias; SET FOREIGN_KEY_CHECKS = 1;";
        DB::connection()->getPdo()->exec($sql);
        //
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('1','mejora_regulatoria','Mejora Regulatoria','1',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('2','digitalizacion','Digitalización','1',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('3','gestion_publica','Innovación en la Gestión Pública','1',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('4','calidad_servicio','Calidad del Servicio ','1',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('5','integridad_publica','Integridad Pública','2',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('6','transparencia','Transparencia, Datos Abiertos y Acceso a la información','2',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('7','evaluacion_riesgos','Evaluación de riesgos institucionales','2',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('8','control_social','Evolución del Control Social','2',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('9','presupuesto','Presupuesto','3',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('10','gobernanza','Gobernanza','3',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('11','profesionalizacion','Profesionalización','3',NULL,NULL);");
        DB::insert("insert into categorias (id, code, nombre, eje_id, created_at, updated_at) values('12','politica_publica','Evaluación de Impacto de la Política Pública','3',NULL,NULL);");
    }
}
