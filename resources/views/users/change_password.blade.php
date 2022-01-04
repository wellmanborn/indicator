@extends('layouts.carbon')

@section("breadcrumb")
    <div class="breadcrumb-item">{{ __("Change Password") }} {{ $user->name }}</div>
@endsection

@section('content')
    <div class="page-title">
        <h3>{{ __("Change Password") }} {{ $user->name }}</h3>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel-box">
                <h4>{{ __("Change Password") }} {{ $user->name }}</h4>
                <form id="create-letter-form" class="form-horizontal" action="{{ route("users.update_password", $user->id) }}" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            @csrf
                            @method("PUT")
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
