<?php
class Noticia extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'noticia';
    protected $fillable = array('titulo','descripcion','archivo1','archivo2','archivo3','archivo4');







public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
          //  'cliente_id'     => 'exists:cliente,id',
          //  "guiavalue" => "required",
            
         
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }





}
?>