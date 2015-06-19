<?php
class ClasificacionController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $clasificacions = Clasificacion::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matriz.clasificacion.show')->with("clasificacions",$clasificacions);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $clasificacion = new Clasificacion; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('matriz.clasificacion.formulario')->with("clasificacion",$clasificacion);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $clasificacion = new Clasificacion;

        $datos = Input::all(); 
        
        if ($clasificacion->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $clasificacion->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $clasificacion->save();

            return Redirect::to('clasificacion')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('clasificacion/insert')->withInput()->withErrors($clasificacion->errors);
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
      
 
           $clasificacion = Clasificacion::find($id);
   
        return View::make('matriz.clasificacion.formulario')->with("clasificacion", $clasificacion);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $clasificacion = Clasificacion::find($id);



        $datos = Input::all(); 
        
        if ($clasificacion->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $clasificacion->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $clasificacion->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('clasificacion')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('clasificacion/update/'.$id)->withInput()->withErrors($clasificacion->errors);
            //return "mal2";
        }

        return Redirect::to('clasificacion')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $clasificacion = Clasificacion::find($id);

        $clasificacion->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>