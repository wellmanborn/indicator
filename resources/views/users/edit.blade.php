@extends('layouts.carbon')

@section("breadcrumb")
    <div class="breadcrumb-item">{{ __("Update User") }} {{ $user->name }}</div>
@endsection

@section('content')
    <div class="page-title">
        <h3>{{ __("Update User") }} {{ $user->name }}</h3>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel-box">
                <h4>{{ __("Update User") }} {{ $user->name }}</h4>
                <form id="create-letter-form" class="form-horizontal" action="{{ route("users.update", $user->id) }}" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            @csrf
                            @method("PUT")
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="name">{{ __("Name") }}</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="name" required
                                           value="{{ $user->name }}"
                                           type="text" name="name">
                                    @error('name')
                                    <ul class="parsley-errors-list filled" aria-hidden="false">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="email">{{ __("Email") }}</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="email" required
                                           value="{{ $user->email }}"
                                           type="email" name="email">
                                    @error('email')
                                    <ul class="parsley-errors-list filled" aria-hidden="false">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="role">{{ __("Role") }}</label>
                                <div class="col-sm-8">
                                    <select required id="role" name="role" class="form-control">
                                        <option value="">لطفا انتخاب نمایید</option>
                                        <option @if($user->role == "user") selected @endif value="user">{{ __("User") }}</option>
                                        <option @if($user->role == "admin") selected @endif value="admin">{{ __("Admin") }}</option>
                                    </select>
                                    @error('role')
                                    <ul class="parsley-errors-list filled" aria-hidden="false">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-theme btn-form-submit">{{ __("Submit") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
