<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::any('historic-search', 'BalanceController@searchHistoric')->name('historic.search');
    Route::get('historic', 'BalanceController@historic')->name('admin.historic');

    Route::get('balance', 'BalanceController@index')->name('admin.balance');

    Route::get('deposit', 'BalanceController@deposit')->name('balance.deposit');
    Route::post('deposit', 'BalanceController@depositStore')->name('deposit.store');


    Route::get('transfer', 'BalanceController@transfer')->name('balance.transfer');
    Route::post('transfer', 'BalanceController@transferStore')->name('transfer.store');
    Route::post('confirm-transfer', 'BalanceController@confirmTransfer')->name('confirm.transfer');

    Route::get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');
    Route::post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');

    Route::get('/', 'AdminController@index')->name('admin.home');
});

Route::group(['middleware' => ['auth'], 'namespace' => 'Painel', 'prefix' => 'painel'], function () {
    Route::resource('estado','EstadoController');
    Route::resource('cidade','CidadeController');
    Route::resource('pessoa','PessoaController');
    Route::resource('empresa','EmpresaController');
    Route::resource('usuario','UsuarioController');
    Route::resource('compra','CompraController');
});

//Rota de envio do xml
Route::group(['middleware' => ['auth'], 'namespace' => 'Painel'], function () {
    Route::post('painel/compra/create', 'CompraController@createCrompra')->name('compra.create-compra');
    Route::post('painel/compra/xml', 'CompraController@xml')->name('compra.xml');
});

//Rota de relatórios
Route::group(['middleware' => ['auth'], 'namespace' => 'Painel'], function () {
    Route::any('painel/relatorio', 'RelatorioController@relatorioCompra')->name('relatorio.compra');
    Route::any('painel/relatorio/gerar', 'RelatorioController@selecionaRelatorio')->name('relatorio.gerar');
    Route::any('painel/relatorio/compra', 'RelatorioController@indexCompra')->name('index.compra');

});

Route::post('atualizar_perfil', 'Admin\UserController@profileUpdate')->name('profile.update')->middleware('auth');
Route::get('meu_perfil', 'Admin\UserController@profile')->name('profile')->middleware('auth');

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
