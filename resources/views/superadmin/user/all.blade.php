@extends('layouts.main')

@push('page-title')
    <title>All Customers</title>
@endpush

@push('heading')
    {{ 'All Customers' }}
@endpush

@section('content')
@push('style')
<style>
</style>
@endpush

    <x-status-message />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="justify-content-end d-flex">
                    <x-search.table-search action="{{ route('users.index') }}" method="get" name="search"
                        value="{{$search}}" btnClass="search_btn" />
                    </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>{{ '#' }}</th>
                                <th>{{ 'Name' }}</th>
                                <th>{{ 'Email' }}</th>
                               <th>{{ 'Password' }}</th>
                                <th>{{ 'Status' }}</th>
                                <th>{{ 'Actions' }}</th>

                            </tr>
                        </thead>

                        <tbody id="candidatesData">
                            @foreach ($data as $key => $user)
                            @if (!$user->hasRole('superadmin'))
                                <tr>
                                    <td>{{ $data->perPage() * ($data->currentPage() - 1) + $loop->index + 1 }}
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ !empty($user->normal_password)? $user->normal_password : NULL }}</td>
                                    <td>
                                        @if ($user->status == 'active')

                                        <a href="{{route('user.statusUpdate',$user->id)}}" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure Block This Customer')">Active</a>
                                        @else

                                        <a href="{{route('user.statusUpdate',$user->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure Active This Customer')">Block</a>
                                        @endif
                                    </td>

                                    </td>
                                    <td>
                                        <div class="action-btns text-center" role="group">

                                            <a href="{{ route('users.show',$user->id) }}"
                                                class="btn btn-primary waves-effect waves-light view">
                                                <i class="ri-eye-line"></i>
                                            </a>

                                            <a href="{{ route('users.edit',$user->id) }}"
                                                class="btn btn-info waves-effect waves-light edit">
                                                <i class="ri-pencil-line"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    {{ $data->appends(request()->query())->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@push('script')
@endpush
