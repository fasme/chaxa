<?php
class PacController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $pacs = Pac::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('pac.show')->with("pacs",$pacs);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $pac = new Pac; 
        $personals = Personal::lists("nombre","id");
        $personal = Personal::where("id","=",Auth::user()->id)->lists("nombre","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('pac.formulario')->with("pac",$pac)
        ->with("personals",$personals)
        ->with("personal",$personal);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $pac = new Pac;

        $datos = Input::all(); 



        $random = rand(0,99999);
        
        if ($pac->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario




            $pac->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $pac->save();


            $pac = Pac::find($pac->id);


           for($i=0; $i<count($datos["selectpac"]); $i++)
        {


            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $frecuencia = "$ano-$mes-$dia";

            $pac->muchaspersonal()->attach($datos["selectpac"][$i],array("frecuencia"=>$frecuencia, "actividad"=>$datos["actividad"][$i],"personal_admin_id"=>Auth::user()->id,"estado"=>"Abierta","tipoplan"=>$datos["tipoplan"][$i]));
            
            $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = $datos["selectpac"][$i];  // id_de
            $alerta->personal_id_admin = Auth::user()->id;  // id_para
            $alerta->tipo = "aportal";
            $alerta->save();

            /*
            $pacactividad = new ActividadPac;
            $pacactividad->actividad = $datos["actividad"][$i];
            $pacactividad->personal_id = $datos["selectpac"][$i];
            $pacactividad->tipoplan = $datos["tipoplan"][$i];

            
            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $pacactividad->frecuencia = "$ano-$mes-$dia";



            $pac->actividadPac()->save($pacactividad);

            $pacactividad = ActividadPac::find($pacactividad->id);
            $pacactividad->muchaspersonal()->attach($datos["selectpac"][$i],array("personal_admin_id"=>Auth::user()->id, "estado"=>"Abierta","tipoactividad"=>"pac"));


            $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = $datos["selectpac"][$i];  // id_de
            $alerta->personal_id_admin = Auth::user()->id;  // id_para
            $alerta->tipo = "aportal";
            $alerta->save();
            */
            
            //echo $datos["selectpac"][$i]." ".$datos["actividad"][$i]."<br>";
        }



            return Redirect::to('pac')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('pac/insert')->withInput()->withErrors($pac->errors);
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
      
 
           $pac = Pac::find($id);
           $personals = Personal::lists("nombre","id");
            $personal = Personal::where("id","=",Auth::user()->id)->lists("nombre","id");
   
        return View::make('pac.formulario')
        ->with("pac", $pac)
        ->with("personals",$personals)
        ->with("personal",$personal);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $pac = Pac::find($id);



         $datos = Input::all(); 

         $random = rand(0,99999);
        
        if ($pac->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario


            $pac->muchaspersonal()->detach();
           for($i=0; $i<count($datos["selectpac"]); $i++)
        {

            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $frecuencia = "$ano-$mes-$dia";

            $pac->muchaspersonal()->attach($datos["selectpac"][$i],array("frecuencia"=>$frecuencia, "actividad"=>$datos["actividad"][$i],"personal_admin_id"=>Auth::user()->id,"estado"=>"Abierta","tipoplan"=>$datos["tipoplan"][$i]));
            
            /*
            $pacactividad = new ActividadPac;
            $pacactividad->actividad = $datos["actividad"][$i];
            $pacactividad->personal_id = $datos["selectpac"][$i];
            $pacactividad->tipoplan = $datos["tipoplan"][$i];

            
            list($dia,$mes,$ano) = explode("/",$datos['frecuencia'][$i]);
            $pacactividad->frecuencia = "$ano-$mes-$dia";



            $pac->actividadPac()->save($pacactividad);

             $alerta = new Alertas;
            $alerta->mensaje = "ha enviado una Nueva Actividad";
            $alerta->personal_id = $datos["selectpac"][$i];  // id_de
            $alerta->personal_id_admin = Auth::user()->id;  // id_para
            $alerta->tipo = "aportal";
            $alerta->save();
            
            //echo $datos["selectpac"][$i]." ".$datos["actividad"][$i]."<br>";
            */
        }


            $pac->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $pac->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('pac')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('pac/update/'.$id)->withInput()->withErrors($pac->errors);
            //return "mal2";
        }

        return Redirect::to('pac')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $pac = Pac::find($id);

        $pac->delete();

    //return Redirect::to('usuarios/insert');
    }


    public function mostrar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $pac = Pac::find($id);

        $html = "<table width='100%' class='table table-striped table-bordered table-hover'>";
        $html .= "<tr><td>Actividad </td><td>".$pac->actividad."</td></tr>";
        $html .= "<tr><td>Plazo </td><td>".$pac->frecuencia."</td></tr>";
        $html .= "<tr><td>Personal </td><td>";
        foreach($pac->muchaspersonal as $personas)
            { $html.= $personas->nombre.", ";}
        $html.="</td></tr>";
        
       
        $html.= "</table>";
        //return $html;

        $pac = Pac::find($id);
           $personals = Personal::lists("nombre","id");
            $personal = Personal::where("id","=",Auth::user()->id)->lists("nombre","id");
   
        return View::make('pac.mostrar')
        ->with("pac", $pac)
        ->with("personals",$personals)
        ->with("personal",$personal);

    }



 






}



?>