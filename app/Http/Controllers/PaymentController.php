<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $pagamentos = Payment::all();
        return view('/admin/payments.payment', compact('pagamentos'));
    }

    public function create()
    {
        $pagamentos = Payment::all();
        return view('/admin/payments.payment_create', compact('pagamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Payment::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('payments.index')->with('success', 'Pagamento criado com sucesso.');
    }

    public function edit($id)
    {
        $pagamento = Payment::find($id);

        if (!$pagamento) {
            return redirect()->route('payments.index')->with('error', 'Pagamento não encontrado.');
        }

        return view('/admin/payments.payment_edit', compact('pagamento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $pagamento = Payment::find($id);

        if (!$pagamento) {
            return redirect()->route('payments.index')->with('error', 'Pagamento não encontrado.');
        }

        $pagamento->name = $request->input('name');
        $pagamento->save();

        return redirect()->route('payments.index')->with('success', 'Pagamento atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $pagamento = Payment::find($id);

        if (!$pagamento) {
            return redirect()->route('payments.index')->with('error', 'Pagamento não encontrado.');
        }

        $pagamento->delete();

        return redirect()->route('payments.index')->with('success', 'Pagamento excluído com sucesso.');
    }
}