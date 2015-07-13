<?php
use Khill\Lavacharts\Lavacharts;
class InformeController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function informeevidencia()
    {
       
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('informe.evidencia.informeevidencia');
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


    public function informemantencionmensual()
    {
       
      //  


        $data = Input::all();
        if(!isset($data["mes"]))
        {
            $data["mes"] = date("n");
        }

        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }
    
        
        $programada = DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->count("*");
        $realizada = DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->where("estado","=","Cerrada")->count("*");
    
        
       return View::make('informe.mantencion.informemantencionmensual')
       ->with("programada",$programada)
       ->with("realizada",$realizada)
       ->with("data",$data);
      
        
     
    }



    public function informemantencionanual()
    {

        $data = Input::all();
       
        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }   


        for($i=1; $i<=12; $i++)
        {
        $programada[] = DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$i)->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->count("*");
        $realizada[] =  DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$i)->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->where("estado","=","Cerrada")->count("*");
        }
        
       
        return View::make('informe.mantencion.informemantencionanual')
        ->with("programada",$programada)
        ->with("realizada",$realizada)
        ->with("data",$data);



    }




    public function informemantencionvehiculo()
    {

        $data = Input::all();
       if(!isset($data["mes"]))
        {
            $data["mes"] = date("n");
        }
        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }   


	
        foreach(Vehiculo::all() as $vehiculo)
        {
        $vehiculos[] = $vehiculo->patente;
        $programada[] = Vehiculo::join("vehiculo_horometro","vehiculo.id","=","vehiculo_horometro.vehiculo_id")->where(DB::raw("MONTH(vehiculo_horometro.created_at)"),"=",$data["mes"])->where(DB::raw("YEAR(vehiculo_horometro.created_at)"),"=",$data["ano"])->where("vehiculo.id","=",$vehiculo->id)->sum("vehiculo_horometro.horometro");

        $realizada[] = DB::table('actividad_responsable_mantencion')->join("mantencion","mantencion.id","=","actividad_responsable_mantencion.actividad_id")->where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->where("mantencion.vehiculo_id","=",$vehiculo->id)->count("*");
        }


        
       
        return View::make('informe.mantencion.informemantencionvehiculo')
        ->with("programada",json_encode($programada))
        ->with("realizada",json_encode($realizada))
	   ->with("vehiculos",json_encode($vehiculos))
        ->with("data",$data);



    }


 






}



?>
