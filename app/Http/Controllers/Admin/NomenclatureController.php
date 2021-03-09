<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\User;
use App\DsSubject;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class NomenclatureController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
       // abort_if(Gate::denies('asset_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = DsSubject::all();
        $tables = \DB::select('SHOW TABLES LIKE "DS%"');

        $tables = array_map('current',$tables);

    return view('admin.nomenclatures.index', compact('tables', 'subjects'));
        
    }
    

    
}
