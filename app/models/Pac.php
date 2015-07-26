<?php
class Pac extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'pac';
    protected $fillable = array('faena','personal_id','ohsas','iso9','iso1','audinterna','audexterna','revgerencial','reccliente','inspecciones','legal', 'nc','obs','om','identificacion','porque1','porque2','porque3','porque4','porque5');



public function actividadPac()
{
    return $this->hasMany("ActividadPac");
}


    public function muchaspersonal()
{
    return $this->belongsToMany("Personal",'actividad_pac','pac_id','personal_id')
    ->withpivot("id","actividad","frecuencia","tipoplan","personal_admin_id","id", "estado","adjunto1", "adjunto2","adjunto3","adjunto4","adjunto5",'fechaenvio')

    ->withTimestamps();
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