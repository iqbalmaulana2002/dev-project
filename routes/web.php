<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// -------------------------------------------
Route::group(['middleware' => ['checkIsActive', 'auth']], function () {
	
	Route::group(['middleware' => 'checkRole:Admin'], function () {
		// ADMIN
			// Home Admin
			Route::get('/admin', 'Admin\HomeController@index')->name('admin');

			Route::get('/admin/profile/{nama}', 'Admin\ProfileController@index');
			Route::get('/admin/profile/edit/{id}', 'Admin\ProfileController@edit');
			Route::patch('/admin/profile/edit/{id}', 'Admin\ProfileController@update');
		  // Master
			//inventaris
			Route::get('/admin/transaksi-filter', 'PinjamController@periode');
			Route::get('/admin/transaksi-filter/kembali', 'kembaliController@periode');
			Route::get('/admin/barang/exportpdf', 'databoxController@exportPdf');
			Route::get('/kembali/exportpdf', 'kembaliController@pdfKembali');
			Route::get('/barang/index', 'databoxController@index');
			Route::get('/admin/create', 'databoxController@create');
			Route::post('/admin/barang/store', 'databoxController@store');
			Route::patch('/admin/barang/update/{id_barang}', 'databoxController@update');
			Route::get('/admin/barang/edit/{id_barang}', 'databoxController@edit');
			Route::delete('/admin/destroy/{id_barang}', 'databoxController@destroy');
			Route::get('/kategori/index', 'KategoriController@index');
			Route::get('/kategori/create', 'KategoriController@create');
			Route::post('/kategori/store', 'KategoriController@store');
			Route::get('/kategori/edit/{id_kategori}', 'KategoriController@edit');
			Route::patch('/kategori/update/{id_kategori}', 'KategoriController@update');
			Route::delete('/kategori/destroy/{id_kategori}', 'KategoriController@destroy');
      		//Admin Invetaris
			Route::get('/admin/pinjam', 'PinjamController@index');
			Route::get('/admin/kembali', 'kembaliController@index');
    		//  Route::post('/admin/kembali/store', 'kembaliController@store');
			Route::patch('/admin/status/{pinjam}', 'PinjamController@update');
			Route::patch('/admin/kembali/status/{kembali}', 'kembaliController@update');
     		// Route::get('/admin/detail/{id}', 'PinjamController@show');
     		// Route::get('/admin/detail/{id}', 'kembaliController@show');
		
			// Karyawan
			Route::get('/admin/karyawan', 'Admin\KaryawanController@index');
			Route::get('/admin/karyawan/{user}', 'Admin\KaryawanController@show');
			Route::delete('/admin/karyawan/{user}', 'Admin\KaryawanController@destroy');
			Route::get('/admin/karyawan/edit/{user}', 'Admin\KaryawanController@edit');
			Route::patch('/admin/karyawan/{user}', 'Admin\KaryawanController@update');
			Route::patch('/admin/karyawan/aktivasi/{user}', 'Admin\KaryawanController@aktivasi');
			
			//Role
			Route::get('/admin/role', 'Admin\RoleController@index');
			Route::get('/admin/role/create', 'Admin\RoleController@create');
			Route::post('/admin/role', 'Admin\RoleController@store');
			Route::get('/admin/role/edit/{role}', 'Admin\RoleController@edit');
			Route::delete('/admin/role/{role}', 'Admin\RoleController@destroy');
			Route::patch('/admin/role/{role}', 'Admin\RoleController@update');
			
			//Pendidikan
			Route::get('/admin/pendidikan', 'Admin\pendidikanController@index');
			Route::get('/admin/pendidikan/create', 'Admin\pendidikanController@create');
			Route::get('/admin/pendidikan/edit/{id}', 'Admin\pendidikanController@edit');
			Route::post('/admin/pendidikan', 'Admin\pendidikanController@store');
			Route::delete('/admin/pendidikan/{id}', 'Admin\pendidikanController@destroy');
			Route::patch('/admin/pendidikan/{id}', 'Admin\pendidikanController@update');
			
			//Stream
			Route::get('/admin/stream', 'Admin\StreamController@index');
			Route::get('/admin/stream/create', 'Admin\StreamController@create');
			Route::post('/admin/stream', 'Admin\StreamController@store');
			Route::delete('/admin/stream/{stream}', 'Admin\StreamController@destroy');
			Route::get('/admin/stream/edit/{stream}', 'Admin\StreamController@edit');
			Route::patch('/admin/stream/{stream}', 'Admin\StreamController@update');
			
			//Projek
			Route::get('/admin/projek', 'Admin\ProjekController@index');
			Route::get('/admin/projek/create', 'Admin\ProjekController@create');
			Route::post('/admin/projek', 'Admin\ProjekController@store');
			Route::delete('/admin/projek/{projek}', 'Admin\ProjekController@destroy');
			Route::get('/admin/projek/edit/{projek}', 'Admin\ProjekController@edit');
			Route::patch('/admin/projek/{projek}', 'Admin\ProjekController@update');
			
			
			// Jencut
			Route::get('/admin/jeniscuti', 'Admin\JenisCutiController@index');
			Route::get('/admin/jeniscuti/create', 'Admin\JenisCutiController@create');
			Route::post('/admin/jeniscuti', 'Admin\JenisCutiController@store');
			Route::delete('/admin/jeniscuti/{jenis_cuti}', 'Admin\JenisCutiController@destroy');
			Route::get('/admin/jeniscuti/edit/{jenis_cuti}', 'Admin\JenisCutiController@edit');
			Route::patch('/admin/jeniscuti/{jenis_cuti}', 'Admin\JenisCutiController@update');
			
		  // Transaksi
			// Absen
			Route::get('/admin/absen/data-kehadiran', 'Admin\AbsensiController@index');
			Route::get('/admin/absen/data-kehadiran/{id}', 'Admin\AbsensiController@show');
			Route::patch('/admin/absen/data-kehadiran/{id}', 'Admin\AbsensiController@update');
			Route::get('/admin/absen', 'Admin\AbsensiController@create');
			Route::post('/admin/absen', 'Admin\AbsensiController@store');
			Route::get('/admin/absen/exportexcel', 'Admin\AbsensiController@exportExcel');
			Route::get('/admin/absen/exportpdf', 'Admin\AbsensiController@exportPdf');
			Route::get('/admin/absen/filter', 'Admin\AbsensiController@filterAbsen');
			Route::get('/admin/absen/cetak', 'Admin\AbsensiController@cetak');
			Route::get('/admin/absen/cetak/all', 'Admin\AbsensiController@cetakAll');
			Route::get('/admin/absen/cetak/bulan', 'Admin\AbsensiController@cetakBulan');
			Route::get('/admin/absen/cetak/{id}', 'Admin\AbsensiController@cetakNama');
			Route::get('/admin/absen/cetak/detail/{id}', 'Admin\AbsensiController@detailCetak');
		
			//Cuti
			Route::get('/admin/cuti', 'Admin\CutiController@index');
			Route::get('/admin/cuti/filter', 'Admin\CutiController@filterData');
			Route::get('/admin/cuti/{cuti}', 'Admin\CutiController@detailCuti');
			Route::patch('/admin/cuti/reset/jatah_cuti', 'Admin\CutiController@updateJatahCuti');
			Route::patch('/admin/cuti/{cuti}', 'Admin\CutiController@update');
			Route::delete('/admin/cuti/{cuti}', 'Admin\CutiController@destroy');
		// --------------------------------------------------------------------------------------		
	});

	Route::group(['middleware' => 'checkRole:Scrum Master'], function () {
		// SM
			// Home SM
			Route::get('/sm', 'SM\HomeController@index')->name('sm');

			Route::get('/sm/profile/{nama}', 'SM\ProfileController@index');
			Route::get('/sm/profile/edit/{id}', 'SM\ProfileController@edit');
			Route::patch('/sm/profile/edit/{id}', 'SM\ProfileController@update');
		  // Master
			//inventaris
			Route::get('/sm/barang/index', 'databoxController@index');
			Route::get('/sm/create', 'databoxController@create');
			Route::post('/barang/store', 'databoxController@store');
			Route::patch('/sm/barang/update/{id_barang}', 'databoxController@update');
			Route::get('/sm/barang/edit/{id_barang}', 'databoxController@edit');
			Route::delete('/sm/destroy/{id_barang}', 'databoxController@destroy');
			Route::get('/sm/kategori/index', 'KategoriController@index');
			Route::get('/sm/kategori/create', 'KategoriController@create');
			Route::post('/sm/kategori/store', 'KategoriController@store');
			Route::get('/sm/kategori/edit/{id_kategori}', 'KategoriController@edit');
			Route::patch('/sm/kategori/update/{id_kategori}', 'KategoriController@update');
			Route::delete('/sm/kategori/destroy/{id_kategori}', 'KategoriController@destroy');
      
				//Admin Invetaris
			Route::get('/sm/pinjam', 'SM\PinjamController@index');
			Route::get('/sm/kembali', 'SM\kembaliController@index');
			Route::post('/sm/kembali/store', 'SM\kembaliController@store');
			Route::patch('/sm/status/{id_pinjam}', 'SM\PinjamController@update');
			Route::patch('/sm/kembali/status/{kembali}', 'SM\kembaliController@update');
	
			//Invetaris
			Route::get('/sm/invetaris', 'SM\barangController@index');
			Route::post('/sm/kembali/store', 'SM\kembaliController@store');
			Route::get('/pinjam/create/{id_barang}', 'pinjamController@create');
			Route::get('/barang', 'barangController@index');
			Route::get('/show/{id_pinjam}', 'barangController@show');
			Route::get('/sm/tampil/table', 'SM\barangController@tampil');
			Route::post('/sm/pengajuan/store', 'SM\PinjamController@store');
			Route::post('/pengajuan/pinjam/{id_karyawan}', 'barangController@store');
		
			// Karyawan
			Route::get('/sm/karyawan', 'SM\KaryawanController@index');
			Route::get('/sm/karyawan/{user}', 'SM\KaryawanController@show');
			Route::delete('/sm/karyawan/{user}', 'SM\KaryawanController@destroy');
			Route::get('/sm/karyawan/edit/{user}', 'SM\KaryawanController@edit');
			Route::patch('/sm/karyawan/{user}', 'SM\KaryawanController@update');
			
		  // Transaksi
			// Absen
			Route::get('/sm/absen/data-kehadiran', 'SM\AbsensiController@index');
			Route::get('/sm/absen/data-kehadiran/{id}', 'SM\AbsensiController@show');
			Route::patch('/sm/absen/data-kehadiran/{id}', 'SM\AbsensiController@update');
			Route::get('/sm/absen', 'SM\AbsensiController@create');
			Route::post('/sm/absen', 'SM\AbsensiController@store');
		
			//Cuti
			Route::get('/sm/cuti', 'SM\CutiController@index');
			Route::get('/sm/cuti/show', 'SM\CutiController@cutiSm');
			Route::get('/sm/cuti/create', 'SM\CutiController@create');
			Route::get('/sm/cuti/filterSm', 'SM\CutiController@filterSm');
			Route::get('/sm/cuti/filter', 'SM\CutiController@filterData');
			Route::get('/sm/cuti/{cuti}', 'SM\CutiController@detailCutiSm');
			Route::get('/sm/cuti/detail/{cuti}', 'SM\CutiController@detailCuti');
			Route::post('/sm/cuti', 'SM\CutiController@store');
      Route::patch('/sm/cuti/{cuti}', 'SM\CutiController@update');
			
		// --------------------------------------------------------------------------------------
	});

	Route::group(['middleware' => 'checkRole:Product Owner'], function () {
		// PO
			// Home PO
			Route::get('/po', 'PO\HomeController@index')->name('po');

			Route::get('/po/profile/{nama}', 'PO\ProfileController@index');
			Route::get('/po/profile/edit/{id}', 'PO\ProfileController@edit');
			Route::patch('/po/profile/edit/{id}', 'PO\ProfileController@update');
		  // Master
			//inventaris
			Route::get('/po/transaksi-filter/index', 'PO\PinjamController@periode');
			Route::get('/po/transaksi-filter/kembali', 'PO\kembaliController@periode');
			Route::get('/po/exportpdf/pinjam', 'PO\databoxController@exportPdf');
			Route::get('/kembali/barang/exportpdf', 'PO\kembaliController@exportPdf');
			Route::get('/po/barang/index', 'PO\databoxController@index');
			Route::get('/po/create', 'PO\databoxController@create');
			Route::post('/po/barang/store', 'PO\databoxController@store');
			Route::patch('/po/barang/update/{id_barang}', 'PO\databoxController@update');
			Route::get('/po/barang/edit/{id_barang}', 'PO\databoxController@edit');
			Route::delete('/po/destroy/{id_barang}', 'PO\databoxController@destroy');
			Route::get('/po/kategori/index', 'KategoriController@index');
			Route::get('/po/kategori/create', 'KategoriController@create');
			Route::post('/po/kategori/store', 'KategoriController@store');
			Route::get('/po/kategori/edit/{id_kategori}', 'KategoriController@edit');
			Route::patch('/po/kategori/update/{id_kategori}', 'KategoriController@update');
			Route::delete('/po/kategori/destroy/{id_kategori}', 'KategoriController@destroy');
			//PO Invetaris
			Route::get('/po/pinjam', 'PO\PinjamController@index');
			Route::get('/po/kembali', 'PO\kembaliController@index');
			Route::post('/po/kembali/store', 'PO\kembaliController@store');
			Route::patch('/po/status/{pinjam}', 'PO\PinjamController@update');
			Route::patch('/po/kembali/status/{kembali}', 'PO\kembaliController@update');
			//Invetaris
			Route::get('/po/invetaris', 'PO\barangController@index');
			Route::post('/kembali/store', 'kembaliController@store');
			Route::get('/pinjam/create/{id_barang}', 'pinjamController@create');
			Route::get('/barang', 'barangController@index');
			Route::get('/show/{id_pinjam}', 'barangController@show');
			Route::get('/po/tampil/table', 'PO\barangController@tampil');
			Route::post('po/pengajuan/store', 'PO\PinjamController@store');
			Route::post('/pengajuan/pinjam/{id_karyawan}', 'barangController@store');
			Route::get('/kategori', 'barangController@cobajax');
			Route::get('/po/barang/exportpdf/{id}', 'PO\barangController@exportPdf');
			Route::delete('/po/user/destroy/{id}', 'PO\barangController@destroy');
		//---------------------------------------------------------------------------------------
			// Karyawan
			Route::get('/po/karyawan', 'PO\KaryawanController@index');
			Route::get('/po/karyawan/{user}', 'PO\KaryawanController@show');
			
		  // Transaksi
			// Absen
			Route::get('/po/absen/data-kehadiran', 'PO\AbsensiController@index');
			Route::get('/po/absen/data-kehadiran/{id}', 'PO\AbsensiController@show');
			Route::patch('/po/absen/data-kehadiran/{id}', 'PO\AbsensiController@update');
			Route::get('/po/absen', 'PO\AbsensiController@create');
			Route::post('/po/absen', 'PO\AbsensiController@store');
			Route::get('/po/absen/filter', 'PO\AbsensiController@filterAbsen');
		
			// Cuti
			Route::get('/po/cuti', 'PO\CutiController@index');
			Route::get('/po/cuti/show', 'PO\CutiController@cutiPo');
			Route::get('/po/cuti/create', 'PO\CutiController@create');
			Route::get('/po/cuti/filterPo', 'PO\CutiController@filterPo');
			Route::get('/po/cuti/filter', 'PO\CutiController@filterData');
			Route::get('/po/cuti/{cuti}', 'PO\CutiController@detailCutiPo');
			Route::get('/po/cuti/detail/{cuti}', 'PO\CutiController@detailCuti');
			Route::post('/po/cuti', 'PO\CutiController@store');
      Route::patch('/po/cuti/{cuti}', 'PO\CutiController@update');
			
		// --------------------------------------------------------------------------------------
	});

	Route::group(['middleware' => 'checkRole:User'], function () {
		// USER
			// Home User
			Route::get('/', 'Home@index')->name('home');
			Route::get('/profile/{nama}', 'ProfileController@index');
			Route::get('/profile/edit/{id}', 'ProfileController@edit');
			Route::patch('/profile/edit/{id}', 'ProfileController@update');
		
			// Absen
			Route::get('/absen', 'AbsenController@index');
			Route::post('/absen', 'AbsenController@store');
			
			// Cuti
			Route::get('/cuti', 'CutiController@index');
			Route::get('/cuti/create', 'CutiController@create');
			Route::get('/cuti/{cuti}', 'CutiController@show');
			Route::get('/user/cuti/filter', 'CutiController@filterData');
			Route::post('/cuti', 'CutiController@store');
		
			//Invetaris
			Route::get('/invetaris', 'barangController@index');
			Route::post('/kembali/store', 'kembaliController@store');
			Route::get('/pinjam/create/{id_barang}', 'pinjamController@create');
			Route::get('/barang', 'barangController@index');
			Route::get('/show/{id_pinjam}', 'barangController@show');
			Route::get('/tampil/table', 'barangController@tampil');
			Route::post('/pengajuan/store', 'PinjamController@store');
			Route::post('/pengajuan/pinjam/{id_karyawan}', 'barangController@store');
			Route::get('/kategori', 'barangController@cobajax');
			Route::get('/user/barang/exportpdf/{id}', 'barangController@exportPdf');
			Route::delete('/user/destroy/{id}', 'barangController@destroy');
		
		// --------------------------------------------------------------------------------------
	});
	
	Route::group(['middleware' => 'checkRole:Admin,Product Owner,Scrum Master,User'], function () {
		Route::get('/logout', 'AuthController@logout');
	});

});


// --------------------------------------------------------------------------------------

// });

// Login
    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@login');
// Registrasi
    Route::get('/registrasi', 'AuthController@create');
		Route::post('/registrasi', 'AuthController@store');
