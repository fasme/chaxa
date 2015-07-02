<?php
class BibliotecaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $bibliotecas = Biblioteca::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('bibliotecas.show')->with("bibliotecas",$bibliotecas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $biblioteca = new Biblioteca; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('bibliotecas.formulario')->with("biblioteca",$biblioteca);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $biblioteca = new Biblioteca;

        $datos = Input::all(); 
        
        if ($biblioteca->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $biblioteca->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $biblioteca->save();

            return Redirect::to('biblioteca')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('biblioteca/insert')->withInput()->withErrors($biblioteca->errors);
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
      
 
           $biblioteca = Biblioteca::find($id);
   
        return View::make('bibliotecas.formulario')->with("biblioteca", $biblioteca);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $biblioteca = Biblioteca::find($id);



        $datos = Input::all(); 
        
        if ($biblioteca->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $biblioteca->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $biblioteca->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('biblioteca')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('biblioteca/update/'.$id)->withInput()->withErrors($biblioteca->errors);
            //return "mal2";
        }

        return Redirect::to('biblioteca')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $biblioteca = Biblioteca::find($id);

        $biblioteca->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>