<?php

class Map extends Eloquent {
  
  /**
   * Hide attributes from JSON and Array output
   */
  protected $hidden = array('deleted_at');
  
  /**
   * Allow map to be soft deleted to avoid army of mysql queries in hard deletes
   */
  protected $softDelete = true;
  
  /**
   * Disable created_at and updated_at
   */
  public $timestamps = false;
  
  public function permissions()
  {
    return $this->hasMany('Permission', 'mapid', 'id');
  }
  
  public function minimapPath($external = false)
  {
    $encrypted_name = md5('SECRET_SAUCE-'.$this->id.'-'.$this->name);
    $encrypted_name = preg_replace('/[^a-z0-9]/i', '', $encrypted_name);
    $encrypted_name = substr($encrypted_name, 0, 32);/**/
    return ($external ? '' : public_path()) . '/img/maps/'.$encrypted_name.'.png';
  }
}
