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

Route::post('categoria-select2', 'Api\CategoriaApiController@returnDataCategoriaSelect2')->name('api.categoria');
Route::get('categoria', 'Api\CategoriaApiController@returnDataCategoriaAll')->name('api.categoriaall');
Route::get('indicador/data-list/{categoria}', 'Api\IndicadorApi@getDataIndicador')->name('api.avaluo.data-list');
Route::get('indicadorestructura/data-list/{categoria}', 'Api\IndicadorApi@getDataIndicadorEstructura')->name('api.avaluo.data-list.estructura');