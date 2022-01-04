@extends('layouts.carbon')

@section("breadcrumb")
    <div class="breadcrumb-item">{{ __("Create New User") }}</div>
@endsection

@section('content')
    <div class="page-title">
        <h3>{{ __("Create New User") }}</h3>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel-box">
                <h4>{{ __("Create New User") }}</h4>
                <form id="create-letter-form" class="form-horizontal" action="{{ route("users.store") }}" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="name">{{ __("Name") }}</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="name" required
                                           value="{{ old("name") }}"
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
                                           value="{{ old("email") }}"
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
                                        <option @if(old("role") == "user") selected @endif value="user">{{ __("User") }}</option>
                                        <option @if(old("role") == "admin") selected @endif value="admin">{{ __("Admin") }}</option>
                                    </select>
                                    @error('role')
                                    <ul class="parsley-errors-list filled" aria-hidden="false">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="password">{{ __("Password") }}</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="password" required
                                           type="password" name="password">
                                    @error('password')
                                    <ul class="parsley-errors-list filled" aria-hidden="false">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="password_confirmation">{{ __("Repeat Password") }}</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="password_confirmation" required
                                           type="password" name="password_confirmation">
                                    @error('password_confirmation')
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
