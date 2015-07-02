<?php
class CategoriaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $categorias = Categoria::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('biblioteca.categorias.show')->with("categorias",$categorias);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $categoria = new Categoria; 
        //enviamos un usuario vacio para que cargue el formulario insert

        
        return View::make('biblioteca.categorias.formulario')->with("categoria",$categoria);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $categoria = new Categoria;

        $datos = Input::all(); 
        
        if ($categoria->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $categoria->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

      
            
           $categoria->save();

            return Redirect::to('categoria')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('categoria/insert')->withInput()->withErrors($categoria->errors);
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
      
 
           $categoria = Categoria::find($id);
   
        return View::make('biblioteca.categorias.formulario')->with("categoria", $categoria);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $categoria = Categoria::find($id);



        $datos = Input::all(); 
        
        if ($categoria->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $categoria->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $categoria->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('categoria')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('categoria/update/'.$id)->withInput()->withErrors($categoria->errors);
            //return "mal2";
        }

        return Redirect::to('categoria')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $categoria = Categoria::find($id);

        $categoria->delete();

    //return Redirect::to('usuarios/insert');
    }


    public function mostrar()
    {
         $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $categoria = Categoria::find($id);

        return $categoria->id;
    }


 






}



?>