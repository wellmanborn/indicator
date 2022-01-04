@extends('layouts.carbon')

@section("breadcrumb")
    <div class="breadcrumb-item">{{ __("Letter") }} {!! ViewHelper::show_letter_number($letter->letter_number) !!}</div>
@endsection

@section('content')
    <div class="page-title">
        <h3>{{ __("Letter") }} {!! ViewHelper::show_letter_number($letter->letter_number) !!}</h3>
        <a class="btn btn-sm btn-border-theme" href="{{ route('letters') }}">
            <i class="fa fa-share"></i> {{ __("Letters List") }}</a>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel-box">
                <table class="letter-view">
                    <tr>
                        <th>{{ __("Letter Number") }}</th>
                        <td>{!! ViewHelper::show_letter_number($letter->letter_number) !!}</td>
                    </tr>
                    <tr>
                        <th>{{ __("Company Name") }}</th>
                        <td>{{ $letter->company_name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("Letter Type") }}</th>
                        <td>{{ __(ucfirst($letter->letter_type)) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("Description") }}</th>
                        <td>{{ $letter->description }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("In/Out Date") }}</th>
                        <td class="text-en">{{ ViewHelper::to_persian_datetime($letter->action_date) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("Created Date") }}</th>
                        <td class="text-en">{{ ViewHelper::to_persian_datetime($letter->created_at) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("Update Date") }}</th>
                        <td class="text-en">{{ ViewHelper::to_persian_datetime($letter->updated_at) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("Created By") }}</th>
                        <td>{{ $letter->updated_at }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("Attached File") }}</th>
                        <td>
                            @if(!empty($letter->path))
                                <a href="{{ route("letters.download", $letter->id) }}">{{ __("Download") }}</a>
                            @else
                                {{ __("Has Not") }}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
