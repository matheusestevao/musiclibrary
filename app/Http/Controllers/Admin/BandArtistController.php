<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BandArtist;
use App\Models\Genre;
use App\Models\GenreBand;
use App\Models\Album;
use App\Models\Song;

class BandArtistController extends Controller
{

    private $BandArtist;

    public function __construct (BandArtist $BandArtist)
    {

        $this->BandArtist = $BandArtist;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $bandArtists = BandArtist::all();

        return view('admin.band_artists.index',['bandArtists' => $bandArtists]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $genres = Genre::all();

        return view('admin.band_artists.create-edit',['genres' => $genres]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = validator($request->all(), $this->BandArtist->rulesStore);

        if ($validate->fails()) {
            
            $genres = Genre::all();

            return redirect()
                        ->route('admin.bandArtist.create')
                        ->with('genres', $genres)
                        ->withErrors($validate)
                        ->withInput();

        }

        $form = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameOriginalPhoto   = explode('.', $request['image']->getClientOriginalName())[0];
            $extension           = $request['image']->extension();
            $namePhoto           = date('d-m-Y H-i-s')."_photo_{$nameOriginalPhoto}.{$extension}";
            $uploadPhoto         = $request->image->storeAs('band_artist', $namePhoto);
                
            if (!$uploadPhoto) {
                 return redirect()
                            ->back()
                            ->with('error','Erro ao salvar a Imagem '.$nameOriginalPhoto.'. Favor tente novamente. Caso o erro persista, entrar em contato com nossa equipe.');   
            }

            $form['image'] = $namePhoto;

        }

        $bandArtists = BandArtist::create($form);

        if ($bandArtists) {

            

            foreach ($form['genre'] as $genre) {
                $genreBand = new GenreBand();
                $genreBand->band_artist_id  = $bandArtists->id;
                $genreBand->genre_id = $genre;
                $genreBand->save();
            }

            return redirect()
                        ->route('admin.bandArtist.index')
                        ->with('success','Banda/Artista cadastrado com Sucesso.');

        } else {

            return redirect()
                        ->route('admin.bandArtist.create')
                        ->with('error','Erro ao salvar. Favor tente novamente. Caso o erro persista, favor entrar em contato com nossa equipe.')
                        ->withInput();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $bandArtists = BandArtist::find($id);
        $genreBand   = GenreBand::where('band_id',$id)->get();
        $genre       = Genre::all();

        return view('admin.band_artists.create-edit',['bandArtist' => $bandArtist, 'genreBand' => $genreBand, 'genre' => $genre]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validate = validator($request->all(), $this->BandArtist->rulesUpdate);

        if ($validate->fails()) {
            
            $genreBand   = GenreBand::where('band_id',$id)->get();
            $genres      = Genres::all();

            return redirect()
                        ->route('admin.bandArtists.create')
                        ->with('genres', $genres)
                        ->with('genreBand', $genreBand)
                        ->withErrors($validate)
                        ->withInput();

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $id = $request->id;

        $albums = Album::where('band_artist_id',$id)->get();

        foreach ($albums as $album) {
            
            $song = Song::where('album_id',$album->id)->delete();

            $album->delete();

        }

        $genreBands = GenreBand::where('band_artist_id',$id)->get();

        foreach ($genreBands as $genreBands) {

            $genreBands->delete();

        }

        $bandArtist = BandArtist::find($id);
        $bandArtist->delete();


        return 'success';

    }
}
