<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class AdministrasiUser extends AbstractTable
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
        return User::query();
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
        ->withGlobalSearch(columns: ['name', 'email'])
        ->rowLink(fn (User $user) => route('admin.user.show', [ 'id' =>  $user->id ] ))
        ->column(
            key     : 'name',
            label   : 'Nama'
        )
        ->column(
            key     : 'email',
            label   : 'Email'
        )
        ->column(
            key     : 'phone_number',
            label   : 'Nomor'
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
