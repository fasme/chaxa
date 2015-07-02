<?php
class UsuariosController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $usuarios = Usuario::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('usuarios.show')->with("usuarios",$usuarios);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $usuario = new Usuario; 
        //enviamos un usuario vacio para que cargue el formulario insert
        return View::make('usuarios.formulario')->with("usuario",$usuario);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $usuario = new Usuario;

        $datos = Input::all(); 
       // print_r($datos);
        
        if ($usuario->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $usuario->fill($datos);

            print_r($usuario);

            // Guardamos el usuario
         

        
            
           $usuario->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('UsuariosController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('usuarios/insert')->withInput()->withErrors($usuario->errors);
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
      
 
           $usuario = Usuario::find($id);
   
        return View::make('usuarios.formulario')->with("usuario", $usuario);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $usuario = Usuario::find($id);


        $datos = Input::all(); 
        
        if ($usuario->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $usuario->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

      
            
           $usuario->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('UsuariosController@show');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('usuarios/insert')->withInput()->withErrors($usuario->errors);
            //return "mal2";
        }

        return Redirect::to('usuarios');
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $usuario = Usuario::find($id);

        $usuario->delete();

    //return Redirect::to('usuarios/insert');
    }


 public function postLogin(){

    if (Auth::attempt(['usuario' => Input::get('usuario'), 'password' => Input::get('password') ], true)){
       
         return Redirect::to("portal");
         
        //
    }else{
        
        return Redirect::to('login')->with('mensaje_login', 'Ingreso invalido')->withInput();
    }
    
    }


    public function logOut(){

        Auth::logout();
        
        return Redirect::to('login')->with('mensaje_login', 'Tu sesión ha sido cerrada.');
    }


 






}



?>