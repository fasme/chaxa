<?php
class CriterioConsecuenciaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $criterioconsecuencias = CriterioConsecuencia::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matriz.criterio.consecuencia.show')->with("criterioconsecuencias",$criterioconsecuencias);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $criterioconsecuencia = new CriterioConsecuencia; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('matriz.criterio.consecuencia.formulario')->with("criterioconsecuencia",$criterioconsecuencia);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $criterioconsecuencia = new CriterioConsecuencia;

        $datos = Input::all(); 
        
        if ($criterioconsecuencia->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $criterioconsecuencia->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $criterioconsecuencia->save();

            return Redirect::to('criterio')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('criterioconsecuencia/insert')->withInput()->withErrors($criterioconsecuencia->errors);
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
      
 
           $criterioconsecuencia = CriterioConsecuencia::find($id);
   
        return View::make('matriz.criterio.consecuencia.formulario')->with("criterioconsecuencia", $criterioconsecuencia);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $criterioconsecuencia = CriterioConsecuencia::find($id);



        $datos = Input::all(); 
        
        if ($criterioconsecuencia->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $criterioconsecuencia->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $criterioconsecuencia->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('criterio')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('criterioconsecuencia/update/'.$id)->withInput()->withErrors($criterioconsecuencia->errors);
            //return "mal2";
        }

        return Redirect::to('criterioconsecuencia')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $criterioconsecuencia = CriterioConsecuencia::find($id);

        $criterioconsecuencia->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>