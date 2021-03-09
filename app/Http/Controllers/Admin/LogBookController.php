<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLogBookRequest;
use App\Http\Requests\StoreLogBookRequest;
use App\Http\Requests\UpdateLogBookRequest;
use App\LogBook;
use App\Atlas;
use Gate;
use App\Term;
use App\Session;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class LogBookController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('log_book_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LogBook::where('team_id', $request->school)->select(sprintf('%s.*', (new LogBook)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'log_book_show';
                $editGate      = 'log_book_edit';
                $deleteGate    = 'log_book_delete';
                $crudRoutePart = 'log-book';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : "";
            });
            $table->addColumn('event', function ($row) {
                return $row->event ? $row->event : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : "";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }
        $country_list = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 1)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();

        return view('admin.logBook.index', compact('country_list'));
    }

    public function create()
    {
        abort_if(Gate::denies('log_book_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.logBook.create');
    }

    public function store(StoreLogBookRequest $request)
    {
        // $logBook = LogBook::create($request->all());
        $team_id = Auth::User()->team_id;
        $term_id = Term::where('active_status', 1)->get();
        $session_id = Session::where('active_status', 1)->get();

        $data = new LogBook();
        $data->event = $request->event;
        $data->remark = $request->remark;
        $data->date = $request->date;
        $data->team_id = $team_id;
        $data->term_id = $term_id[0]->id;
        $data->session_id = $session_id[0]->id;
        $final = $data->save();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.log-book.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.log-book.index');
    }

    public function edit(LogBook $logBook)
    {
        abort_if(Gate::denies('log_book_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.logBook.edit', compact('logBook'));
    }

    public function update(UpdateLogBookRequest $request, LogBook $logBook)
    {
        // $logBook->update($request->all());

        $data = LogBook::find($logBook->id);
        $data->event = $request->event;
        $data->remark = $request->remark;
        $data->date = $request->date;
        $final = $data->update();

        if ($final) {
            $notification = array(
                    'message' => 'Operation Successful'
                );
            return redirect()->route('admin.log-book.index')->with($notification);
        } else {
            $notification = array(
                    'message' => 'Operation Failed'
                );
            return redirect()->back()->with($notification);
        }

        // return redirect()->route('admin.log-book.index');
    }

    public function show(LogBook $logBook)
    {
        abort_if(Gate::denies('log_book_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.logBook.show', compact('logBook'));
    }

    public function destroy(LogBook $logBook)
    {
        abort_if(Gate::denies('student_admission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logBook->delete();

        return back();
    }

    public function massDestroy(MassDestroyLogBookRequest $request)
    {
        LogBook::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
