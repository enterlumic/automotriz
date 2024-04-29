<?php

namespace App\Http\Controllers;
use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Migraciones;
use App\Lib\LibCore;

class MigracionesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Declaración de variables
    |--------------------------------------------------------------------------
    |
    */
    public $LibCore;

    /*
    |--------------------------------------------------------------------------
    | Inicializar variables comunes
    |--------------------------------------------------------------------------
    |
    */
    public function __construct(){
        $this->LibCore = new LibCore();
    }

    /*
    |--------------------------------------------------------------------------
    | Inicial
    |--------------------------------------------------------------------------
    |
    | Carga solo vista con HTML
    | Todo es controlado por JS migraciones.js
    |
    */
    public function index()
    {
        // if(!\Schema::hasTable('migraciones')){
        //     return json_encode(array("b_status"=> false, "vc_message" => "No se encontro la tabla migraciones"));
        // }
        // $this->LibCore->setSkynet( ['vc_evento'=> 'index_migraciones' , 'vc_info' => "index - migraciones" ] );

        return view('migraciones');
    }

    /*
    |--------------------------------------------------------------------------
    | Obtener un registro por id
    |--------------------------------------------------------------------------
    | 
    | @return json
    |
    */
    public function get_migraciones_by_id(Request $request)
    {
        $data= Migraciones::select('migration'
                                    , 'batch'
        )->where('id', $request->id)->get();
        sleep(1);

        if ( $data->count() > 0 ){
            return json_encode(array("b_status"=> true, "data" => $data));
        }else{
            return json_encode(array("b_status"=> false, "data" => 'sin resultados'));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Datatable registro especial como se requiere en js
    |--------------------------------------------------------------------------
    | 
    | @return json
    |
    */
    public function get_migraciones_by_datatable(Request $request)
    {
        DB::statement('USE `'.$request->storedValue.'`');

        $data = DB::table('migrations')
            ->select('id', 'migration', 'batch')
            ->orderBy('id', 'desc')
            ->get();

        foreach ($data as $key => $value) {
            $arr[]= array(    $value->id
                            , $value->migration
                            , $value->batch
                            , $value->id
            );
        }

        $json_data = array(
            "draw"            => intval( 10 ),   
            "recordsTotal"    => intval( 1 ),  
            "recordsFiltered" => intval( 33 ),
            "data"            => isset($arr) && is_array($arr)? $arr : ''
        );

        if(1 > 0){
            return json_encode($json_data);
        }else{
            return json_encode(array("data"=>"" ));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Eliminar registro por id
    |--------------------------------------------------------------------------
    | 
    | @return id
    |
    */
    public function delete_migraciones(Request $request)
    {
        // Seleccionar la base de datos donde se esta trabajando
        DB::statement('USE `'.$request->storedValue.'`');

        // Buscamos el nombre de la migración        
        $result = DB::table('migrations')
                    ->select('id', 'migration', 'batch')
                    ->where('id', $request->id)
                    ->get();

        // Extraer solo el nombre del SP
        $textoOriginal = $result[0]->migration;

        $pattern = '/(\w+)$/';

        if (preg_match($pattern, $textoOriginal, $matches)) {
            $procedureName = preg_replace('/^\d+_\d+_\d+_\d+_/', '', $matches[0]);

            // Eliminar el SP
            DB::unprepared('DROP PROCEDURE IF EXISTS `'.$procedureName.'` ');

            DB::table('gnu.skynet')->insert([
                'id_user_o_id_cliente' => 1,
                'vc_evento' => 'delete_migraciones: eliminando store',
                'vc_query' => $procedureName,
                'vc_info' => ''
            ]);
        }

        // Eliminar en la tabla de migrate segun el proyecto selccionado
        DB::table('migrations')->where('id', $request->id)->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Desahacer el registro que se elimino
    |--------------------------------------------------------------------------
    | 
    | @return id
    |
    */
    public function undo_delete_migraciones(Request $request)
    {

    }


    /*
    |--------------------------------------------------------------------------
    | Truncar toda la tabla util para hacer pruebas
    |--------------------------------------------------------------------------
    | 
    | @return id
    |
    */
    public function truncate_migraciones()
    {
        Skynet::truncate();
    }

    public function showDatabases(Request $request)
    {
        $databases = DB::select('SHOW DATABASES WHERE `Database` 
                NOT IN (?, ?, ?, ?)'
            , ['performance_schema', 'sys', 'mysql', 'information_schema']);
        return response()->json($databases);
    }

}
