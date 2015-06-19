<?php
class ActividadNoProgramadaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $actividadnoprogramadas = ActividadNoProgramada::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('actividad.noprogramada.show')->with("actividadnoprogramadas",$actividadnoprogramadas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $actividadnoprogramada = new ActividadNoProgramada; 
        $personals = Personal::lists("nombre","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('actividad.noprogramada.formulario')
        ->with("actividadnoprogramada",$actividadnoprogramada)
        ->with("personals",$personals);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $actividadnoprogramada = new ActividadNoProgramada;

        $datos = Input::all(); 
        
        if ($actividadnoprogramada->isValid($datos))
        {
            if($datos["frecuencia"])
            {
                list($dia,$mes,$ano) = explode("/",$datos['frecuencia']);
            $datos['frecuencia'] = "$ano-$mes-$dia";

            }

            $actividadnoprogramada->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $actividadnoprogramada->save();

           $actividadnoprogramada = ActividadNoProgramada::find($actividadnoprogramada->id);
           //echo count($datos["actividad_id"]);
           for($i=0;$i<count($datos["personal_id"]);$i++)
           {
            
            $actividadnoprogramada->muchaspersonal()->attach($datos["personal_id"][$i],array("personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"noprogramada"));
            

            $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = Auth::user()->id;  // id_de
            $alerta->personal_id_admin = $datos["personal_id"][$i];  // id_para
            $alerta->save();


           }


            return Redirect::to('actividadnoprogramada')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('actividadnoprogramada/update/'.$id)->withInput()->withErrors($actividadnoprogramada->errors);
            //return "mal2";
        }
     //   return Redirect::to('usuarios');
    // el método redirect nos devuelve a la ruta de mostrar la lista de los usuarios
 
    }
 
     /**
     * Ver usuario con id
     */

    public function update($id) //get
    {
        //echo $id;
      
 
           $actividadnoprogramada = ActividadNoProgramada::find($id);
           $personals = Personal::lists("nombre","id");
   
        return View::make('actividad.noprogramada.formulario')
        ->with("actividadnoprogramada", $actividadnoprogramada)
        ->with("personals",$personals);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $actividadnoprogramada = ActividadNoProgramada::find($id);



        $datos = Input::all(); 
        
        if ($actividadnoprogramada->isValid($datos))
        {

           if($datos["frecuencia"])
            {
                list($dia,$mes,$ano) = explode("/",$datos['frecuencia']);
            $datos['frecuencia'] = "$ano-$mes-$dia";

            }
            $actividadnoprogramada->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            


        $actividadnoprogramada->muchaspersonal()->detach();
           for($i=0;$i<count($datos["personal_id"]);$i++)
           {
            
            $actividadnoprogramada->muchaspersonal()->attach($datos["personal_id"][$i]);
           
            $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = Auth::user()->id;  // id_de
            $alerta->personal_id_admin = $datos["personal_id"][$i];  // id_para
            $alerta->save();
            
           }


           $actividadnoprogramada->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('actividadnoprogramada')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('actividadnoprogramada/insert')->withInput()->withErrors($actividadnoprogramada->errors);
            //return "mal2";
        }

        return Redirect::to('actividadnoprogramada')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $actividadnoprogramada = ActividadNoProgramada::find($id);

        $actividadnoprogramada->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>