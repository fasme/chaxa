<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// LOGIN



Route::get('login', function(){
    return View::make('login.login');
});


Route::get("prueba", function(){
	return "hola";
});




Route::post('login', array('uses' => 'UsuariosController@postLogin'));

Route::get('logout', 'UsuariosController@logOut');






Route::group(array('before' => 'auth'), function()
{



Route::group(array("before"=>"permisoAdmin"), function()
{


Route::get('/', array('uses' => 'DashboardController@show'));
}); // FIN FILTER ADMIN PERMISO

// USUARIOS
Route::get('usuarios', array('uses' => 'UsuariosController@show')); 
// si en el navegador se ingresa a /usuarios se ejecutara el controlador show donde se mostraran todos los usuarios

Route::get('usuarios/insert', array('uses' => 'UsuariosController@insert'));
//ruta para añadir nuevo usuario, solo muestra es el formulario
 
Route::post('usuarios/insert', array('uses' => 'UsuariosController@insert2'));
// esta ruta es a la cual apunta el formulario donde se introduce la información del usuario
// como podemos observar es para recibir peticiones POST

Route::get('usuarios/update/{id}', 'UsuariosController@update');
// vista del formulario editar

Route::post('usuarios/update/{id}', 'UsuariosController@update2');
// edita los datos enviados por el formulario



// funcion para select dinamico
/*
Route::get('dropdown', function(){
		$id = Input::get('id');
		$user = Usuario::find($id);

$user->delete();



	});

*/
Route::get('usuarios/eliminar', 'UsuariosController@eliminar');




//Route::get('/', array('uses' => 'ClienteController@show'));



// categoria biblio
Route::get('categoria', array('uses' => 'CategoriaController@show')); 
Route::get('categoria/insert', array('uses' => 'CategoriaController@insert'));
Route::post('categoria/insert', array('uses' => 'CategoriaController@insert2'));
Route::get('categoria/update/{id}', 'CategoriaController@update');
Route::post('categoria/update/{id}', 'CategoriaController@update2');
Route::get('categoria/eliminar', 'CategoriaController@eliminar');
Route::get('categoria/mostrar', 'CategoriaController@mostrar');

//Archivo
Route::get('archivo', array('uses' => 'ArchivoController@show')); 
Route::get('archivo/insert', array('uses' => 'ArchivoController@insert'));
Route::post('archivo/insert', array('uses' => 'ArchivoController@insert2'));
Route::get('archivo/update/{id}', 'ArchivoController@update');
Route::post('archivo/update/{id}', 'ArchivoController@update2');
Route::get('archivo/eliminar', 'ArchivoController@eliminar');
Route::get('archivo/archivoobsoleto', 'ArchivoController@archivoobsoleto');

//criterio
Route::get('criterio', array('uses' => 'CriterioController@show')); 
Route::get('criterio/insert', array('uses' => 'CriterioController@insert'));
Route::post('criterio/insert', array('uses' => 'CriterioController@insert2'));
Route::get('criterio/update/{id}', 'CriterioController@update');
Route::post('criterio/update/{id}', 'CriterioController@update2');
Route::get('criterio/eliminar', 'CriterioController@eliminar');


//criterio exposicion
Route::get('criterioexposicion', array('uses' => 'CriterioExposicionController@show')); 
Route::get('criterioexposicion/insert', array('uses' => 'CriterioExposicionController@insert'));
Route::post('criterioexposicion/insert', array('uses' => 'CriterioExposicionController@insert2'));
Route::get('criterioexposicion/update/{id}', 'CriterioExposicionController@update');
Route::post('criterioexposicion/update/{id}', 'CriterioExposicionController@update2');
Route::get('criterioexposicion/eliminar', 'CriterioExposicionController@eliminar');

//criterio probabilidad
Route::get('criterioprobabilidad', array('uses' => 'CriterioProbabilidadController@show')); 
Route::get('criterioprobabilidad/insert', array('uses' => 'CriterioProbabilidadController@insert'));
Route::post('criterioprobabilidad/insert', array('uses' => 'CriterioProbabilidadController@insert2'));
Route::get('criterioprobabilidad/update/{id}', 'CriterioProbabilidadController@update');
Route::post('criterioprobabilidad/update/{id}', 'CriterioProbabilidadController@update2');
Route::get('criterioprobabilidad/eliminar', 'CriterioProbabilidadController@eliminar');

//criterio consecuencia
Route::get('criterioconsecuencia', array('uses' => 'CriterioConsecuenciaController@show')); 
Route::get('criterioconsecuencia/insert', array('uses' => 'CriterioConsecuenciaController@insert'));
Route::post('criterioconsecuencia/insert', array('uses' => 'CriterioConsecuenciaController@insert2'));
Route::get('criterioconsecuencia/update/{id}', 'CriterioConsecuenciaController@update');
Route::post('criterioconsecuencia/update/{id}', 'CriterioConsecuenciaController@update2');
Route::get('criterioconsecuencia/eliminar', 'CriterioConsecuenciaController@eliminar');


//Biblioteca
Route::get('biblioteca', array('uses' => 'BibliotecaController@show')); 
Route::get('biblioteca/insert', array('uses' => 'BibliotecaController@insert'));
Route::post('biblioteca/insert', array('uses' => 'BibliotecaController@insert2'));
Route::get('biblioteca/update/{id}', 'BibliotecaController@update');
Route::post('biblioteca/update/{id}', 'BibliotecaController@update2');
Route::get('biblioteca/eliminar', 'BibliotecaController@eliminar');
Route::get('biblioteca/archivos/{id}', 'BibliotecaController@archivos');



//noticia
Route::get('noticia', array('uses' => 'NoticiaController@show')); 
Route::get('noticia/insert', array('uses' => 'NoticiaController@insert'));
Route::post('noticia/insert', array('uses' => 'NoticiaController@insert2'));
Route::get('noticia/update/{id}', 'NoticiaController@update');
Route::post('noticia/update/{id}', 'NoticiaController@update2');
Route::get('noticia/eliminar', 'NoticiaController@eliminar');
Route::post('noticia/uploadimage', 'NoticiaController@uploadimage');


// matriz
Route::get('matriz', array('uses' => 'MatrizController@show')); 
Route::get('matriz/insert', array('uses' => 'MatrizController@insert'));
Route::post('matriz/insert', array('uses' => 'MatrizController@insert2'));
Route::get('matriz/update/{id}', 'MatrizController@update');
Route::post('matriz/update/{id}', 'MatrizController@update2');
Route::get('matriz/eliminar', 'MatrizController@eliminar');
Route::get('matriz/mostrar', 'MatrizController@mostrar');
Route::get('matriz/pdf', 'MatrizController@pdf');
Route::get('matriz/pdf/{id}', 'MatrizController@pdfid');
Route::post('matriz/pdf/filtro', 'MatrizController@pdffiltro');
Route::get("matriz/cargarMatrizColor", "MatrizController@cargarColorMatriz");

// cambio
Route::get('cambio', array('uses' => 'CambioController@show')); 
Route::get('cambio/insert', array('uses' => 'CambioController@insert'));
Route::post('cambio/insert', array('uses' => 'CambioController@insert2'));
Route::get('cambio/update/{id}', 'CambioController@update');
Route::post('cambio/update/{id}', 'CambioController@update2');
Route::get('cambio/eliminar', 'CambioController@eliminar');


// matriz acTIVIDAD
Route::get('matrizActividad', array('uses' => 'MatrizActividadController@show')); 
Route::get('matrizActividad/insert', array('uses' => 'MatrizActividadController@insert'));
Route::post('matrizActividad/insert', array('uses' => 'MatrizActividadController@insert2'));
Route::get('matrizActividad/update/{id}', 'MatrizActividadController@update');
Route::post('matrizActividad/update/{id}', 'MatrizActividadController@update2');
Route::get('matrizActividad/eliminar', 'MatrizActividadController@eliminar');
Route::get('matrizActividad/mostrar', 'MatrizActividadController@mostrar');

// matriz peligro
Route::get('matrizPeligro', array('uses' => 'MatrizPeligroController@show')); 
Route::get('matrizPeligro/insert', array('uses' => 'MatrizPeligroController@insert'));
Route::post('matrizPeligro/insert', array('uses' => 'MatrizPeligroController@insert2'));
Route::get('matrizPeligro/update/{id}', 'MatrizPeligroController@update');
Route::post('matrizPeligro/update/{id}', 'MatrizPeligroController@update2');
Route::get('matrizPeligro/eliminar', 'MatrizPeligroController@eliminar');
Route::get('matrizPeligro/mostrar', 'MatrizPeligroController@mostrar');

// matriz riesgo
Route::get('matrizRiesgo', array('uses' => 'MatrizRiesgoController@show')); 
Route::get('matrizRiesgo/insert', array('uses' => 'MatrizRiesgoController@insert'));
Route::post('matrizRiesgo/insert', array('uses' => 'MatrizRiesgoController@insert2'));
Route::get('matrizRiesgo/update/{id}', 'MatrizRiesgoController@update');
Route::post('matrizRiesgo/update/{id}', 'MatrizRiesgoController@update2');
Route::get('matrizRiesgo/eliminar', 'MatrizRiesgoController@eliminar');
Route::get('matrizRiesgo/mostrar', 'MatrizRiesgoController@mostrar');

// matriz ley
Route::get('matrizLey', array('uses' => 'MatrizLeyController@show')); 
Route::get('matrizLey/insert', array('uses' => 'MatrizLeyController@insert'));
Route::post('matrizLey/insert', array('uses' => 'MatrizLeyController@insert2'));
Route::get('matrizLey/update/{id}', 'MatrizLeyController@update');
Route::post('matrizLey/update/{id}', 'MatrizLeyController@update2');
Route::get('matrizLey/eliminar', 'MatrizLeyController@eliminar');
Route::get('matrizLey/mostrar', 'MatrizLeyController@mostrar');


// actividadprogramadaes
Route::get('actividadprogramada', array('uses' => 'ActividadProgramadaController@show')); 
Route::get('actividadprogramada/insert', array('uses' => 'ActividadProgramadaController@insert'));
Route::post('actividadprogramada/insert', array('uses' => 'ActividadProgramadaController@insert2'));
Route::get('actividadprogramada/update/{id}', 'ActividadProgramadaController@update');
Route::post('actividadprogramada/update/{id}', 'ActividadProgramadaController@update2');
Route::get('actividadprogramada/eliminar', 'ActividadProgramadaController@eliminar');


// actividadnoprogramadaes
Route::get('actividadnoprogramada', array('uses' => 'ActividadNoProgramadaController@show')); 
Route::get('actividadnoprogramada/insert', array('uses' => 'ActividadNoProgramadaController@insert'));
Route::post('actividadnoprogramada/insert', array('uses' => 'ActividadNoProgramadaController@insert2'));
Route::get('actividadnoprogramada/update/{id}', 'ActividadNoProgramadaController@update');
Route::post('actividadnoprogramada/update/{id}', 'ActividadNoProgramadaController@update2');
Route::get('actividadnoprogramada/eliminar', 'ActividadNoProgramadaController@eliminar');

//actividadPac
Route::get('actividadpac', array('uses' => 'ActividadPacController@show')); 

//Evidencia
Route::get('evidenciaadmin', array('uses' => 'EvidenciaController@show')); 
Route::get('evidenciaadmin/eliminar', array('uses' => 'EvidenciaController@eliminar'));
Route::get('evidenciaadmin/eliminarusuario', array('uses' => 'EvidenciaController@eliminarusuario')); 
Route::get('evidenciaadmin/cerraractividad', array('uses' => 'EvidenciaController@cerraractividad')); 


//clasificacion
Route::get('clasificacion', array('uses' => 'ClasificacionController@show')); 
Route::get('clasificacion/insert', array('uses' => 'ClasificacionController@insert'));
Route::post('clasificacion/insert', array('uses' => 'ClasificacionController@insert2'));
Route::get('clasificacion/update/{id}', 'ClasificacionController@update');
Route::post('clasificacion/update/{id}', 'ClasificacionController@update2');
Route::get('clasificacion/eliminar', 'ClasificacionController@eliminar');


//personala
Route::get('personal', array('uses' => 'PersonalController@show')); 
Route::get('personal/insert', array('uses' => 'PersonalController@insert'));
Route::post('personal/insert', array('uses' => 'PersonalController@insert2'));
Route::get('personal/update/{id}', 'PersonalController@update');
Route::post('personal/update/{id}', 'PersonalController@update2');
Route::get('personal/eliminar', 'PersonalController@eliminar');
Route::get('personal/cambiarclave', 'PersonalController@cambiarclave');
Route::post('personal/cambiarclave/{id}', 'PersonalController@cambiarclave2');

//cargo
Route::get('cargo', array('uses' => 'CargoController@show')); 
Route::get('cargo/insert', array('uses' => 'CargoController@insert'));
Route::post('cargo/insert', array('uses' => 'CargoController@insert2'));
Route::get('cargo/update/{id}', 'CargoController@update');
Route::post('cargo/update/{id}', 'CargoController@update2');
Route::get('cargo/eliminar', 'CargoController@eliminar');

//PAC
Route::get('pac', array('uses' => 'PacController@show')); 
Route::get('pac/insert', array('uses' => 'PacController@insert'));
Route::post('pac/insert', array('uses' => 'PacController@insert2'));
Route::get('pac/update/{id}', 'PacController@update');
Route::post('pac/update/{id}', 'PacController@update2');
Route::get('pac/eliminar', 'PacController@eliminar');


//KPI
Route::get('kpi', array('uses' => 'KpiController@show')); 
Route::get('kpi/insert', array('uses' => 'KpiController@insert'));
Route::post('kpi/insert', array('uses' => 'KpiController@insert2'));
Route::get('kpi/update/{id}', 'KpiController@update');
Route::post('kpi/update/{id}', 'KpiController@update2');
Route::get('kpi/eliminar', 'KpiController@eliminar');


//KPI Objetivo
Route::get('kpiobjetivo', array('uses' => 'KpiobjetivoController@show')); 
Route::get('kpiobjetivo/insert', array('uses' => 'KpiobjetivoController@insert'));
Route::post('kpiobjetivo/insert', array('uses' => 'KpiobjetivoController@insert2'));
Route::get('kpiobjetivo/update/{id}', 'KpiobjetivoController@update');
Route::post('kpiobjetivo/update/{id}', 'KpiobjetivoController@update2');
Route::get('kpiobjetivo/eliminar', 'KpiobjetivoController@eliminar');


//VEHICULO
Route::get('vehiculo', array('uses' => 'VehiculoController@show')); 
Route::get('vehiculo/insert', array('uses' => 'VehiculoController@insert'));
Route::post('vehiculo/insert', array('uses' => 'VehiculoController@insert2'));
Route::get('vehiculo/update/{id}', 'VehiculoController@update');
Route::post('vehiculo/update/{id}', 'VehiculoController@update2');
Route::get('vehiculo/eliminar', 'VehiculoController@eliminar');


//VEHICULO
Route::get('mantencion', array('uses' => 'MantencionController@show')); 
Route::get('mantencion/insert/{idvehiculo}', array('uses' => 'MantencionController@insert'));
Route::post('mantencion/insert', array('uses' => 'MantencionController@insert2'));
Route::get('mantencion/update/{id}', 'MantencionController@update');
Route::post('mantencion/update/{id}', 'MantencionController@update2');
Route::get('mantencion/eliminar', 'MantencionController@eliminar');


//Medica
Route::get('medica', array('uses' => 'MedicaController@show')); 
Route::get('medica/insert', array('uses' => 'MedicaController@insert'));
Route::post('medica/insert', array('uses' => 'MedicaController@insert2'));
Route::get('medica/update/{id}', 'MedicaController@update');
Route::post('medica/update/{id}', 'MedicaController@update2');
Route::get('medica/eliminar', 'MedicaController@eliminar');





//INFORMES

Route::get("informeevidencia", array("uses"=>"InformeController@informeevidencia"));
Route::get("informemantencion", array("uses"=>"InformeController@informemantencion"));

// Manual

Route::get('manual', function(){
	return View::make('manual.show');
});







// portal


Route::get('portal', function(){
	
	return View::make("portal.index");
}); 


Route::get('misactividades', function(){
	
	return View::make("portal.actividades");
}); 

Route::post('evidenciaupdate', 'PersonalController@evidencia');


Route::get('bibliotecaportal', function(){
	
	return View::make("portal.biblioteca");
}); 

Route::get("manualusuario", function(){
	return View::make("portal.manual");
});


Route::get("matrizportal", function(){
	return View::make("portal.matriz");
});


Route::get("mantencionportal", function(){
	return View::make("portal.mantencion");
});


Route::get("mantencionportal/mostrar", array("uses"=>"MantencionController@insertPortal"));
Route::post('mantencionportal/insert', array('uses' => 'MantencionController@insert2Portal'));
Route::get('vehiculoportal/update', array('uses' => 'VehiculoController@updatePortal'));
Route::post('vehiculoportal/update/{id}', array('uses' => 'VehiculoController@update2Portal'));



});  // FIN FILTER
















