<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemFormRequest;
use App\Models\Item;
use App\Models\OrderItem;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        $items = Item::with('services')->get();
        return view('p_items.index', compact('items'));
    }

    public function create(): View
    {
        $services = Service::where('actif', true)->get();
        return view('p_items.create', compact('services'));
    }

    public function store(ItemFormRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $item = Item::create([
            'nom' => $validated['nom'],
        ]);

        $syncData = [];
        foreach ($validated['services'] as $serviceId => $data) {
            $syncData[$serviceId] = ['prix_applique' => $data['prix_applique']];
        }

        $item->services()->sync($syncData);

        return redirect()->route('items.index')->with('success', 'Vêtement créé avec succès.');
    }

    public function edit(Item $item): View
    {
        $item->load('services');

        $services = Service::where('actif', true)
            ->orWhereIn('id', $item->services->pluck('id'))
            ->get();

        return view('p_items.edit', compact('item', 'services'));
    }

    public function update(ItemFormRequest $request, Item $item): RedirectResponse
    {
        $validated = $request->validated();

        $item->update([
            'nom' => $validated['nom'],
        ]);

        $syncData = [];
        foreach ($validated['services'] as $serviceId => $data) {
            $syncData[$serviceId] = ['prix_applique' => $data['prix_applique']];
        }

        $item->services()->sync($syncData);

        return redirect()->route('items.index')->with('success', 'Vêtement mis à jour avec succès.');
    }

    public function destroy(Item $item): RedirectResponse
    {
        if (OrderItem::where('item_id', $item->id)->exists()) {
            return redirect()->route('items.index')
                ->with('error', 'Impossible de supprimer ce vêtement car il est déjà utilisé dans des commandes.');
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Vêtement supprimé avec succès.');
    }
}