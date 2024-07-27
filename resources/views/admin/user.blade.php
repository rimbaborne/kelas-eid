@extends('layouts.dashboard')
@section('content')
    <div class="flow-root pb-6">
        <div class="mx-auto">
            <h1 class="text-lg font-bold text-capitalize pb-4">
                User
            </h1>
        </div>
        <section class="text-gray-900 body-font">
            <div class="mx-auto">
                <x-splade-table  :for="$user" >
                </x-splade-table>
            </div>
        </section>
    </div>
@endsection
