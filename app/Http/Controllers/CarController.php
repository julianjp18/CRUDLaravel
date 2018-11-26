<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {
            $car = new Car();

            $car->model = $request->input('txt_modelo');
            $car->brand = $request->input('txt_marca');
            $car->plate = $request->input('txt_text_placa').$request->input('txt_num_placa');
            $car->country = $request->input('ciudad');
            $car->year = $request->input('txt_num_ano');
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move('images/', $name);

            $car->url_photo = 'images/'. $name;

            $result = $car->save();

            if($result){
                return redirect()->action('HomeController@index')->with('status','Auto agregado correctamente');
            }else{
                return redirect()->action('HomeController@index')->with('status','Auto <b>NO</b> agregado correctamente');
            }
        }else{
            return redirect()->action('HomeController@index')->with('status','Auto <b>NO</b> agregado correctamente');
        }

        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id)->get();
        foreach($car as $item){
            $id=$item->id;
            $model = $item->model;
            $brand = $item->brand;
            $year = $item->year;
            $country = $item->country;
            $plate = $item->plate;
            $url_photo = $item->url_photo;
            $created_at = $item->created_at;
        }
        if($car){
            return view('view',['id'=>$id,'model'=>$model,'brand'=>$brand,'year'=>$year,
                            'country'=>$country,'plate'=>$plate,'url_photo'=>$url_photo,'created_at'=>$created_at ]);
        }else{
            return back()->with('warning','Auto no encontrado');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move('images/', $name);
            $url_photo = 'images/'.$name;
            
            $car = Car::where('id', $id)
            ->update(['model' => request('txt_modelo'),'brand' => request('txt_marca') 
                    ,'plate' => request('txt_text_placa').request('txt_num_placa'),'country' => request('ciudad'),
                    'year' => request('txt_num_ano'),'url_photo' =>$url_photo]);
            if($car){
                return back()->with('status', 'Carro modificado!');
            }else{
                return back()->with('warning', 'Auto <b>NO</b> modificado !');
            }
        }else{

            $car = Car::where('id', $id)
            ->update(['model' => request('txt_modelo'),'brand' => request('txt_marca') 
                    ,'plate' => request('txt_text_placa').request('txt_num_placa'),'country' => request('ciudad'),
                    'year' => request('txt_num_ano')]);
            if($car){
                return back()->with('status', 'Carro modificado!');
            }else{
                return back()->with('warning', 'Auto <b>NO</b> modificado !');
            }
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::destroy($id);
        if($car){
            return redirect()->action('HomeController@index');
        }
    }
}
