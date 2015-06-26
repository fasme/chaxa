<?php
class MantencionController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $mantencions = Mantencion::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('mantencion.mantencion.show')->with("mantencions",$mantencions);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert($idvehiculo)
    {
        $mantencion = new Mantencion; 
        $vehiculo = Vehiculo::find($idvehiculo);


        
        return View::make('mantencion.mantencion.formulario')
        ->with("mantencion",$mantencion)
        ->with("vehiculo",$vehiculo);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $mantencion = new Mantencion;

        $datos = Input::all(); 
        
        if ($mantencion->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario

            if($datos["fecha_mantencion"])
            {
                list($dia,$mes,$ano) = explode("/",$datos['fecha_mantencion']);
            $datos['fecha_mantencion'] = "$ano-$mes-$dia";

            }

            $mantencion->fill($datos);

            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $mantencion->save();

            return Redirect::to('mantencion')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('mantencion/insert')->withInput()->withErrors($mantencion->errors);
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
      
 
           $mantencion = Mantencion::find($id);
           $vehiculo = Vehiculo::find($mantencion->vehiculo->id);


        
        return View::make('mantencion.mantencion.formulario')
        ->with("mantencion",$mantencion)
        ->with("vehiculo",$vehiculo);
   
           
 
      
    }


    public function update2($id) //post
    {
        
         $mantencion = Mantencion::find($id);



        $datos = Input::all(); 
        
        if ($mantencion->isValid($datos))
        {
            
            if($datos["fecha_mantencion"])
            {
                list($dia,$mes,$ano) = explode("/",$datos['fecha_mantencion']);
            $datos['fecha_mantencion'] = "$ano-$mes-$dia";

            }
            
            $mantencion->fill($datos);
           

      
            
           $mantencion->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('mantencion')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('mantencion/update/'.$id)->withInput()->withErrors($mantencion->errors);
            //return "mal2";
        }

        return Redirect::to('mantencion')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $mantencion = Mantencion::find($id);

        $mantencion->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>