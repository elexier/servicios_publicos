<?php

namespace App\Http\Controllers;

use App\Zona;
use App\ServiciosPublico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use App\Http\Request\ServiciosStoreRequest;
use App\Http\Request\ServiciosUpdateRequest;
use App\Http\Requests\ServiciosStoreRequest as RequestsServiciosStoreRequest;
use App\Http\Requests\ServiciosUpdateRequest as RequestsServiciosUpdateRequest;
//use Illuminate\Support\Carbon;
use Carbon\Carbon;

class ServiciosPublicosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        Carbon::setLocale('es');//muestra los mensajes en español
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  
        $servicios = DB::table('servicios_publicos')
            ->join('zonas', 'zonas.id', '=', 'servicios_publicos.idzona')            
            ->select('servicios_publicos.*', 'zonas.nombre as nombrezona')
            ->orderBy('id')
            ->get();        

        //$servicios = ServiciosPublico::all();
        return view('servicios.index', compact("servicios"));//compact crea un array

        //$servicios = ServiciosPublico::all();

        /* INDAGAR SOBRE ESTE CODIGO *************************************************
        $beneficiarios = Departamento::whereHas('municipio', function($q) {
            $q->where('departamento_id', Input::get('depto'));
        })
        ->with(['corregimiento', 'barrio', 'beneficiario'])
        ->get();
        *******************************************************************************/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $zonas = Zona::all();
        return view('servicios.create', compact("zonas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        
        //VALIDACION DE LOS CAMPOS
        $campos=[
            'nombre' => 'required|string|min:2|max:15',
            'descripcion' => 'required|string|min:2|max:30',
            'idzona' => 'required',
            'tipocliente' => 'required',
            'tipofactura'=>'required',
            'fechaenvio'=>'required|date|before:tomorrow|after:12/31/2019'
        ];

        $mensaje=[
            "required"=>':attribute es requerido',
            "before"=>':attribute es mayor a la permitida',
            "after"=>':attribute es menor a la permitida',
        ];
        $this->validate($request,$campos,$mensaje);

        //VALIDAR QUE ARRAY NO VENG VACIO
        if(isset($request['tipofactura'])){
            $arrayToString = implode(', ', $request->input('tipofactura'));
        }else{
            $arrayToString="";
        }       

        //CREAR INSTANCIA Y GUARDAR
        $servicios = new ServiciosPublico;
        $servicios->tipofactura= $arrayToString;

        $servicios->idzona=$request->idzona;
        $servicios->nombre=$request->nombre;
        $servicios->descripcion=$request->descripcion;
        $servicios->tipocliente=$request->tipocliente;
        $servicios->felectronica=$request->felectronica;
        $servicios->ffisica=$request->ffisica;
        $servicios->fechaenvio=$request->fechaenvio;        
        
        $servicios->save();
        return redirect("/servicios/index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $servicio=ServiciosPublico::findOrFail($id);
        return view("servicios.show", compact("servicio"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
        $zona= Zona::all();
        $servicio=ServiciosPublico::findOrFail($id);
        return view("servicios.edit", compact("servicio","zona"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //VALIDACION DE LOS CAMPOS
        $campos=[
            'nombre' => 'required|string|min:2|max:15',
            'descripcion' => 'required|string|min:2|max:30',
            'idzona' => 'required',
            'tipocliente' => 'required',
            //'fechaprueba'=>'required|date|before:tomorrow|after:12/31/2019',
            'fechaenvio'=>'required|date|before:tomorrow|after:12/31/2019'
        ];
        $mensaje=[
            "required"=>':attribute es requerido',
            "before"=>':attribute es mayor a la permitida',
            "after"=>':attribute es menor a la permitida',
        ];
        $this->validate($request,$campos,$mensaje);

        //VALIDAR QUE ARREGLO DE CHECKBOX NO VENGA VACIO
        if(isset($request['tipofactura'])){
            $arrayToString = implode(', ', $request->input('tipofactura'));
        }else{
            $arrayToString="";
        }


        //CREAR INSTANCIA Y ACTUALIZAR
        $servicio = ServiciosPublico::findOrFail($id);

        $servicio->tipofactura= $arrayToString;
        $servicio->tipocliente = $request->tipocliente;
        $servicio->idzona = $request->idzona;
        $servicio->felectronica = $request->felectronica;
        $servicio->ffisica = $request->ffisica;        
        $servicio->fechaenvio = $request->fechaenvio;        

        $servicio->update($request->all());
        
        return redirect("/servicios/index");
        //return view('servicios.show', compact('servicio'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //   return view('delete');
        $servicio = ServiciosPublico::findOrFail($id);
        $servicio->delete();
        return redirect("/servicios/index");
    }
}
