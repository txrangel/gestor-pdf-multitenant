<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdfCreateRequest;
use App\Models\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PdfController extends Controller
{

    public function create(): View
    {
        return view(view: 'pdf.upload');
    }

    public function store(PdfCreateRequest $request): RedirectResponse
    {
        try {
            $data = [
                "name"      => $request['name'],
                "file_path" => $request['file_path']
            ];
            if (isset($data['file_path']))
                $data['file_path'] = $data['file_path']->store('tenants/'.tenant("id").'/pdfs', 'public');
            Pdf::create($data);
            return redirect('/app/files/pdfs');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
}
