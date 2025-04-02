<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    protected ContactService $service;
    public function __construct(ContactService $service)
    {
        $this->service = $service;
    }
    /*
    public function index(): View
    {
        $accounts = $this->service->getPaginate(perPage: 10);
        return view(view: 'contact.index', data: compact(var_name: 'accounts'));
    }
    public function create(): View
    {
        return view(view: 'contact.create');
    }
    public function edit(int $id): View
    {
        $account = $this->service->findById(id: $id);
        return view(view: 'contact.edit', data: compact(var_name: 'account'));
    }
    */
    public function store(Request $request): RedirectResponse
    {
        try {
            $this->service->create(data: $request->all());
            return redirect()->route(route: 'welcome')->with(key: 'success', value: 'Contato enviado com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    /*
    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $this->service->update(id: $id, data: $request->all());
            return redirect()->route(route: 'account.index')->with(key: 'success', value: 'Contato atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->delete(id: $id);
            return redirect()->route(route: 'account.index')->with(key: 'success', value: 'Contato excluída com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage());
        }
    }
    */
}