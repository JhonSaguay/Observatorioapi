<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\Indicadore\IndexIndicadore;
use App\Http\Requests\Admin\Indicadore\StoreIndicadore;
use App\Http\Requests\Admin\Indicadore\UpdateIndicadore;
use App\Http\Requests\Admin\Indicadore\DestroyIndicadore;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Indicadore;
use App\Models\FollowIndicador;
use App\Models\CategoriaIndicadore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IndicadoresController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexIndicadore $request
     * @return Response|array
     */
    public function index(IndexIndicadore $request)
    {
        // create and AdminListing instance for a specific model and

        // $data = Indicadore::where('active','=',1)->get();
        $data = AdminListing::create(Indicadore::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nombre', 'categoria', 'tipo', 'direccion_api', 'nombre_archivo', 'datos_indicador'],

            // set columns to searchIn
            ['id', 'nombre', 'categoria', 'direccion_api', 'nombre_archivo', 'datos_indicador'],

            function($query){
                $query->where('active','=',1);

            }
        );

        if ($request->ajax()) {
            if($request->has('bulk')){
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }
        $indicadores=Indicadore::all();

        return view('admin.indicadores.index', compact('data','indicadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        // $this->authorize('admin.indicadore.create');
        $categorias=CategoriaIndicadore::all();
        return view('admin.indicadores.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreIndicadore $request
     * @return Response|array
     */
    public function store(Request $request)
    {
        // Sanitize input
        $input=$request->all();
        $rules=[
            'file_csv' => 'mimes:csv,txt',
            'nombre'=> 'required|unique:indicadores,nombre',  
            'categoria' => 'required'

        ];
        $validator = Validator::make($input,$rules,$messages = [
            'file_csv.mimes' => 'Solo se aceptan archivos con formato csv.',
            'nombre.required' => 'No ha ingresado un nombre.',
            'nombre.unique' => 'El nombre debe ser unico.',
            'categoria.required' => 'No ha ingresado una categoria.'
        ]
        );
        if($validator->fails())
        {
            return redirect()->back()->withInput()
                ->withErrors($validator->errors());
        }


        $categoria=CategoriaIndicadore::where('codigo','=',$request->categoria)->first();
        $list_headers=array();
        $data = json_decode($categoria->archivo_json, true);
        $flag_enter=False;
        foreach ($data as $key=> $data1) {
            $list_headers[]=$key;
        }
        if ($request->file('file_csv')){
            $_FILES=$request->file('file_csv');
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
            $comparision=array_intersect($list_headers,$column_name);
            
            if (count($comparision)==count($list_headers)){
                $flag_enter=True;
                $count=count($data_array)-1;
                for ($j=0;$j<$count;$j++){
                    $data=array_combine($column_name,$data_array[$j]);
                    $final_data[$j]=$data;
                }
                $json_output = json_encode($final_data);
                $request->datos_indicador=$json_output;
            }
        }
        // api
        else{
            $list_header_api=array();
            $data_api = json_decode(file_get_contents($request->api_direction),true);
            $json_output = json_encode($data_api);
            $data_original=reset($data_api);
            
            if (is_array($data_original)){
                foreach ($data_api[0] as $key=> $data) {
                    $list_header_api[]=$key;
                }
            }
            else{
                foreach ($data_api as $key=> $data) {
                    $list_header_api[]=$key;
                }
            }
            $comparision=array_intersect($list_headers,$list_header_api);
            if (count($comparision)==count($list_headers)){
                $flag_enter=True;
                $request->datos_indicador=$json_output;
            }
        }
        if ($flag_enter){
            $indicador=Indicadore::where('active','=',1)->where('categoria','=',$request->categoria)->first();
            if ($indicador){
                $indicador->update(['active'=>0]);
            }
            
            $indicadores=Indicadore::create([
                'nombre'=>$request->nombre,
                'categoria' =>$request->categoria,
                'tipo' =>$request->tipo,
                'datos_indicador'=>$request->datos_indicador,
                'active'=>1
            ]);
            $followindicador=FollowIndicador::create([
                'categoria_id'=>$indicadores->categoria,
                'indicador_id' =>$indicadores->id,
                'action' =>"Este Indicador ha sido actualizado"
            ]);
            return redirect('admin/indicadores')->with('message','Indicador creado con exito');
        }
        else{
            return redirect()->back()->withInput()
                ->withErrors(['JSON incompatible con la muestra']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  Indicadore $indicadore
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Indicadore $indicadore)
    {
        $this->authorize('admin.indicadore.show', $indicadore);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Indicadore $indicadore
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Indicadore $indicadore)
    {
        $this->authorize('admin.indicadore.edit', $indicadore);


        return view('admin.indicadores.edit', [
            'indicadore' => $indicadore,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateIndicadore $request
     * @param  Indicadore $indicadore
     * @return Response|array
     */
    public function update(UpdateIndicadore $request, Indicadore $indicadore)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Indicadore
        $indicadore->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/indicadores'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/indicadores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyIndicadore $request
     * @param  Indicadore $indicadore
     * @return Response|bool
     * @throws \Exception
     */
    public function destroy(DestroyIndicadore $request, Indicadore $indicadore)
    {
        $indicadore->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
    * Remove the specified resources from storage.
    *
    * @param  DestroyIndicadore $request
    * @return  Response|bool
    * @throws  \Exception
    */
    public function bulkDestroy(DestroyIndicadore $request) : Response
    {
        DB::transaction(function () use ($request){
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function($bulkChunk){
                    Indicadore::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
            });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
    
    }
