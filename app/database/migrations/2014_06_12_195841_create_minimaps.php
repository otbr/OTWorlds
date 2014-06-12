<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinimaps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		mkdir(public_path() . '/img/maps');
    
    $maps = Map::all();
    foreach($maps as $map)
    {
      Minimap::$filename = $map->minimapPath();
      Minimap::create($map->width, $map->height);
      $tiles = Tile::where('mapid', $map->id)->where('posz', 7)->get();
      foreach($tiles as $tile)
      {
        Minimap::paint($tile->posx, $tile->posy, $tile->itemid);
      }
      Minimap::save();
    }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
    $files = glob(public_path() . '/img/maps/*'); // get all file names
    foreach($files as $file)
    {
      if(is_file($file)) unlink($file);
    }
    rmdir(public_path() . '/img/maps');
	}

}
