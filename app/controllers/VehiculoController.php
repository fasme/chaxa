<?php
class VehiculoController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $vehiculos = Vehiculo::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('mantencion.vehiculo.show')->with("vehiculos",$vehiculos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $vehiculo = new Vehiculo; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('mantencion.vehiculo.formulario')->with("vehiculo",$vehiculo);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $vehiculo = new Vehiculo;

        $datos = Input::all(); 
        
        if ($vehiculo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $vehiculo->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $vehiculo->save();

            return Redirect::to('vehiculo')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('vehiculo/insert')->withInput()->withErrors($vehiculo->errors);
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
      
 
           $vehiculo = Vehiculo::find($id);
   
        return View::make('mantencion.vehiculo.formulario')->with("vehiculo",$vehiculo);
                
 
      
    }


    public function update2($id) //post
    {
        
         $vehiculo = Vehiculo::find($id);



        $datos = Input::all(); 
        
        if ($vehiculo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $vehiculo->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $vehiculo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('vehiculo')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('vehiculo/update/'.$id)->withInput()->withErrors($vehiculo->errors);
            //return "mal2";
        }

        return Redirect::to('vehiculo')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $vehiculo = Vehiculo::find($id);

        $vehiculo->delete();

    //return Redirect::to('usuarios/insert');
    }






 

 // P O R T A L

    public function updatePortal(){
    $id = Input::get('id');
    
    return View::make("portal.modalhorometro")->with("id",$id);
}



public function update2Portal($id) //post
    {
        
         $datos = Input::all(); 

         $vehiculo = Vehiculo::find($id);

         $dif =  $datos["horometro"] - $vehiculo->horometro;


         $vehiculohorometro = new VehiculoHorometro(array("horometro"=>$dif));




       
        
        if ($vehiculo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $vehiculo->fill($datos);


           $vehiculo->save();


           $vehiculo->vehiculohorometro()->save($vehiculohorometro);

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('mantencionportal')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('vehiculo/update/'.$id)->withInput()->withErrors($vehiculo->errors);
            //return "mal2";
        }

        return Redirect::to('mantencionportal')->with("mensaje","NO");
      
    }






}



?>