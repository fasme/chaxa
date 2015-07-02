<?php
class MatrizPeligroController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $matrizpeligros = MatrizPeligro::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matriz.peligro.show')->with("matrizpeligros",$matrizpeligros);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $matrizpeligro = new MatrizPeligro; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('matriz.peligro.formulario')->with("matrizpeligro",$matrizpeligro);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $matrizpeligro = new MatrizPeligro;

        $datos = Input::all(); 
        
        if ($matrizpeligro->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matrizpeligro->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $matrizpeligro->save();

            return Redirect::to('matrizPeligro')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matrizpeligro/insert')->withInput()->withErrors($matrizpeligro->errors);
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
      
 
           $matrizpeligro = MatrizPeligro::find($id);
   
        return View::make('matriz.peligro.formulario')->with("matrizpeligro", $matrizpeligro);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $matrizpeligro = MatrizPeligro::find($id);



        $datos = Input::all(); 
        
        if ($matrizpeligro->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matrizpeligro->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $matrizpeligro->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('matrizPeligro')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matrizpeligro/update/'.$id)->withInput()->withErrors($matrizpeligro->errors);
            //return "mal2";
        }

        return Redirect::to('matrizPeligro')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $matrizpeligro = MatrizPeligro::find($id);

        $matrizpeligro->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>