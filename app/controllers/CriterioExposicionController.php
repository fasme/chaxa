<?php
class CriterioExposicionController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $criterioexposicions = CriterioExposicion::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('criterioexposicions.show')->with("criterioexposicions",$criterioexposicions);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $criterioexposicion = new CriterioExposicion; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('matriz.criterio.exposicion.formulario')->with("criterioexposicion",$criterioexposicion);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $criterioexposicion = new CriterioExposicion;

        $datos = Input::all(); 
        
        if ($criterioexposicion->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $criterioexposicion->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $criterioexposicion->save();

            return Redirect::to('criterio')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('criterioexposicion/insert')->withInput()->withErrors($criterioexposicion->errors);
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
      
 
           $criterioexposicion = CriterioExposicion::find($id);
   
        return View::make('matriz.criterio.exposicion.formulario')->with("criterioexposicion", $criterioexposicion);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $criterioexposicion = CriterioExposicion::find($id);



        $datos = Input::all(); 
        
        if ($criterioexposicion->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $criterioexposicion->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $criterioexposicion->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('criterioexposicion')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('criterioexposicion/update/'.$id)->withInput()->withErrors($criterioexposicion->errors);
            //return "mal2";
        }

        return Redirect::to('criterio')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $criterioexposicion = CriterioExposicion::find($id);

        $criterioexposicion->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>