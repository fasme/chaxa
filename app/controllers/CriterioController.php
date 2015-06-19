<?php
class CriterioController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $criterioexposicions = CriterioExposicion::all();
        $criterioconsecuencias = CriterioConsecuencia::all();
        $criterioprobabilidads = CriterioProbabilidad::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matriz.criterio.show')
        ->with("criterioexposicions",$criterioexposicions)
        ->with("criterioconsecuencias",$criterioconsecuencias)
        ->with("criterioprobabilidads",$criterioprobabilidads);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $criterio = new Criterio; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('criterios.formulario')->with("criterio",$criterio);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $criterio = new Criterio;

        $datos = Input::all(); 
        
        if ($criterio->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $criterio->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $criterio->save();

            return Redirect::to('criterio')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('criterio/insert')->withInput()->withErrors($criterio->errors);
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
      
 
           $criterio = Criterio::find($id);
   
        return View::make('criterios.formulario')->with("criterio", $criterio);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $criterio = Criterio::find($id);



        $datos = Input::all(); 
        
        if ($criterio->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $criterio->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $criterio->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('criterio')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('criterio/update/'.$id)->withInput()->withErrors($criterio->errors);
            //return "mal2";
        }

        return Redirect::to('criterio')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $criterio = Criterio::find($id);

        $criterio->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>