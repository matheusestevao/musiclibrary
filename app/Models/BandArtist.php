<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\GenreBand;

class BandArtist extends Model
{

	public $fillable = ['name', 'type', 'image', 'description'];

    public $rulesStore = [
        
        'name'  	  => 'required',
        'genre' 	  => 'required',
        'image' 	  => 'required|image',
        'description' => 'required',
        
    ];

    public $rulesUpdate = [
        
        'name'  	  => 'required',
        'genre' 	  => 'required',
        'description' => 'required',
        
    ];

    public function ReturnGenres ($id)
    {

        $genreBand = GenreBand::where('band_artist_id',$id)->get();

        $nameGenre = array();

        foreach ($genreBand as $genre) {
            $nameGenre[] = Genre::find($genre->genre_id)->name;
        }

        return implode(",", $nameGenre);

    }
}
