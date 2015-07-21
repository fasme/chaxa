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

        $titulo = "Mantencion Programda vs Mantencion Realizada";
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
       ->with("titulo", $titulo)
       ->with("data",$data);
      
        
     
    }



    public function informemantencionanual()
    {
        $titulo = "Mantencion Programda vs Mantencion Realizada";
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
        ->with("titulo", $titulo)
        ->with("data",$data);



    }




    public function informemantencionvehiculo()
    {

        $titulo = "Horas Utilizadas vs Mantencion Realizadas";
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
       ->with("titulo", $titulo)
        ->with("data",$data);



    }


 

public function informeevidenciamensual()
{

        $titulo = "Actividades Abiertas vs Actividades Cerradas";
        $data = Input::all();
       if(!isset($data["mes"]))
        {
            $data["mes"] = date("n");
        }
        if(!isset($data["ano"]))
        {
            $data["ano"] = date("Y");
        }   
    $actividadresponsable = DB::table('actividad_responsable_noprogramada')->join("actividad_noprogramada","actividad_responsable_noprogramada.actividad_id","=","actividad_noprogramada.id")->Where(DB::raw("MONTH(actividad_noprogramada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_noprogramada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");
 $actividadresponsable_kpi = DB::table('actividad_responsable_kpi')->join("actividad_kpi","actividad_responsable_kpi.actividad_id","=","actividad_kpi.id")->Where(DB::raw("MONTH(actividad_kpi.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_kpi.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->join("actividad_programada","actividad_responsable_programada.actividad_id","=","actividad_programada.id")->Where(DB::raw("MONTH(actividad_programada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_programada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");
$actividadresponsable_pac = DB::table('actividad_responsable_pac')->join("actividad_pac","actividad_responsable_pac.actividad_id","=","actividad_pac.id")->Where(DB::raw("MONTH(actividad_pac.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_pac.frecuencia)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");
$actividadresponsable_mantencion = DB::table('actividad_responsable_mantencion')->join("mantencion","actividad_responsable_mantencion.actividad_id","=","mantencion.id")->Where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->Where("estado","=","Abierta")->count("*");

$abiertas = $actividadresponsable + $actividadresponsable_kpi + $actividadresponsable_programada + $actividadresponsable_pac + $actividadresponsable_mantencion;



$actividadresponsable = DB::table('actividad_responsable_noprogramada')->join("actividad_noprogramada","actividad_responsable_noprogramada.actividad_id","=","actividad_noprogramada.id")->Where(DB::raw("MONTH(actividad_noprogramada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_noprogramada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");
 $actividadresponsable_kpi = DB::table('actividad_responsable_kpi')->join("actividad_kpi","actividad_responsable_kpi.actividad_id","=","actividad_kpi.id")->Where(DB::raw("MONTH(actividad_kpi.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_kpi.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");
$actividadresponsable_programada = DB::table('actividad_responsable_programada')->join("actividad_programada","actividad_responsable_programada.actividad_id","=","actividad_programada.id")->Where(DB::raw("MONTH(actividad_programada.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_programada.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");
$actividadresponsable_pac = DB::table('actividad_responsable_pac')->join("actividad_pac","actividad_responsable_pac.actividad_id","=","actividad_pac.id")->Where(DB::raw("MONTH(actividad_pac.frecuencia)"),"=",$data["mes"])->where(DB::raw("YEAR(actividad_pac.frecuencia)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");
$actividadresponsable_mantencion = DB::table('actividad_responsable_mantencion')->join("mantencion","actividad_responsable_mantencion.actividad_id","=","mantencion.id")->Where(DB::raw("MONTH(mantencion.fecha_mantencion)"),"=",$data["mes"])->where(DB::raw("YEAR(mantencion.fecha_mantencion)"),"=",$data["ano"])->Where("estado","=","Cerrada")->count("*");

$cerradas = $actividadresponsable + $actividadresponsable_kpi + $actividadresponsable_programada + $actividadresponsable_pac + $actividadresponsable_mantencion;

    return View::make('informe.evidencia.informeevidencia')
        ->with("abiertas",json_encode($abiertas))
        ->with("cerradas",json_encode($cerradas))
        ->with("titulo", $titulo)
        ->with("data",$data);
        
}


public function informepdf(){

    $data = Input::all();

    $view = View::make('informe.informepdf')
    ->with("data",$data);

    return PDF::load($view, 'a4', 'portrait')->show();

}

}



?>
