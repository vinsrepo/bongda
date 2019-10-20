<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\Setting;
use App\Models\User;
use App\Models\Audits;

class AuditsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = [];
        $datas = Audits::with('user');
        if ($request->table) {
            $datas = $datas->where('auditable_type', $request->table);
        }
        if ($request->event) {
            $datas = $datas->where('event', $request->event);
        }
        $datas = $datas->orderBy('id', 'desc')
            ->paginate(Setting::DEFAULT_PAGINATE);
        $table = Audits::groupBy('auditable_type')->pluck('auditable_type')->toArray();
        $event = Audits::groupBy('event')->pluck('event')->toArray();
        return view('backend.pages.audits.index', compact('datas', 'table', 'event'));
    }

    /**
     * Display history detail
     *
     * @param request
     * @param model - table
     * @param table_id - id of table
     *
     * @return \Illuminate\Http\Response
     */
    public function historyDetail(Request $request)
    {
        extract($_GET);
        $data = $model::where('id', $table_id)->first();
        $audit = $data->audits()->find($audit_id);
        return view('backend.pages.audits.modal', compact('audit', 'data'));
    }
}
