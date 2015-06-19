<?php
class NoticiaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $noticias = Noticia::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('noticia.show')->with("noticias",$noticias);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $noticia = new Noticia; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('noticia.formulario')->with("noticia",$noticia);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $noticia = new Noticia;

        $datos = Input::all(); 
        
        if ($noticia->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $noticia->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $noticia->save();

            return Redirect::to('noticia')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('noticia/insert')->withInput()->withErrors($noticia->errors);
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
      
 
           $noticia = Noticia::find($id);
   
        return View::make('noticia.formulario')->with("noticia", $noticia);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $noticia = Noticia::find($id);



        $datos = Input::all(); 
        
        if ($noticia->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $noticia->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $noticia->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('noticia')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('noticia/update/'.$id)->withInput()->withErrors($noticia->errors);
            //return "mal2";
        }

        return Redirect::to('noticia')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $noticia = Noticia::find($id);

        $noticia->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>