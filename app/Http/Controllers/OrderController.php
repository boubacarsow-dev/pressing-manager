<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['customer', 'payments'])
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function create(): View
    {
        $customers = Customer::all();

        $items = Item::whereHas('services', fn ($query) => $query->where('actif', true))
            ->with(['services' => fn ($query) => $query->where('actif', true)])
            ->get();

        return view('orders.create', compact('customers', 'items'));
    }

    public function store(OrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated) {
            $order = Order::create([
                'ref' => 'CMD-' . strtoupper(Str::random(6)),
                'customer_id' => $validated['customer_id'],
                'date_depot' => $validated['date_depot'],
                'livraison_prev' => $validated['livraison_prev'],
                'date_recup' => $validated['livraison_prev'],
                'statut' => 'reçue',
                'montant_total' => 0,
            ]);

            $montantTotal = 0;

            foreach ($validated['lines'] as $line) {
                $item = Item::findOrFail($line['item_id']);
                $service = $item->services()
                    ->where('services.id', $line['service_id'])
                    ->firstOrFail();

                $prixUnitaire = $service->pivot->prix_applique;

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'service_id' => $service->id,
                    'quantite' => $line['quantite'],
                    'prix_unitaire' => $prixUnitaire,
                ]);

                $montantTotal += $prixUnitaire * $line['quantite'];
            }

            $order->update([
                'montant_total' => $montantTotal,
            ]);

            return $order;
        });

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Commande créée avec succès.');
    }

    public function show(Order $order): View
    {
        $order->load([
            'customer',
            'orderItems.item',
            'orderItems.service',
            'payments',
        ]);

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order): View|RedirectResponse
    {
        if ($order->orderIsPaid()) {
            return redirect()
                ->route('orders.show', $order)
                ->with('error', 'Commande déjà réglée : modification impossible.');
        }

        $order->load('orderItems');
        $customers = Customer::all();

        $items = Item::whereHas('services', fn ($query) => $query->where('actif', true))
            ->with(['services' => fn ($query) => $query->where('actif', true)])
            ->get();

        return view('orders.edit', compact('order', 'customers', 'items'));
    }

    public function update(OrderRequest $request, Order $order): RedirectResponse
    {
        $validated = $request->validated();

        $statut = $validated['statut'] ?? $order->statut;
        $dateRecup = $statut === 'récupérée' ? now() : $order->date_recup;

        if ($order->orderIsPaid()) {
            $order->update([
                'statut' => $statut,
                'date_recup' => $dateRecup,
            ]);

            return redirect()
                ->route('orders.show', $order)
                ->with('success', 'Statut mis à jour.');
        }

        DB::transaction(function () use ($validated, $order, $statut, $dateRecup) {
            $order->orderItems()->delete();

            $montantTotal = 0;

            foreach ($validated['lines'] as $line) {
                $item = Item::findOrFail($line['item_id']);
                $service = $item->services()
                    ->where('services.id', $line['service_id'])
                    ->firstOrFail();

                $prixUnitaire = $service->pivot->prix_applique;

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'service_id' => $service->id,
                    'quantite' => $line['quantite'],
                    'prix_unitaire' => $prixUnitaire,
                ]);

                $montantTotal += $prixUnitaire * $line['quantite'];
            }

            $order->update([
                'customer_id' => $validated['customer_id'],
                'date_depot' => $validated['date_depot'],
                'livraison_prev' => $validated['livraison_prev'],
                'date_recup' => $dateRecup,
                'statut' => $statut,
                'montant_total' => $montantTotal,
            ]);
        });

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Commande mise à jour avec succès.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        if ($order->payments()->exists()) {
            return redirect()
                ->route('orders.index')
                ->with('error', 'Suppression impossible : des paiements sont liés à cette commande.');
        }

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
}