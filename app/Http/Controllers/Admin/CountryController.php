<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_name' => 'required|unique:countries,country_name'
        ]);

        Country::create($request->only('country_name'));

        return redirect()->route('admin.countries.index')->with('success', 'Negara berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $request->validate([
            'country_name' => 'required|unique:countries,country_name,'.$id
        ]);

        $country->update($request->only('country_name'));

        return redirect()->route('admin.countries.index')->with('success', 'Negara berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('admin.countries.index')->with('success', 'Negara berhasil dihapus.');
    }
}
