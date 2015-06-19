<?php
class Pac extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'pac';
    protected $fillable = array('faena','personal_id','ohsas','iso9','iso1','audinterna','audexterna','revgerencial','reccliente','inspecciones','legal', 'nc','obs','om','identificacion','porque1','porque2','porque3','porque4','porque5');



public function actividadPac()
{
    return $this->hasMany("ActividadPac");
}



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