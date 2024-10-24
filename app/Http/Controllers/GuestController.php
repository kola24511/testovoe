<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestRequest;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return response()->json(Guest::all());
    }

    public function store(GuestRequest $request)
    {
        $guest = Guest::create($request->validated());

        return response()->json($guest, 201);
    }

    public function show(string $id)
    {
        return response()->json(Guest::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->update($request->validated());

        return response()->json($guest);
    }

    public function destroy(string $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return response()->json(null, 204);
    }
}
