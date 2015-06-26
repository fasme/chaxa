<?php
class MedicaController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $medicas = Medica::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('medica.show')->with("medicas",$medicas);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $medica = new Medica; 
        $personal = Personal::lists("nombre","id");

        
        return View::make('medica.formulario')
        ->with("medica",$medica)->with("personal",$personal);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $medica = new Medica;


        $datos = Input::all(); 

        $random = rand(0,99999);
        
        if ($medica->isValid($datos))
        {
             

                
            $medica->fill($datos);
            // Guardamos el usuario
            /* $usuario->password = Hash::make($usuario->password);*/

          
      
            
           $medica->save();

            return Redirect::to('medica')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('medica/insert')->withInput()->withErrors($medica->errors);
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
      
 
           $medica = Medica::find($id);
           $personal = Personal::lists("nombre","id");
   
        return View::make('medica.formulario')->with("medica", $medica)
        ->with("personal",$personal);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $medica = Medica::find($id);
 $datos = Input::all(); 

$random = rand(0,99999);
       
        
        if ($medica->isValid($datos))
        {

                $medica->fill($datos);


      
            
           $medica->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('medica')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('medica/update/'.$id)->withInput()->withErrors($medica->errors);
            //return "mal2";
        }

        return Redirect::to('medica')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $medica = Medica::find($id);

        $medica->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>