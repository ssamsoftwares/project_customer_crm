@extends('layouts.main')

@push('page-title')
    <title>{{ 'Dashboard' }}</title>
@endpush

@push('style')
@endpush

@push('heading')
    {{ 'Dashboard' }}
@endpush

@section('content')
    {{-- quick info --}}

        @role('superadmin')
        <div class="row">
            <x-design.card heading="Total Customers" value="{{$total['customers']}}" icon="mdi-account-convert" desc="Customers" />
            <x-design.card heading="Total Project" value="{{$total['projects']}}" icon="mdi-account-convert"
                desc="Project" />
        </div>
        @endrole

        @role('customer')
        <div class="row">
            <x-design.card heading="Total Project" value="#" icon="mdi-account-convert"
                desc="Project" />
        </div>
        @endrole





@endsection


@push('script')

@endpush
