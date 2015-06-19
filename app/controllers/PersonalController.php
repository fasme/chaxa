<?php
class PersonalController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $personals = Personal::all();
        $cargos = Cargo::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('personal.show')->with("personals",$personals)->with("cargos",$cargos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $personal = new Personal; 
        $cargo = Cargo::lists("nombre","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('personal.formulario')->with("personal",$personal)->with("cargo",$cargo);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $personal = new Personal;

        $datos = Input::all(); 
        
        if ($personal->isValid($datos))
        {
            
            $personal->usuario = $datos["rut"];
            $personal->password = $datos["rut"];
            $personal->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $personal->save();

            return Redirect::to('personal')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('personal/insert')->withInput()->withErrors($personal->errors);
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
      
 
           $personal = Personal::find($id);
           $cargo = Cargo::lists("nombre","id");
   
        return View::make('personal.formulario')->with("personal", $personal)->with("cargo",$cargo);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $personal = Personal::find($id);



        $datos = Input::all(); 
        
        if ($personal->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $personal->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $personal->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('personal')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('personal/update/'.$id)->withInput()->withErrors($personal->errors);
            //return "mal2";
        }

        return Redirect::to('personal')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $personal = Personal::find($id);

        $personal->delete();

    //return Redirect::to('usuarios/insert');
    }

    public function evidencia()
    {

         $datos = Input::all();
        $random = rand(0,99999);

       

        foreach (Personal::Where("perfil","=","admin")->get() as $administrador) {

        $alerta = new Alertas;
        $alerta->mensaje = "ha enviado una nueva evidencia";
        $alerta->personal_id = Auth::user()->id; // id de
        $alerta->personal_id_admin = $administrador->id; //id para
        $alerta->save();
        }
        



        


            $actividadrespoonsable = DB::table('actividad_responsable')
            ->Where("id","=",$datos["id"]);

            $adjunto11 ="";
            $adjunto22="";
            $adjunto33 ="";
            $adjunto44 ="";
            $adjunto55 ="";

            //return $actividadrespoonsable;

          

            // return $actividad->muchaspersonal()->wherePivot('id', '=', 40)->first();



                
                if (Input::hasFile("adjunto1"))
                {
                    $adjunto1 = Input::file('adjunto1');
                    $adjunto11 = $random."_".$adjunto1->getClientOriginalName();
                    $adjunto1->move("archivos/evidencia",$random."_".$adjunto1->getClientOriginalName());
                    
                   
                }

                if (Input::hasFile("adjunto2"))
                {
                    $adjunto2 = Input::file('adjunto2');
                    $adjunto22 = $random."_".$adjunto2->getClientOriginalName();
                    $adjunto2->move("archivos/evidencia",$random."_".$adjunto2->getClientOriginalName());
                    

                 
                }

                if (Input::hasFile("adjunto3"))
                {
                    $adjunto3 = Input::file('adjunto3');
                    $adjunto33 = $random."_".$adjunto3->getClientOriginalName();
                    $adjunto3->move("archivos/evidencia",$random."_".$adjunto3->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto4"))
                {
                    $adjunto4 = Input::file('adjunto4');
                    $adjunto44 = $random."_".$adjunto4->getClientOriginalName();
                    $adjunto4->move("archivos/evidencia",$random."_".$adjunto4->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

                if (Input::hasFile("adjunto5"))
                {
                    $adjunto5 = Input::file('adjunto5');
                    $adjunto55 = $random."_".$adjunto5->getClientOriginalName();
                    $adjunto5->move("archivos/evidencia",$random."_".$adjunto5->getClientOriginalName());
                    //$actividadPersonal->pivot->save();
                }

              //  $actividadrespoonsable->pivot->estado = "Pendiente";
                //$actividadrespoonsable->save();

                $actividadrespoonsable = DB::table('actividad_responsable')
            ->Where("id","=",$datos["id"])->update(array('adjunto1' => $adjunto11,'adjunto2' => $adjunto22,'adjunto3' => $adjunto33,'adjunto4' => $adjunto44,'adjunto5' => $adjunto55, "estado"=>"Pendiente"));

        

  
        


            
return Redirect::to('misactividades');


    }  //fin funcion evidencia



 






}



?>