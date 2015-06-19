<?php
class MatrizController extends BaseController {
 
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function show()
    {
        $matrizs = Matriz::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('matriz.show')->with("matrizs",$matrizs);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function insert()
    {
        $matriz = new Matriz; 

        $matrizPeligro = MatrizPeligro::lists("nombre","id");
        
        $matrizActividad = MatrizActividad::lists("nombre","id");

        $matrizRiesgo = MatrizRiesgo::lists("nombre","id");

        $matrizCargo = Cargo::lists("nombre","id");

        $criterioConsecuencia = CriterioConsecuencia::lists("descripcion","factor");

        $criterioExposicion = CriterioExposicion::lists("descripcion","factor");

        $criterioProbabilidad = CriterioProbabilidad::lists("descripcion","factor");
        
        return View::make('matriz.formulario')->with("matriz",$matriz)
        ->with("matrizPeligro",$matrizPeligro)
        ->with("matrizActividad",$matrizActividad)
        ->with("matrizRiesgo",$matrizRiesgo)
        ->with("matrizCargo",$matrizCargo)
        ->with("criterioConsecuencia",$criterioConsecuencia)
        ->with("criterioExposicion",$criterioExposicion)
        ->with("criterioProbabilidad",$criterioProbabilidad);
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function insert2()
    {

        $matriz = new Matriz;

        $datos = Input::all(); 

        
        if ($matriz->isValid($datos))
        {
            
            $matriz->fill($datos);


         
           $matriz->save();

           $matriz = Matriz::find($matriz->id);
           //echo count($datos["actividad_id"]);
           for($i=0;$i<count($datos["actividad_id"]);$i++)
           {
            
            $matriz->muchasactividad()->attach($datos["actividad_id"][$i]);
           }

           for($i=0;$i<count($datos["riesgo_id"]);$i++)
           {
            
            $matriz->muchasriesgo()->attach($datos["riesgo_id"][$i]);
           }

           for($i=0;$i<count($datos["cargo_id"]);$i++)
           {
            
            $matriz->muchascargo()->attach($datos["cargo_id"][$i]);
           }
           
           
          
            return Redirect::to('matriz')->with("mensaje","Datos Ingresados correctamente");
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matriz/insert')->withInput()->withErrors($matriz->errors);
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
      
 
           $matriz = Matriz::find($id);
           $matrizPeligro = MatrizPeligro::lists("nombre","id");
        
        $matrizActividad = MatrizActividad::lists("nombre","id");

        $matrizRiesgo = MatrizRiesgo::lists("nombre","id");

        $matrizCargo = Cargo::lists("nombre","id");

        $criterioConsecuencia = CriterioConsecuencia::lists("descripcion","factor");

        $criterioExposicion = CriterioExposicion::lists("descripcion","factor");

        $criterioProbabilidad = CriterioProbabilidad::lists("descripcion","factor");
   
        return View::make('matriz.formulario')->with("matriz",$matriz)
        ->with("matrizPeligro",$matrizPeligro)
        ->with("matrizActividad",$matrizActividad)
        ->with("matrizRiesgo",$matrizRiesgo)
        ->with("matrizCargo",$matrizCargo)
        ->with("criterioConsecuencia",$criterioConsecuencia)
        ->with("criterioExposicion",$criterioExposicion)
        ->with("criterioProbabilidad",$criterioProbabilidad);
 
                
 
      
    }


    public function update2($id) //post
    {
        
         $matriz = Matriz::find($id);



        $datos = Input::all(); 
        
        if ($matriz->isValid($datos))
        {
            // Si la data es valida se la asignamos al usuario
            $matriz->fill($datos);
            // Guardamos el usuario
             //$usuario->password = Hash::make($usuario->password);

        


           //echo count($datos["actividad_id"]);
            $matriz->muchasactividad()->detach();
           for($i=0;$i<count($datos["actividad_id"]);$i++)
           {
            
            $matriz->muchasactividad()->attach($datos["actividad_id"][$i]);
           }

           $matriz->muchasriesgo()->detach();
           for($i=0;$i<count($datos["riesgo_id"]);$i++)
           {
            
            $matriz->muchasriesgo()->attach($datos["riesgo_id"][$i]);
           }

           $matriz->muchascargo()->detach();
           for($i=0;$i<count($datos["cargo_id"]);$i++)
           {
            
            $matriz->muchascargo()->attach($datos["cargo_id"][$i]);
           }
            
           $matriz->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            //return Redirect::action('ClienteController@show');
           return Redirect::to('matriz')->with("mensaje","Datos actualizados correctamente");

            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('matriz/update/'.$id)->withInput()->withErrors($matriz->errors);
            //return "mal2";
        }

        return Redirect::to('matriz')->with("mensaje","NO");
      
    }



    public function eliminar()
    {
        $id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $matriz = Matriz::find($id);

        $matriz->delete();

    //return Redirect::to('usuarios/insert');
    }


    public function cargarColorMatriz(){
        $resultado = Input::get("resultado");
        $clasificacion = Clasificacion::Where("desde","<=",$resultado)->Where("hasta",">",$resultado)->first();
        return $clasificacion->color;
    }


    public function pdf(){

        $matrizs = Matriz::all();
        $view = View::make('matriz.pdf')->with("matrizs",$matrizs);
        return PDF::load($view, 'A4', 'landscape')->show();

    }


    public function pdfid($id){

        $matriz = Matriz::find($id);
         $view = View::make('matriz.pdfid')->with("matriz",$matriz);
        return PDF::load($view, 'A4', 'landscape')->show();

    }

    public function pdffiltro(){

          $datos = Input::all();

          $matrizs = Matriz::Wherein("id", $datos["selectmatrices"])->get();

          $view = View::make('matriz.pdf')->with("matrizs",$matrizs);
       return PDF::load($view, 'A4', 'landscape')->show();
        
        //$matriz = Matriz::find($id);
        // $view = View::make('matriz.pdfid')->with("matriz",$matriz);
        //return PDF::load($view, 'A4', 'landscape')->show();

    }



 






}



?>