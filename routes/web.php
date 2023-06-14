<?php

use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\PetakerawananController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/", [LandingpageController::class, "landing"]);
// Login
Route::get('/login', function () { return view('login');})->name('login');
Route::post('/postlogin',[LoginController::class, 'postlogin'])->name('postlogin');
Route::get( '/logout',[LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function () {
        Route::get('/index', [AdminController::class, 'admin'])->middleware('checkRole:admin');
        Route::get('/indexguru', [GuruController::class, 'indexguru'])->name('indexguru')->middleware('checkRole:admin');
        Route::get('/tambahdataguru', [GuruController::class, 'tambahdataguru'])->middleware('checkRole:admin');
        Route::post('/insertdataguru', [GuruController::class, 'insertdataguru'])->middleware('checkRole:admin');
        Route::get('/tampilkandataguru/{id}', [GuruController::class, 'tampilkandataguru'])->middleware('checkRole:admin');
        Route::post('/updatedataguru/{id}', [GuruController::class, 'updatedataguru'])->middleware('checkRole:admin');
        Route::get('/deletedataguru/{id}', [GuruController::class, 'deletedataguru'])->middleware('checkRole:admin');
        
        // Controller Siswa
        Route::get('/indexsiswa', [SiswaController::class, 'datasiswa'])->name('datasiswa')->middleware('checkRole:admin');
        Route::get('/tambahsiswa', [SiswaController::class, 'tambahsiswa'])->middleware('checkRole:admin');
        Route::post('/insertdatasiswa', [SiswaController::class, 'insertdatasiswa'])->middleware('checkRole:admin');
        Route::get('/tampilkandatasiswa/{id}', [SiswaController::class, 'tampilkandatasiswa'])->middleware('checkRole:admin');
        Route::post('/updatedatasiswa/{id}', [SiswaController::class, 'updatedatasiswa'])->middleware('checkRole:admin');
        Route::get('/deletedatasiswa/{id}', [SiswaController::class, 'deletedatasiswa'])->middleware('checkRole:admin');
        
        // kelas
        Route::get('/kelas', [AdminController::class, 'kelas'])->name('kelas')->middleware('checkRole:admin');
        Route::get('/tambahkelas', [AdminController::class, 'tambahkelas'])->middleware('checkRole:admin');
        Route::post('/insertdatakelas', [AdminController::class, 'insertdatakelas'])->name('insertdatakelas')->middleware('checkRole:admin');
        Route::get('/deletedatakelas/{id}', [AdminController::class, 'deletedatakelas'])->name('deletedatakelas')->middleware('checkRole:admin');
        
        // Route::get('/deletedatakelas/{id}', [Petakerawanan::class, 'deletedatakelas'])->name('deletedatakelas')->middleware('checkRole:guru');
        
        // Wali Kelas
        Route::get('/indexwalas', [WaliKelasController::class, 'datawalikelas'])->name('datawalikelas')->middleware('checkRole:admin');
        Route::get('/tambahdatawalikelas', [WaliKelasController::class, 'tambahwalikelas'])->name('tambahwalikelas')->middleware('checkRole:admin');
        Route::post('/insertdatawalikelas', [WaliKelasController::class, 'insertdatawalikelas'])->name('insertdatawalikelas')->middleware('checkRole:admin');
        Route::get('/tampilkandatawalikelas/{id}', [WaliKelasController::class, 'tampilkadatawalikelas'])->middleware('checkRole:admin');
        Route::post('/updateDatawalikelas/{id}', [WaliKelasController::class, 'updateDatawalikelas'])->middleware('checkRole:admin');
        Route::get('/deletedatawalikelas/{id}', [WaliKelasController::class, 'deletedatawalikelas'])->middleware('checkRole:admin');
        
        //profil
        Route::get('/guru', [GuruController::class, 'guru'])->name('guru')->middleware('checkRole:guru');
        Route::post('/updateprofilguru/{id}', [GuruController::class, 'updateprofilguru'])->middleware('checkRole:guru');
        
        //kelas siswa
        Route::get('/akunSiswa', [GuruController::class, 'akunSiswa'])->middleware('checkRole:guru');
        Route::get('/siswa/{kelasId}', [GuruController::class, 'menampikanmurid'])->middleware('checkRole:guru');//memampilkan murid sesuai login
        
        //buat jadwal
        Route::get('/buatJadwal', [GuruController::class, 'buatJadwal'])->middleware('checkRole:guru');
        Route::post('/getdatasiswa', [GuruController::class, 'getSiswaByKelas']);
        Route::post('/tambahjadwal', [GuruController::class, 'tambahjadwal'])->middleware('checkRole:guru');
        Route::post('/mundurkanjadwal/{id}', [GuruController::class, 'mundurkanjadwal'])->middleware('checkRole:guru');
        Route::post('/terimajadwal/{id}', [GuruController::class, 'terimajadwal'])->middleware('checkRole:guru');
        Route::post('/selesaikanjadwal/{id}', [GuruController::class, 'selesaikanjadwal'])->middleware('checkRole:guru');
        
        //History
        Route::get('/history', [GuruController::class, 'history'])->middleware('checkRole:guru');
        
        //Profil
        Route::get('/profilsiswa', [SiswaController::class, 'profilsiswa'])->name('profilsiswa')->middleware('checkRole:siswa');
        Route::post('/updateprofilsiswa/{id}', [SiswaController::class, 'updateprofilsiswa'])->middleware('checkRole:siswa');
        
        //Jadwal Panggilan
        Route::get('/jadwal', [SiswaController::class, 'jadwal'])->name('jadwal')->middleware('checkRole:siswa');
        Route::post('/siswatambahJadwal', [SiswaController::class, 'siswatambahJadwal'])->middleware('checkRole:siswa');
        
        //Archives
        Route::get('/histori', [SiswaController::class, 'histori'])->middleware('checkRole:siswa');
        
        //Profil
        Route::get('/profilwalas', [WaliKelasController::class, 'profilwalas'])->name('profilwalas')->middleware('checkRole:wali_kelas');
        Route::post('/updateprofilwalikelas/{id}', [WaliKelasController::class, 'updateprofilwalikelas'])->middleware('checkRole:wali_kelas');
        
        
        //Jadwal Panggilan
        Route::get('/jadwalkonseling', [WaliKelasController::class, 'jadwalkonseling'])->middleware('checkRole:wali_kelas');
        Route::post('/imputhasilbelajar/{id}', [WaliKelasController::class, 'imputhasilbelajar'])->middleware('checkRole:wali_kelas');
        
        
        //hasil konseling
        Route::get('/hasilkonseling', [WaliKelasController::class, 'hasilkonseling'])->name('hasilkonseling')->middleware('checkRole:wali_kelas');
        
        Route::get('/indexpetakerawanan', [AdminController::class, 'indexpetakerawanan'])->name('indexpetakerawanan')->middleware('checkRole:admin');
        Route::get('/tambahpelanggaran', [AdminController::class, 'tambahpelanggaran'])->name('tambahpelanggaran')->middleware('checkRole:admin');
        Route::post('/insertpetakerawanan', [AdminController::class, 'insertpetakerawanan'])->name('insertpetakerawanan')->middleware('checkRole:admin');
        Route::get('/deletepetakerawanan/{id}', [AdminController::class, 'deletepetakerawanan'])->name('deletepetakerawanan')->middleware('checkRole:admin');      
        
        //petapelanggaran/guru////
    Route::get('/petakerawananguru', [PetakerawananController::class, 'datapetakerawanann'])->name('petakerawanann')->middleware('checkRole:guru');
    Route::get('/tambahpetakerawananguru', [PetakerawananController::class, 'tambahpetakerawanann'])->name('tambahpetakerawanann')->middleware('checkRole:guru');
    Route::post('/insertkerawananguru', [PetakerawananController::class, 'storekerawanann'])->name('insertkerawanann')->middleware('checkRole:guru');
    Route::get('/jeniskerawananguru/{id}', [PetakerawananController::class, 'jeniskerawanann'])->name('jeniskerawanann')->middleware('checkRole:guru');
    Route::get('/deletekerawanan/{id}', [PetakerawananController::class, 'deletekerawanann'])->name('deletekerawanann')->middleware('checkRole:guru');
    //ENDDGURU
    Route::get('/exportexcel', [AdminController::class, 'exportToExcel'])->name('exportexcel');
//     /////PETAKERAWANAN/WALAS//////
    Route::get('/petakerawanan', [WaliKelasController::class, 'datakerawananwalas'])->name('petakerawanan')->middleware('checkRole:wali_kelas');
    Route::get('/tambahpetakerawanan', [WaliKelasController::class, 'tambahpetakerawanan'])->name('tambahpetakerawanan')->middleware('checkRole:wali_kelas');
    Route::post('/insertkerawanan', [WaliKelasController::class, 'storekerawanan'])->name('insertkerawanan')->middleware('checkRole:wali_kelas');
    Route::get('/jeniskerawanan/{id}', [WaliKelasController::class, 'jeniskerawanan'])->name('jeniskerawanan')->middleware('checkRole:wali_kelas');
    Route::get('/deletekerawanan/{id}', [WaliKelasController::class, 'deletekerawanan'])->name('deletekerawanan')->middleware('checkRole:wali_kelas');
});
