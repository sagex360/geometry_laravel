<?php

Route::prefix('figures')->group(static function () {
    Route::get('/', 'FiguresController@index')->name('figures.list');
    Route::post('/', 'FiguresController@store')->name('figures.create');
    Route::put('/change-color', 'FiguresController@changeColor')->name('figures.change.color');
});

Route::prefix('revisions')->group(static function () {
    Route::post('/revert/{revision}', 'RevisionsController@revert')->name('revisions.revert');
    Route::post('/revertLast/{quantity}', 'RevisionsController@revertLast')->name('revisions.revertLast');
});

