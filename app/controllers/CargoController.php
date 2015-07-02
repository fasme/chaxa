<?php
class CargoController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $cargos = Cargo::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('personal.cargo.show')->with("cargos",$cargos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $cargo = new Cargo; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('personal.cargo.formulario')->with("cargo",$cargo);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $cargo = new Cargo;

        $datos = Input::all(); 
        
        if ($cargo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $cargo->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $cargo->save();

            return Redirect::to('personal')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cargo/insert')->withInput()->withErrors($cargo->errors);
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
      
 
           $cargo = Cargo::find($id);
   
        return View::make('personal.cargo.formulario')->with("cargo", $cargo);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $cargo = Cargo::find($id);



        $datos = Input::all(); 
        
        if ($cargo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $cargo->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $cargo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('personal')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('cargo/update/'.$id)->withInput()->withErrors($cargo->errors);
            //return "mal2";
        }

        return Redirect::to('cargo')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $cargo = Cargo::find($id);

        $cargo->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>