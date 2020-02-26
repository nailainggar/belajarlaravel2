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

Route::get('/', function () {
    return view('welcome');
});
//import model
use App\Mahasiswa;
use App\Dosen;
use App\Hobi;


// route one to one
Route::get('relasi-1',function()
{
    // memilih data mahasiswa yg memiliki nim '101010101'
    $mhs = Mahasiswa::where('nim','=','1010101')->first();

    //menampilkan data wali dari mahasiswa yg dipilih
    return $mhs->wali->nama;

});

Route::get('relasi-2',function()
{
    // memilih data mahasiswa yg memiliki nim '101010101'
    $mhs = Mahasiswa::where('nim','=','1010101')->first();

    //menampilkan data wali dari mahasiswa yg dipilih
    return $mhs->wali->nama;

});

//one to many
Route::get('relasi-3',function()
{
    // mencari dosen dengan yg bernama abdul musthafa
    $dosen = Dosen::where('nama','=','Abdul Musthafa')->first();

    //menampilkan seluruh data mahasiswa didikannya
    foreach ($dosen->mahasiswa as $temp)
        echo '<li> Nama : ' . $temp->nama .
             '<strong>' . $temp->nim .  '</strong>
             </li>';


});

Route::get('relasi-4', function()
{
    // mencari mahasiswa yg bernama dadang
    $dadang = Mahasiswa::where('nama','=','Dadang Peloy')->first();

    //menampilkan seluruh hobi dari dadang
    foreach ($dadang->hobi as $temp)
        echo '<li>' . $temp->hobi . '</li>';

});

Route::get('relasi-5', function()
{
    // mencari mahasiswa yg bernama dadang
    $gaming = Hobi::where('hobi','=','Game Mobile')->first();

    //menampilkan semua mahasiswa yg mempunyai hobi gaming
    foreach ($gaming->mahasiswa as $temp)
        echo '<li> Nama : ' . $temp->nama . '<strong>' . $temp->nim . '</strong></li>';

});

Route::get('relasi-join', function() {

    //join laravel
    $sql = DB::table('mahasiswas')
    ->select('mahasiswas.nama','mahasiswas.nim',
            'walis.nama as nama_wali')
    ->join('walis','walis.id_mahasiswa','=','mahasiswas.id')
    ->get();
    dd($sql);
});

Route::get('eloquent',function()
{
    $mahasiswa = Mahasiswa::with('wali','dosen','hobi')->get();
    return view('eloquent',compact('mahasiswa'));
});

Route::get('latihan-eloquent',function()
{
    $mahasiswa = Mahasiswa::with('wali','dosen','hobi')->take(1)->get();
    return view('latihan-eloquent',compact('mahasiswa'));
    dd($mahasiswa);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// blade template
Route::get('beranda',function()
{
    return view('beranda');
});

Route::get('tentang',function()
{
    return view('tentang');
});

Route::get('kontak',function()
{
   return view('kontak');
});

//crud
Route::resource('dosen','DosenController');
