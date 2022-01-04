@extends('layouts.carbon')

@section("breadcrumb")
    <div class="breadcrumb-item">{{ __("Edit Letter") }} {{ $letter->letter_number }}</div>
@endsection

@section('content')
    <div class="page-title">
        <h3>{{ __("Edit Letter") }} {{ $letter->letter_number }}</h3>
        <a class="btn btn-sm btn-border-theme" href="{{ route('letters') }}">
            <i class="fa fa-share"></i> {{ __("Letters List") }}</a>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel-box">
                <h4>{{ __("Edit Letter") }} {{ $letter->letter_number }}</h4>
                <form id="create-letter-form" class="form-horizontal" action="{{ route("letters.update", $letter->id) }}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            @csrf
                            @method("PUT")
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="letter_number">{{ __("Letter Number") }}</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="letter_number" disabled
                                           value="{{ $letter->letter_number }}"
                                           type="text" name="letter_number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="company_name">{{ __("Company Name") }}</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="company_name" required
                                           value="{{ $letter->company_name }}"
                                           type="text" name="company_name">
                                    @error('company_name')
                                    <ul class="parsley-errors-list filled" aria-hidden="false">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="letter_type">{{ __("Letter Type") }}</label>
                                <div class="col-sm-8">
                                    <select required id="letter_type" name="letter_type" class="form-control">
                                        <option value="">لطفا انتخاب نمایید</option>
                                        <option @if($letter->letter_type == "exported") selected @endif value="exported">{{ __("Exported") }}</option>
                                        <option @if($letter->letter_type == "imported") selected @endif value="imported">{{ __("Imported") }}</option>
                                        <option @if($letter->letter_type == "contract") selected @endif value="contract">{{ __("Contract") }}</option>
                                    </select>
                                    @error('letter_type')
                                    <ul class="parsley-errors-list filled" aria-hidden="false">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="description">{{ __("Description") }}</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="5" id="description" name="description">{{ $letter->description }}</textarea>
                                    @error('description')
                                    <ul class="parsley-errors-list filled" aria-hidden="false">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="action_date">{{ __("In/Out Date") }}</label>
                                <div class="col-md-5">
                                    <div data-mddatetimepicker="true" data-inline="true" data-isgregorian="false" data-targetselector="#action_date" data-enabletimepicker="false"
                                         style="border: solid 1px #ccc;">
                                    </div>
                                    <div>
                                        <input type="text" name="action_date" id="action_date" value="{{ ViewHelper::to_persian_date_fa_format($letter->action_date) }}" class="form-control" placeholder="تاریخ" readonly />
                                        @error('action_date')
                                        <ul class="parsley-errors-list filled" aria-hidden="false">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="attached_file">{{ __("Attached File") }}</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="attached_file" id="attached_file">
                                    @error('attached_file')
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
