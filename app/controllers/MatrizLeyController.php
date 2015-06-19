<?php
class MatrizLeyController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $matrizleys = MatrizLey::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matriz.ley.show')->with("matrizleys",$matrizleys);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $matrizley = new MatrizLey; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('matriz.ley.formulario')->with("matrizley",$matrizley);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $matrizley = new MatrizLey;

        $datos = Input::all(); 
        
        if ($matrizley->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matrizley->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $matrizley->save();

            return Redirect::to('matrizLey')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matrizley/insert')->withInput()->withErrors($matrizley->errors);
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
      
 
           $matrizley = MatrizLey::find($id);
   
        return View::make('matriz.ley.formulario')->with("matrizley", $matrizley);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $matrizley = MatrizLey::find($id);



        $datos = Input::all(); 
        
        if ($matrizley->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matrizley->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $matrizley->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('matrizLey')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matrizLey/update/'.$id)->withInput()->withErrors($matrizley->errors);
            //return "mal2";
        }

        return Redirect::to('matrizLey')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $matrizley = MatrizLey::find($id);

        $matrizley->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>