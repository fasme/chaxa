<?php
class KpiobjetivoController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $kpiobjetivos = Kpiobjetivo::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('kpiobjetivo.show')->with("kpiobjetivos",$kpiobjetivos);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $kpiobjetivo = new Kpiobjetivo; 
        $personals = Personal::lists("nombre","id");
        return View::make('kpi.kpiobjetivo.formulario')
        ->with("kpiobjetivo",$kpiobjetivo)
        ->with("personals",$personals);
     
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $kpiobjetivo = new Kpiobjetivo;

        $datos = Input::all(); 

        
        if ($kpiobjetivo->isValid($datos))
        {
            
            $kpiobjetivo->fill($datos);


         
           $kpiobjetivo->save();

           
         
           
          
            return Redirect::to('kpi')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('kpiobjetivo/insert')->withInput()->withErrors($kpiobjetivo->errors);
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
      
 
           $kpiobjetivo = Kpiobjetivo::find($id);
           $personals = Personal::lists("nombre","id");
         
        return View::make('kpi.kpiobjetivo.formulario')
        ->with("kpiobjetivo",$kpiobjetivo)
        ->with("personals",$personals);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $kpiobjetivo = Kpiobjetivo::find($id);



        $datos = Input::all(); 
        
        if ($kpiobjetivo->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $kpiobjetivo->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

        


            
           $kpiobjetivo->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('kpi')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('kpiobjetivo/update/'.$id)->withInput()->withErrors($kpiobjetivo->errors);
            //return "mal2";
        }

        return Redirect::to('kpiobjetivo')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $kpiobjetivo = Kpiobjetivo::find($id);

        $kpiobjetivo->delete();

    //return Redirect::to('usuarios/insert');
    }



 






}



?>