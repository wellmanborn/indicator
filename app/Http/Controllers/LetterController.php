<?php

namespace App\Http\Controllers;

use App\Helpers\ShamsiDate;
use App\Http\Requests\LetterRequest;
use App\Models\Letter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LetterController extends Controller
{

    public function data(Request $request){
        $page = $request->start ? ($request->start / $request->length != 0 ?: 1) + 1 : 1;
        $order = isset($request['order'][0]['column']) ?
            $request['columns'][intval($request['order'][0]['column'])]['data'] : "updated_at";
        if (isset($order) && $order == "update")
            $order = 'updated_at';
        $order_by = $order;

        $order_type = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'desc';
        $query = Letter::where("id", ">=", 1);
        $search_data = json_decode($request["search"]["value"], true);
        if ($search_data && count($search_data) > 0) {
            foreach ($search_data as $key => $val) {
                if (count($val) > 0) {
                    if (key($val) == "letter_number") {
                        $query->where("letter_number", "like", "%" . $val[key($val)] . "%");
                    }
                    if (key($val) == "company_name") {
                        $query->where("company_name", "like", "%" . $val[key($val)] . "%");
                    }
                    if (key($val) == "letter_type") {
                        $query->where("letter_type", $val[key($val)]);
                    }
                    if (key($val) == "attached_file") {
                        if($val[key($val)] == "has_not")
                            $query->WhereNull("attached_file")->orWhere("attached_file", "");
                        else
                            $query->whereNotNull("attached_file")->where("attached_file", "!=", "");
                    }
                    if (key($val) == "from_action_date") {
                        $from = ShamsiDate::persian_date_to_datetime($val[key($val)]);
//                        $to = ShamsiDate::persian_date_to_datetime_next_day($val[key($val)]);
//                        $query->whereBetween("updated_at", [$from, $to]);
                        $query->where("action_date", ">=", $from);
                    }
                    if (key($val) == "to_action_date") {
                        $to = ShamsiDate::persian_date_to_datetime_next_day($val[key($val)]);
//                        $to = ShamsiDate::persian_date_to_datetime_next_day($val[key($val)]);
//                        $query->whereBetween("updated_at", [$from, $to]);
                        $query->where("action_date", "<=", $to);
                    }
                    if (key($val) == "from_date") {
                        $from = ShamsiDate::persian_date_to_datetime($val[key($val)]);
//                        $to = ShamsiDate::persian_date_to_datetime_next_day($val[key($val)]);
//                        $query->whereBetween("updated_at", [$from, $to]);
                        $query->where("created_at", ">=", $from);
                    }
                    if (key($val) == "to_date") {
                        $to = ShamsiDate::persian_date_to_datetime_next_day($val[key($val)]);
//                        $to = ShamsiDate::persian_date_to_datetime_next_day($val[key($val)]);
//                        $query->whereBetween("updated_at", [$from, $to]);
                        $query->where("created_at", "<=", $to);
                    }
                }
            }
        }
        $letters = $query->orderBy($order_by, $order_type)
            ->paginate($request->length, ['*'], 'page', $page);
        $i = $request->start;
        foreach ($letters->items() as $letter) {
            $letter['row'] = ++$i;
            $letter["letter_number"] = \ViewHelper::show_letter_number($letter["letter_number"]);
            $letter['created_by'] = User::find($letter['created_by'])->name;
            $letter['updated_by'] = !empty($letter['updated_by']) ? User::find($letter['updated_by'])->name : "";
            $letter["letter_type"] = trans(ucfirst($letter["letter_type"]));
            $letter["brief"] = Str::limit($letter["description"], 30);
            $letter['update'] = ShamsiDate::to_persian_datetime($letter['updated_at']);
            $letter['action_date'] = ShamsiDate::to_persian_datetime($letter['action_date']);
            $letter['attached_file'] = !empty($letter["attached_file"]) ? "<a href=\"/letters/{$letter["id"]}/download\" target=\"_blank\">" . trans("Download") . "</a>" : "----";
            $letter['actions'] = '<div class="dropdown">
                                    <button class="btn btn-border-theme btn-xs btn-table dropdown-toggle"
                                    id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . trans("Actions") . '</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="will-change: transform; margin: 0;">
                                            <a class="dropdown-item" href="/letters/' . $letter["id"] . '" type="button">' . trans("View") . '</a>';
            if(auth()->user()->role == "admin") {
                $letter['actions'] .= '<a class="dropdown-item" href="/letters/' . $letter["id"] . '/edit" type="button">' . trans("Edit") . '</a>
                                            <a class="dropdown-item remove-letter" href="#" data-target="' . $letter["id"] . '">' . trans("Remove") . '</a>';
            }
            $letter['actions'] .= '</div>
                                   </div>';
        }
        return response()->json(["draw" => $request->draw ?: 1, "recordsTotal" => $letters->total(),
            "recordsFiltered" => $letters->total(), "data" => $letters->items()]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view("letters.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view("letters.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(LetterRequest $request)
    {
        $path = is_null($request->file('attached_file')) ? null : $request->file('attached_file')->store('uploads');
        $letter = Letter::create([
            'company_name' => $request->get("company_name"),
            'letter_type' => $request->get("letter_type"),
            'description' => $request->get("description"),
            'action_date' => ShamsiDate::persian_date_to_datetime(ShamsiDate::faTOen($request->get("action_date"))),
            'attached_file' => $path,
            'created_by' => auth()->id()
        ]);
        $letter->letter_number = $this->create_letter_id($letter->letter_type, $letter->id);
        $letter->save();
        return redirect(route("letters"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Letter $letter)
    {
        return view("letters.show", compact("letter"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Letter $letter)
    {
        return view("letters.edit", compact("letter"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(LetterRequest $request, Letter $letter)
    {
        $letter->company_name = $request->get("company_name");
        $letter->letter_type = $request->get("letter_type");
        $letter->description = $request->get("description");
        $letter->action_date = ShamsiDate::persian_date_to_datetime(ShamsiDate::faTOen($request->get("action_date")));
        if(!empty($request->file('attached_file'))){
            $path = $request->file('attached_file')->store('uploads');
            $letter->attached_file = $path;
        }
        $letter->updated_by = auth()->id();
        $letter->save();
        return redirect(route("letters"))->with("success", trans("Successfully Edited"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Letter $letter)
    {
        $letter->delete();
        return response()->json(["status" => 'success']);
    }

    public function download(Letter $letter)
    {
        return Storage::download($letter["attached_file"]);
    }

    private function create_letter_id($letter_type, $letter_id)
    {
        $type = ($letter_type == "imported") ? "و" : ($letter_type == "exported" ? "ص" : "ق");
        return sprintf("%02d%02d-%s-%d", jdate()->getYear() % 100 , jdate()->getMonth(), $type, sprintf("%d", $letter_id));
    }
}
