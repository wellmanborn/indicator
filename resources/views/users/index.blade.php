@extends('layouts.carbon')

@section("breadcrumb")
    <div class="breadcrumb-item">{{ __("Users List") }}</div>
@endsection

@section('content')
    <div class="page-title">
        <h3>{{ __("Users List") }}</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-box">
                <div class="table-responsive">
                    <table id="users-table table-striped" class="table data-table">
                        <thead>
                        <tr>
                            <th class="no-sort">{{ __("Row") }}</th>
                            <th>{{ __("Name") }}</th>
                            <th>{{ __("Role") }}</th>
                            <th>{{ __("Email") }}</th>
                            <th>{{ __("Created Date") }}</th>
                            <th>{{ __("Updated at") }}</th>
                            <th>{{ __("Status") }}</th>
                            <th>{{ __("Actions") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($users as $user)
                                <tr>
                                    <th class="no-sort">{{ $i++ }}</th>
                                    <th>{{ $user->name }}</th>
                                    <th>{{ __($user->role) }}</th>
                                    <th>{{ $user->email }}</th>
                                    <th class="text-en">{{ ViewHelper::to_persian_datetime($user->created_at) }}</th>
                                    <th class="text-en">{{ ViewHelper::to_persian_datetime($user->updated_at) }}</th>
                                    <th>{!! ViewHelper::get_status($user->active) !!}</th>
                                    <th>
                                        @if(auth()->user()->role == "admin")
                                            <div class="dropdown">
                                                <button class="btn btn-border-theme btn-xs btn-table dropdown-toggle" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">عملیات</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="will-change: transform; margin: 0;">
                                                    <a class="dropdown-item" href="{{ route("users.change_activation", $user->id) }}" type="button">{{ __("Change Activation") }}</a>
                                                    <a class="dropdown-item" href="{{ route("users.edit", $user->id) }}" type="button">{{ __("Edit") }}</a>
                                                    <a class="dropdown-item" href="{{ route("users.edit_password", $user->id) }}" data-target="1">{{ __("Change Password") }}</a>
                                                </div>
                                            </div>
                                        @endif
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        dataTableOptions = {
            "serverSide": false,
            "pageLength": 100,
            "language": {
                'url': "/js/datatables/languages/Persian.json"
            },
            "order": [[ 4, "desc" ]]
        };
        let table = $('.data-table').DataTable(dataTableOptions);
    </script>
@endpush
