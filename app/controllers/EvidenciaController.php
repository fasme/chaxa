<?php
class EvidenciaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $personals = Personal::all();


        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('actividad.evidencia.show')->with("personals",$personals);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


    public function eliminar()
    {
        $alertas = Alertas::Where("personal_id_admin","=",Auth::user()->id)->get();
        foreach ($alertas as $alerta) {
            $alerta->delete();
        }
        
        return Redirect::to(url(URL::previous()));
    }

    public function eliminarusuario()
    {
        $alertas = Alertas::Where("personal_id","=",Auth::user()->id)->get();
        foreach ($alertas as $alerta) {
            $alerta->delete();
        }
        
        return Redirect::to(url(URL::previous()));
    }

    public function cerraractividad(){

       

        $id = Input::get("id");
        $tabla  = Input::get("tipoactividad");
        $actividadid = Input::get("actividadid");
        $personalid = Input::get("personalid");

        if($tabla == "noprogramada")
        {
            $actividadrespoonsable = DB::table('actividad_responsable_noprogramada')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));
        }

        if($tabla == "programada")
        {
            $actividadrespoonsable = DB::table('actividad_responsable_programada')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));
        }

        if($tabla == "mantencion")
        {
            $actividadrespoonsable = DB::table('actividad_responsable_mantencion')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));
        }

        if($tabla == "pac")
        {
            $actividadrespoonsable = DB::table('actividad_pac')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));
        }

        if($tabla == "kpi")
        {
            $actividadrespoonsable = DB::table('actividad_kpi')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));
            
        

            
        }
        

      //return Redirect::to(url(URL::previous()));
        return "Actividad Cerrada Correctamente";
    }


    public function mostrar(){

         $id = Input::get('id'); 
         $tabla = Input::get("tipoactividad");


         if($tabla == "noprogramada")
        {
            $actividadrespoonsable = DB::table('actividad_responsable_noprogramada')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));
        }

        if($tabla == "programada")
        {
            $actividadprogramada = ActividadProgramada::find($id);
           $personals = Personal::lists("nombre","id");
   
        return View::make('actividad.programada.mostrar')
        ->with("actividadprogramada", $actividadprogramada)
        ->with("personals",$personals);
        }

        if($tabla == "mantencion")
        {
            $actividadrespoonsable = DB::table('actividad_responsable_mantencion')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));
        }

        if($tabla == "pac")
        {
            $pac = Pac::find($id);
           $personals = Personal::lists("nombre","id");
            $personal = Personal::where("id","=",Auth::user()->id)->lists("nombre","id");
   
        return View::make('pac.mostrar')
        ->with("pac", $pac)
        ->with("personals",$personals)
        ->with("personal",$personal);
        }

        if($tabla == "kpi")
        {

            $kpi = Kpi::find($id);
           $personals = Personal::lists("nombre","id");
            $kpiobjetivos = Kpiobjetivo::lists("nombre","id");
         
        return View::make('kpi.mostrar')
        ->with("kpi",$kpi)
        ->with("personals",$personals)
        ->with("kpiobjetivos",$kpiobjetivos);
        

            
        }


    }



    public function mostrarportal(){

         $id = Input::get('id'); 
         $tabla = Input::get("tipoactividad");
         $nomostrarpersonal = "no";


         if($tabla == "noprogramada")
        {
            $actividadrespoonsable = DB::table('actividad_responsable_noprogramada')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));
        }

        if($tabla == "programada")
        {
            $actividadprogramada = ActividadProgramada::find($id);
           $personals = Personal::lists("nombre","id");
   
        return View::make('actividad.programada.mostrar')
        ->with("actividadprogramada", $actividadprogramada)
        ->with("personals",$personals)
        ->with("nomostrarpersonal",$nomostrarpersonal);
        }

        if($tabla == "mantencion")
        {
            $actividadrespoonsable = DB::table('actividad_responsable_mantencion')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));
        }

        if($tabla == "pac")
        {
            $pac = Pac::find($id);
           $personals = Personal::lists("nombre","id");
            $personal = Personal::where("id","=",Auth::user()->id)->lists("nombre","id");
   
        return View::make('pac.mostrar')
        ->with("pac", $pac)
        ->with("personals",$personals)
        ->with("personal",$personal)
        ->with("nomostrarpersonal",$nomostrarpersonal);
        }

        if($tabla == "kpi")
        {

            $kpi = Kpi::find($id);
           $personals = Personal::lists("nombre","id");
            $kpiobjetivos = Kpiobjetivo::lists("nombre","id");
         
        return View::make('kpi.mostrar')
        ->with("kpi",$kpi)
        ->with("personals",$personals)
        ->with("kpiobjetivos",$kpiobjetivos)
        ->with("nomostrarpersonal",$nomostrarpersonal);
        

            
        }


    }







}



?>