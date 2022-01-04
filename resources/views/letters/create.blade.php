@extends('layouts.carbon')

@section("breadcrumb")
    <div class="breadcrumb-item">{{ __("Register Letter In Indicator") }}</div>
@endsection

@section('content')
    <div class="page-title">
        <h3>{{ __("Register Letter In Indicator") }}</h3>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel-box">
                <h4>{{ __("Register Letter In Indicator") }}</h4>
                <form id="create-letter-form" class="form-horizontal" action="{{ route("letters.store") }}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="company_name">{{ __("Company Name") }}</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="company_name" required
                                           value="@if(isset($letter)){{ $letter->company_name }}@else{{ old("company_name") }}@endif"
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
                                        <option @if(old("letter_type") == "exported") selected @endif value="exported">{{ __("Exported") }}</option>
                                        <option @if(old("letter_type") == "imported") selected @endif value="imported">{{ __("Imported") }}</option>
                                        <option @if(old("contract") == "contract") selected @endif value="imported">{{ __("Contract") }}</option>
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
                                    <textarea class="form-control" rows="5" id="description" name="description">@if(isset($letter)){{ $letter->description }}@else{{ old("description") }}@endif</textarea>
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
                                        <input type="text" name="action_date" id="action_date" value="{{ old("action_date") }}" class="form-control" placeholder="تاریخ" readonly />
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
