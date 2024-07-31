<?php

namespace App\Tables;

use App\Models\Transaction;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class AdministrasiTransaksi extends AbstractTable
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
        return Transaction::query()->orderBy('id', 'desc');
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
            ->withGlobalSearch(columns: ['user.nama'])
            ->rowLink(fn (Transaction $transaction) => route('admin.transaksi.show', ['id' =>  $transaction->id ] ))
            ->column(
                key     : 'user.name',
                label   : 'Nama'
            )
            ->column(
                key     : 'agen_id',
                label   : 'Agen'
            )
            ->column(
                key     : 'kelas.nama',
                label   : 'Kelas'
            )
            ->column(
                key     : 'channel',
                label   : 'Metode'
            )
            ->column(
                key     : 'status_pembayaran',
                label   : 'Status'
            )
            ->column(
                key     : 'created_at',
                label   : 'Tanggal'
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
