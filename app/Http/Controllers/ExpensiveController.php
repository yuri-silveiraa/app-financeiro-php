<?php

namespace App\Http\Controllers;

use App\Models\Expensive;
use Illuminate\Http\Request;

class ExpensiveController extends Controller
{
    private $expensive = 'expensive.expensive';

    public function index()
    {
        $expensives = Expensive::all();
        return view($this->expensive, compact('expensives'));
    }

    public function create()
    {
        $fields = ['description', 'category', 'type', 'date', 'value', 'paid'];
        return view($this->expensive, compact($fields));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'type' => 'required|boolean',
            'date' => 'required|date',
            'value' => 'required|numeric',
            'paid' => 'required|boolean',
        ]);

        $validated['user_id'] = auth();

        Expensive::create($validated);

        return redirect()->route($this->expensive);
    }

    public function show(Expensive $expensive)
    {
        $expensive = Expensive::findOrFail($expensive->id);
        return view($this->expensive, compact($expensive));
    }

    public function edit(Expensive $expensive)
    {
        $fields = ['description', 'category', 'type', 'date', 'value', 'paid'];
        return view($this->expensive, compact($fields));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expensive $expensive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expensive $expensive)
    {
        //
    }
}
