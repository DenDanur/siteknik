<?php

namespace App\Http\Controllers;

use App\Models\Histories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;



class ViewuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
            'birthday' => 'nullable|date',
        ]);



        $user = new User();
        $user->name = $validatedData['name'];
        $user->fullname = $validatedData['fullname'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->birthday = $validatedData['birthday'];
        $user->save();


        return redirect()->route('viewuser.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $viewuser)
    {
        return view('admin.pages.user.edit', compact('viewuser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $viewuser)
    {
        // Validasi input tanpa email terlebih dahulu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'password' => 'nullable|string|min:8', // Password optional
            'role' => 'required|in:admin,user',
            'birthday' => 'nullable|date',
        ]);


        // Cek apakah email berubah
        if ($request->email !== $viewuser->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email', // Tambahkan validasi unique hanya jika email berubah
            ]);
            $viewuser->email = $request->email; // Update email jika validasi lolos
        }

        // Update data viewuser lainnya
        $viewuser->name = $validatedData['name'];
        $viewuser->fullname = $validatedData['fullname'];
        $viewuser->role = $validatedData['role'];
        $viewuser->birthday = $validatedData['birthday'];

        // Update password jika diisi
        if (!empty($validatedData['password'])) {
            $viewuser->password = bcrypt($validatedData['password']);
        }

        // Simpan perubahan
        $viewuser->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('viewuser.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $viewuser)
    {
        $viewuser->delete();
        return redirect()->route('viewuser.index')->with('success', 'User deleted successfully.');
    }

    public function history(User $history)
    {

        $riwayats = Histories::where('user_id',$history->id)->get();
        return view('admin.pages.histories.index',compact('riwayats'));
    }
}
