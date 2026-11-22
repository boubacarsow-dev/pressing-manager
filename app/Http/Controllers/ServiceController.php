<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::all();
        return view('p_services.index', compact('services'));
    }

    public function create(): View
    {
        return view('p_services.create');
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        Service::create($request->validated());
        return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
    }

    public function edit(Service $service): View
    {
        return view('p_services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $service->update($request->validated());
        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->update(['actif' => !$service->actif]);

        $message = $service->actif ? 'Service réactivé.' : 'Service désactivé.';
        return redirect()->route('services.index')->with('success', $message);
    }
}