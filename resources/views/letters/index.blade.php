@extends('layouts.carbon')

@section("breadcrumb")
    <div class="breadcrumb-item">{{ __("Letters List") }}</div>
@endsection

@section('content')
    <div class="page-title">
        <h3>{{ __("Letters List") }}</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-box search-box">
                <form id="search-transaction">
                    <div class="row" style="padding-right: 11px;">
                        <div class="form-group col-sm-2">
                            <input class="form-control" id="letter_number" name="letter_number" type="text"
                                   placeholder="{{ __("Letter Number") }}" />
                        </div>
                        <div class="form-group col-sm-2">
                            <input class="form-control" id="company_name" name="company_name" type="text"
                                   placeholder="{{ __("Company Name") }}" />
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="from_action_date">{{ __("From Date (In/Out Date)") }}</label>
                            <div class="input-group">
                                <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#from_action_date">
                                    <span class="fa fa-calendar"></span>
                                </div>
                                <input type="text" class="form-control" id="from_action_date" placeholder="{{ __("From Date (In/Out Date)") }}" data-targetselector="#from_action_date" data-mddatetimepicker="true"
                                       data-placement="right" data-englishnumber="true" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="to_action_date">{{ __("To Date (In/Out Date)") }}</label>
                            <div class="input-group">
                                <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#to_action_date">
                                    <span class="fa fa-calendar"></span>
                                </div>
                                <input type="text" class="form-control" id="to_action_date" placeholder="{{ __("To Date (In/Out Date)") }}" data-targetselector="#to_action_date" data-mddatetimepicker="true"
                                       data-placement="right" data-englishnumber="true" />
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-right: 11px;">
                        <div class="form-group col-sm-2">
                            <select class="form-control" id="letter_type" name="letter_type">
                                <option value="">{{ __("Letter Type") }}</option>
                                <option value="imported">{{ __("Imported") }}</option>
                                <option value="exported">{{ __("Exported") }}</option>
                                <option value="contract">{{ __("Contract") }}</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <select class="form-control" id="attached_file" name="attached_file">
                                <option value="">{{ __("Attached File") }}</option>
                                <option value="has">{{ __("Has") }}</option>
                                <option value="has_not">{{ __("Has Not") }}</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="from_date">{{ __("From Date (Created Date)") }}</label>
                            <div class="input-group">
                                <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#from_date">
                                    <span class="fa fa-calendar"></span>
                                </div>
                                <input type="text" class="form-control" id="from_date" placeholder="{{ __("From Date (Created Date)") }}" data-targetselector="#from_date" data-mddatetimepicker="true"
                                       data-placement="right" data-englishnumber="true" />
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="to_date">{{ __("To Date (Created Date)") }}</label>
                            <div class="input-group">
                                <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#to_date">
                                    <span class="fa fa-calendar"></span>
                                </div>
                                <input type="text" class="form-control" id="to_date" placeholder="{{ __("To Date (Created Date)") }}" data-targetselector="#to_date" data-mddatetimepicker="true"
                                       data-placement="right" data-englishnumber="true" />
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <button class="btn btn-sm btn-theme" id="search">{{ __("Search") }}</button>
                            <button class="btn btn-sm btn-border-theme" id="reset" type="reset">{{ __("Reset") }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-box">
                <div class="table-responsive">
                    <table id="letters-table" class="table data-table table-striped">
                        <thead>
                        <tr>
                            <th class="no-sort">{{ __("Row") }}</th>
                            <th>{{ __("Letter Number") }}</th>
                            <th>{{ __("Company Name") }}</th>
                            <th>{{ __("Letter Type") }}</th>
                            <th>{{ __("Description") }}</th>
                            <th>{{ __("In/Out Date") }}</th>
                            <th>{{ __("Updated at") }}</th>
                            <th>{{ __("Created By") }}</th>
                            <th>{{ __("Updated By") }}</th>
                            <th>{{ __("Attached File") }}</th>
                            <th>{{ __("Actions") }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        dataTableOptions = {
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('letters.data') }}",
            "pageLength": 100,
            "language": {
                'url': "/js/datatables/languages/Persian.json"
            },
            "order": [[ 6, "desc" ]],
            "columns": [
                {"data": "row", "orderable": false},
                {"data": "letter_number"},
                {"data": "company_name"},
                {"data": "letter_type"},
                {"data": "brief"},
                {"data": "action_date", "class": "text-en text-right"},
                {"data": "update", "class": "text-en text-right"},
                {"data": "created_by"},
                {"data": "updated_by"},
                {"data": "attached_file", "orderable": false},
                {"data": "actions", "orderable": false},
            ]
        };
        let table = $('.data-table').DataTable(dataTableOptions);
        $('#search').on( 'click', function (e) {
            e.preventDefault();
            let search = [];
            if($("#letter_number").val() !== "") {
                search.push({"letter_number": $("#letter_number").val()})
            }
            if($("#company_name").val() !== "") {
                search.push({"company_name": $("#company_name").val()})
            }
            if($("#letter_type").val() !== "") {
                search.push({"letter_type": $("#letter_type").val()})
            }
            if($("#attached_file").val() !== "") {
                search.push({"attached_file": $("#attached_file").val()})
            }
            // let transaction_date_time = "";
            if($("#from_action_date").val() != "") {
                let from_action_date = fixNumbers($("#from_action_date").val().replace(/\//g, ""));
                search.push({"from_action_date": from_action_date})
            }
            if($("#to_action_date").val() != "") {
                let to_action_date = fixNumbers($("#to_action_date").val().replace(/\//g, ""));
                search.push({"to_action_date": to_action_date})
            }
            if($("#from_date").val() != "") {
                let from_date = fixNumbers($("#from_date").val().replace(/\//g, ""));
                search.push({"from_date": from_date})
            }
            if($("#to_date").val() != "") {
                let to_date = fixNumbers($("#to_date").val().replace(/\//g, ""));
                search.push({"to_date": to_date})
            }
            table.search(JSON.stringify(search));
            table.draw();
        });
        $("body").on("click", ".remove-letter", function(e){
            e.preventDefault();
            if (window.confirm("آیا از حذف مطمئن هستید؟")) {
                let id = $(this).data("target");
                $.ajax({
                    url: "/letters/" + id,
                    method: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function () {
                        table.draw();
                    }
                })
            }
        })
        let
            persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
            arabicNumbers  = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g],
            fixNumbers = function (str)
            {
                if(typeof str === 'string')
                {
                    for(var i=0; i<10; i++)
                    {
                        str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
                    }
                }
                return str;
            };
    </script>
@endpush
