<?php
class ActividadProgramadaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $actividadprogramadas = ActividadProgramada::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('actividad.programada.show')->with("actividadprogramadas",$actividadprogramadas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $actividadprogramada = new ActividadProgramada; 
        $personals = Personal::lists("nombre","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('actividad.programada.formulario')
        ->with("actividadprogramada",$actividadprogramada)
        ->with("personals",$personals);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    
{

        

        $datos = Input::all(); 
        
       

           /* if($datos["frecuencia"])
            {
                list($dia,$mes,$ano) = explode("/",$datos['frecuencia']);
            $datos['frecuencia'] = "$ano-$mes-$dia";

          }*/
          $actividadprogramada = new ActividadProgramada;
          $actividadprogramada->fill($datos);
          $actividadprogramada->save();


          foreach ($datos["frecuencia"] as $frecuencia) {
            

                    list($dia,$mes,$ano) = explode("/",$frecuencia);
                    $frecuencia = "$ano-$mes-$dia";
          
                    

                     $actividadprogramada = ActividadProgramada::find($actividadprogramada->id);
                   //echo count($datos["actividad_id"]);
                   for($i=0;$i<count($datos["personal_id"]);$i++)
                   {
                    
                    $actividadprogramada->muchaspersonal()->attach($datos["personal_id"][$i],array("frecuencia"=>$frecuencia, "personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"programada"));
                   
                    $alerta = new Alertas;
                    $alerta->mensaje = "ha enviado una nueva evidencia";
                    $alerta->personal_id = $datos["personal_id"][$i]; // id de
                    $alerta->personal_id_admin = Auth::user()->id; //id para
                    $alerta->tipo = "aportal";
                    $alerta->save();


                   }
        }


            return Redirect::to('actividadprogramada')->with("mensaje","Datos Ingresados correctamente");
        
     
  
    }
 
     /**
     * Ver usuario con id
     */

    public function update($id) //get
    {
        //echo $id;
      
 
           $actividadprogramada = ActividadProgramada::find($id);
           $personals = Personal::lists("nombre","id");
   
        return View::make('actividad.programada.formulario')
        ->with("actividadprogramada", $actividadprogramada)
        ->with("personals",$personals);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $actividadprogramada = ActividadProgramada::find($id);



        $datos = Input::all(); 

        $actividadprogramada->fill($datos);
          $actividadprogramada->save();

          $actividadprogramada->muchaspersonal()->detach();
          foreach ($datos["frecuencia"] as $frecuencia) {
            

                    list($dia,$mes,$ano) = explode("/",$frecuencia);
                    $frecuencia = "$ano-$mes-$dia";
          
                    

                     $actividadprogramada = ActividadProgramada::find($id);
                   //echo count($datos["actividad_id"]);
                     
                   for($i=0;$i<count($datos["personal_id"]);$i++)
                   {
                    
                    $actividadprogramada->muchaspersonal()->attach($datos["personal_id"][$i],array("frecuencia"=>$frecuencia, "personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"programada"));
                   
                    $alerta = new Alertas;
                    $alerta->mensaje = "ha enviado una nueva evidencia";
                    $alerta->personal_id = $datos["personal_id"][$i]; // id de
                    $alerta->personal_id_admin = Auth::user()->id; //id para
                    $alerta->tipo = "aportal";
                    $alerta->save();


                   }
        }
        
       

     

        return Redirect::to('actividadprogramada')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $actividadprogramada = ActividadProgramada::find($id);

        $actividadprogramada->delete();

    //return Redirect::to('usuarios/insert');
    }


    public function mostrar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $actividadprogramada = ActividadProgramada::find($id);
           $personals = Personal::lists("nombre","id");
   
        return View::make('actividad.programada.mostrar')
        ->with("actividadprogramada", $actividadprogramada)
        ->with("personals",$personals);
    }

 






}



?>