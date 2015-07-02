<?php
class MatrizRiesgoController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $matrizriesgos = MatrizRiesgo::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matriz.riesgo.show')->with("matrizriesgos",$matrizriesgos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $matrizriesgo = new MatrizRiesgo; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('matriz.riesgo.formulario')->with("matrizriesgo",$matrizriesgo);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $matrizriesgo = new MatrizRiesgo;

        $datos = Input::all(); 
        
        if ($matrizriesgo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matrizriesgo->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $matrizriesgo->save();

            return Redirect::to('matrizRiesgo')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matrizRiesgo/insert')->withInput()->withErrors($matrizriesgo->errors);
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
      
 
           $matrizriesgo = MatrizRiesgo::find($id);
   
        return View::make('matriz.riesgo.formulario')->with("matrizriesgo", $matrizriesgo);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $matrizriesgo = MatrizRiesgo::find($id);



        $datos = Input::all(); 
        
        if ($matrizriesgo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matrizriesgo->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $matrizriesgo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('matrizRiesgo')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matrizriesgo/update/'.$id)->withInput()->withErrors($matrizriesgo->errors);
            //return "mal2";
        }

        return Redirect::to('matrizRiesgo')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $matrizriesgo = MatrizRiesgo::find($id);

        $matrizriesgo->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>