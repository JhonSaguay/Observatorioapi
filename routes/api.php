<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('variable-select2', 'API\CategoriaIndicadorApiController@returnVariablesSelect2')->name('api.variables');
Route::post('categoria-select2', 'API\CategoriaApiController@returnDataCategoriaSelect2')->name('api.categoria');
Route::get('categoria', 'API\CategoriaApiController@returnDataCategoriaAll')->name('api.categoriaall');
Route::get('indicador/data-list/{categoria}', 'API\IndicadorApi@getDataIndicador')->name('api.indicador.data-list');
Route::get('indicadorestructura/data-list/{categoria}', 'API\IndicadorApi@getDataIndicadorEstructura')->name('api.indicador.data-list.estructura');
Route::get('old_indicador/data-list/{categoria}/{indicador}', 'API\IndicadorApi@getDataOldIndicadorEstructura')->name('api.indicador.old.data-list');
Route::get('indicadorlast/download/{categoria}', 'API\IndicadorApi@download')->name('api.indicador.last.download');
Route::get('indicador/download/{categoria}/{indicador}', 'API\IndicadorApi@download_indicador')->name('api.indicador.download');