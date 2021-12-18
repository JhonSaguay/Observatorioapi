<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\CategoriaIndicadore\IndexCategoriaIndicadore;
use App\Http\Requests\Admin\CategoriaIndicadore\StoreCategoriaIndicadore;
use App\Http\Requests\Admin\CategoriaIndicadore\UpdateCategoriaIndicadore;
use App\Http\Requests\Admin\CategoriaIndicadore\DestroyCategoriaIndicadore;
use Illuminate\Support\Facades\Storage;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\CategoriaIndicadore;
use Illuminate\Support\Facades\DB;
// Helpers
use App\Helpers\CustomUrl; // $string
use App\Helpers\Archivos; // $nombre, $archivo, $disk

class CategoriaIndicadoresController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexCategoriaIndicadore $request
     * @return Response|array
     */
    public function index(IndexCategoriaIndicadore $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(CategoriaIndicadore::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nombre', 'codigo', 'archivo_muestra'],

            // set columns to searchIn
            ['id', 'nombre', 'codigo', 'archivo_muestra']
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.categoria-indicadore.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.categoria-indicadore.create');

        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategoriaIndicadore $request
     * @return Response|array
     */
    public function store(Request $request)
    {
        $file=$request->file('file_csv');
        if(isset($file)){
            $_FILES=$file;
            $column_name = array();
            $column_data=array();
            $final_data= array();
            $file_data= file_get_contents($_FILES);
            $data_array=array_map("str_getcsv",explode("\n",$file_data));
            $labels=array_shift($data_array);
            foreach($labels as $label){
                $column_name[]=$label;
                $column_data[]=$label;
            }
            $final_data=array_combine($column_name,$column_data);
            $json_output = json_encode($final_data);
            $request->archivo_json=$json_output;
            $name = CustomUrl::urlTitle($request->codigo);
            $fileName=Archivos::storeImagen($name,$file, 'categorias');
            $categoria=CategoriaIndicadore::create([
                'nombre'=>$request->nombre,
                'codigo' =>$request->codigo,
                'archivo_muestra'=>$fileName,
                'archivo_json'=>$request->archivo_json,
            ]);
            $categoria->save();
        }
        
        dd($request);
        // Sanitize input
        $sanitized = $request->validated();

        // Store the CategoriaIndicadore
        $categoriaIndicadore = CategoriaIndicadore::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/categoria-indicadores'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/categoria-indicadores');
    }

    /**
     * Display the specified resource.
     *
     * @param  CategoriaIndicadore $categoriaIndicadore
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(CategoriaIndicadore $categoriaIndicadore)
    {
        $this->authorize('admin.categoria-indicadore.show', $categoriaIndicadore);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CategoriaIndicadore $categoriaIndicadore
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(CategoriaIndicadore $categoriaIndicadore)
    {
        $this->authorize('admin.categoria-indicadore.edit', $categoriaIndicadore);


        return view('admin.categoria-indicadore.edit', [
            'categoriaIndicadore' => $categoriaIndicadore,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategoriaIndicadore $request
     * @param  CategoriaIndicadore $categoriaIndicadore
     * @return Response|array
     */
    public function update(UpdateCategoriaIndicadore $request, CategoriaIndicadore $categoriaIndicadore)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values CategoriaIndicadore
        $categoriaIndicadore->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/categoria-indicadores'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/categoria-indicadores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyCategoriaIndicadore $request
     * @param  CategoriaIndicadore $categoriaIndicadore
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyCategoriaIndicadore $request, CategoriaIndicadore $categoriaIndicadore)
    {
        $categoriaIndicadore->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyCategoriaIndicadore $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyCategoriaIndicadore $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    CategoriaIndicadore::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    public function download($categoria)
    {
        $cat=CategoriaIndicadore::where('codigo','=',$categoria)->first();

        return Storage::disk('categorias')->download($cat->archivo_muestra);
    }
    
    }
