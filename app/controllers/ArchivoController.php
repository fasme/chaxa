<?php
class ArchivoController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $archivos = Archivo::where("obsoleto","<>","si")->get();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('biblioteca.archivos.show')->with("archivos",$archivos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $archivo = new Archivo; 
        $categoria = Categoria::lists("nombre","id");
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('biblioteca.archivos.formulario')->with("archivo",$archivo)->with("categoria",$categoria);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $archivo = new Archivo;

        $datos = Input::all(); 

        $random = rand(0,99999);
        
        if ($archivo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario


            if (Input::hasFile("archivo"))
                {
                    $adjunto1 = Input::file('archivo');
                    $datos["archivo"] = $random."_".str_replace(" ","_",$adjunto1->getClientOriginalName());
                    $adjunto1->move("archivos/biblioteca",$random."_".str_replace(" ","_",$adjunto1->getClientOriginalName()));
                    
                   
                }


            $archivo->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $archivo->save();

            return Redirect::to('archivo')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('archivo/insert')->withInput()->withErrors($archivo->errors);
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
      
 
           $archivo = Archivo::find($id);
           $categoria = Categoria::lists("nombre","id");
   
        return View::make('biblioteca.archivos.formulario')
        ->with("archivo", $archivo)
        ->with("categoria",$categoria);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $archivo = Archivo::find($id);



         $datos = Input::all(); 

         $random = rand(0,99999);
        
        if ($archivo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario


            if (Input::hasFile("archivo"))
                {
                    $adjunto1 = Input::file('archivo');
                     $datos["archivo"] = $random."_".str_replace(" ","_",$adjunto1->getClientOriginalName());
                    $adjunto1->move("archivos/biblioteca",$random."_".str_replace(" ","_",$adjunto1->getClientOriginalName()));
                    
                   
                }


            $archivo->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $archivo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('archivo')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('archivo/update/'.$id)->withInput()->withErrors($archivo->errors);
            //return "mal2";
        }

        return Redirect::to('archivo')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $archivo = Archivo::find($id);

        $archivo->delete();

    //return Redirect::to('usuarios/insert');
    }


    public function archivoobsoleto(){

        $archivos = Archivo::where("obsoleto","=","si")->get();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('biblioteca.archivos.obsoletos')->with("archivos",$archivos);
    }


 






}



?>