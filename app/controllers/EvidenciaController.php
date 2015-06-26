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
        $actividadrespoonsable = DB::table('actividad_responsable')
            ->Where("id","=",$id)->update(array("estado"=>"Cerrada"));

        //return $id;
        
    }







}



?>