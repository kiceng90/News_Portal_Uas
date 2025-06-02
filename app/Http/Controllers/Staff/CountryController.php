<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('staff.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('staff.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_name' => 'required|unique:countries,country_name'
        ]);

        Country::create($request->only('country_name'));

        return redirect()->route('staff.countries.index')->with('success', 'Negara berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('staff.countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $request->validate([
            'country_name' => 'required|unique:countries,country_name,'.$id
        ]);

        $country->update($request->only('country_name'));

        return redirect()->route('staff.countries.index')->with('success', 'Negara berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('staff.countries.index')->with('success', 'Negara berhasil dihapus.');
    }
}
