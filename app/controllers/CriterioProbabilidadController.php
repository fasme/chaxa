<?php
class CriterioProbabilidadController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $criterioprobabilidads = CriterioProbabilidad::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('criterioprobabilidads.show')->with("criterioprobabilidads",$criterioprobabilidads);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $criterioprobabilidad = new CriterioProbabilidad; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('matriz.criterio.probabilidad.formulario')->with("criterioprobabilidad",$criterioprobabilidad);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $criterioprobabilidad = new CriterioProbabilidad;

        $datos = Input::all(); 
        
        if ($criterioprobabilidad->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $criterioprobabilidad->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $criterioprobabilidad->save();

            return Redirect::to('criterio')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('criterioprobabilidad/insert')->withInput()->withErrors($criterioprobabilidad->errors);
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
      
 
           $criterioprobabilidad = CriterioProbabilidad::find($id);
   
        return View::make('matriz.criterio.probabilidad.formulario')->with("criterioprobabilidad", $criterioprobabilidad);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $criterioprobabilidad = CriterioProbabilidad::find($id);



        $datos = Input::all(); 
        
        if ($criterioprobabilidad->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $criterioprobabilidad->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $criterioprobabilidad->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('criterio')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('criterioprobabilidad/update/'.$id)->withInput()->withErrors($criterioprobabilidad->errors);
            //return "mal2";
        }

        return Redirect::to('criterioprobabilidad')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $criterioprobabilidad = CriterioProbabilidad::find($id);

        $criterioprobabilidad->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>