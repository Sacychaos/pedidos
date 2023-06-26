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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pagamentos = Payment::all();
        return view('/admin/payments.payment_create', compact('pagamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pagamentos = Payment::find($id);

        if (!$pagamentos) {
            return redirect()->route('payments.index')->with('error', 'Pagamento não encontrado.');
        }

        $pagamentos->delete();

        return redirect()->route('payments.index')->with('success', 'Pagamento excluído com sucesso.');
    }
}