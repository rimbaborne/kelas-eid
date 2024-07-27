<?php

namespace App\Tables;

use App\Models\Peserta;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class AdministrasiPeserta extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Peserta::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
        ->withGlobalSearch(columns: ['user.name', 'user.email'])
        ->rowLink(fn (Peserta $peserta) => route('admin.peserta.show', [ 'id' =>  $peserta->user_id ] ))
        ->searchInput(
            key     : 'agen.user.name',
            label   : 'Cari Agen'
        )
        ->column(
            key     : 'user.name',
            label   : 'Nama'
        )
        ->column(
            key     : 'user.email',
            label   : 'Email'
        )
        ->column(
            key     : 'user.phone_number',
            label   : 'Nomor'
        )
        ->column(
            key     : 'agen.user.name',
            label   : 'Agen'
        )
        ->column(
            key     : 'kelas.nama',
            label   : 'Kelas'
        )
        ->paginate(10)


        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        ->export()
        ;
    }
}
