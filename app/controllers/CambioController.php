<?php
class CambioController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $cambios = Cambio::all();
        $cambios = Cambio::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matriz.cambio.show')->with("cambios",$cambios)
        ->with("cambios",$cambios);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $cambio = new Cambio; 

    
        
        return View::make('matriz.cambio.formulario')->with("cambio",$cambio);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $cambio = new Cambio;

        $datos = Input::all(); 

        
        if ($cambio->isValid($datos))
        {
            
            $cambio->fill($datos);


         
           $cambio->save();

           
           
          
            return Redirect::to('matriz')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cambio/insert')->withInput()->withErrors($cambio->errors);
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
      
 
           $cambio = Cambio::find($id);
          
   
        return View::make('matriz.cambio.formulario')->with("cambio",$cambio);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $cambio = Cambio::find($id);



        $datos = Input::all(); 
        
        if ($cambio->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $cambio->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

        


        
            
           $cambio->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('matriz')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cambio/update/'.$id)->withInput()->withErrors($cambio->errors);
            //return "mal2";
        }

        return Redirect::to('cambio')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $cambio = Cambio::find($id);

        $cambio->delete();

    //return Redirect::to('usuarios/insert');
    }




   


 






}



?>