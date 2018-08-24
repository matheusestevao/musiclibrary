<?php
Auth::routes();

//TRANSLATION ADMIN
$this->group(['prefix' => '/admin', 'middleware' => 'auth'], function () {
	$this->get('setlocale/{locale}', function ($locale) {
		Session::put('locale', $locale);

		return redirect()->back();
	})->name('admin.locale');

	$this->group(['namespace' => 'Admin'], function () {
		
		//DASHBOARD
		$this->get('/dashboard', 'HomeController@dashboard')->name('admin.dashboard');
		$this->get('/', 'HomeController@index')->name('admin.home');
		$this->get('/debug', 'HomeController@debug')->name('admin.debug');

		//USERS
		$this->group(['prefix' => 'users'], function () {
			$this->get('/', 'UsersController@index')->name('admin.user.index');
			$this->get('/create', 'UsersController@create')->name('admin.user.create');
			$this->post('/store', 'UsersController@store')->name('admin.user.store');
			$this->get('/edit/{id}', 'UsersController@edit')->name('admin.user.edit');
			$this->post('/update/{id}', 'UsersController@update')->name('admin.user.update');
			$this->post('/destroy/', 'UsersController@destroy')->name('admin.user.destroy');
			$this->get('/show/{id}', 'UsersController@show')->name('admin.user.show');
			$this->get('/password/{id}', 'UsersController@changePassword')->name('admin.user.password');
			$this->get('/update/password/{id}', 'UsersController@updatePassword')->name('admin.user.updatePassword');
		});

		//BAND_ARTIST
		$this->group(['prefix' => 'band_artists'], function () {
			$this->get('/', 'BandArtistController@index')->name('admin.bandArtist.index');
			$this->get('/create', 'BandArtistController@create')->name('admin.bandArtist.create');
			$this->post('/store', 'BandArtistController@store')->name('admin.bandArtist.store');
			$this->get('/edit/{id}', 'BandArtistController@edit')->name('admin.bandArtist.edit');
			$this->post('/update/{id}', 'BandArtistController@update')->name('admin.bandArtist.update');
			$this->post('/destroy/', 'BandArtistController@destroy')->name('admin.bandArtist.destroy');
			$this->get('/show/{id}', 'BandArtistController@show')->name('admin.bandArtist.show');
		});

		//GENRE
		$this->group(['prefix' => 'genre'], function () {
			$this->get('/', 'GenreController@index')->name('admin.genre.index');
			$this->get('/create', 'GenreController@create')->name('admin.genre.create');
			$this->post('/store', 'GenreController@store')->name('admin.genre.store');
			$this->get('/edit/{id}', 'GenreController@edit')->name('admin.genre.edit');
			$this->get('/show/{id}', 'GenreController@show')->name('admin.genre.show');
		});

	});

});

//TRANSLATION SITE
$this->group(['middleware' => 'auth'], function () {
	$this->get('setlocale/{locale}', function ($locale) {
		Session::put('locale',$locale);

		return redirect()->back();
	})->name('site.locale');	

	$this->group(['namespace' => 'Site'], function() {

		$this->get('/', 'HomeController@index')->name('site.home');

	});

});





