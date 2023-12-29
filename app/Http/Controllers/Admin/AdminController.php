<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    //
    public function index()
    {
        $User = User::all();
        $Barang = Barang::all();
        return view('admin.dashboard',['User' => $User,'Barang' => $Barang]);
    }

    public function manageUser()
    {
        $User = User::all();
        return view('admin.usercrud.manageUser',['User' => $User]);
    }

    public function addUser()
    {
        return view('admin.usercrud.tambahUser');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'noTelp' => ['required','string','max:255',Rule::unique(User::class)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'noTelp' => $request->noTelp,
        ]);

        return Redirect::route('admin.manageUser')->with('status', 'User added');
    }

    public function editUser($id)
    {
        $User = User::find($id);
        return view('admin.usercrud.editUser',['user' => $User]);
    }

    public function updateUser(Request $request, $id)
    {
        $User = User::find($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($User->id)],
            'noTelp' => ['required','string','max:255',Rule::unique(User::class)->ignore($User->id)],
        ]);

        $User->fill($data);
        $User->save();

        return Redirect::route('admin.manageUser')->with('status', 'User updated');
    }

    public function updateUserPassword(Request $request,$id)
    {
        $User = User::find($id);
        $validated = $request->validateWithBag('updatePassword', [
            // 'current_password' => ['required', Hash::check($request->input('current_password'),$User->password)],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // $User->update([
        //     'password' => Hash::make($validated['password']),
        // ]);
        $User->password = $validated['password'];
        $User->save();
        // $request->user()->update([
        //     'password' => Hash::make($validated['password']),
        // ]);

        return Redirect::route('admin.manageUser')->with('status', 'user password updated');
    }

    public function deleteUser($id)
    {
        $User = User::find($id);
        $User->delete();
        return Redirect::route('admin.manageUser')->with('status', 'user deleted');
    }

    public function manageProduct()
    {
        $Barang = Barang::all();
        return view('admin.barangcrud.manageProduct',['Barang' => $Barang]);
    }

    public function addProduct()
    {
        return view('admin.barangcrud.tambahProduct');
    }

    public function editProduct($id)
    {
        $Barang = Barang::find($id);
        return view('admin.barangcrud.editProduct',['barang' => $Barang]);
    }

    public function updateProduct(Request $request, $id)
    {
        $Barang = Barang::find($id);
        $data = $request->validate([
            'namaBarang' => ['required', 'string', 'max:255'],
            'stokBarang' => ['required', 'numeric'],
            'hargaBarang' => ['required','numeric'],
            'status' => ['numeric'],
        ]);

        $Barang->fill($data);
        $Barang->save();

        return Redirect::route('admin.manageProduct')->with('status', 'Product updated');
    }

    public function storeProduct(Request $request)
    {
        
        $data = $request->validate([
            'namaBarang' => ['required', 'string', 'max:255'],
            'stokBarang' => ['required', 'numeric'],
            'hargaBarang' => ['required','numeric'],
            'status' => ['numeric'],
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $Barang = new Barang();
        if (Barang::all()->isEmpty())
        {
            $Barang->id = 1;
        }
        else {
            $maxID = $Barang->max('id');
            $Barang->id = $maxID + 1;
        }

        $fileName = 'img' . '.' . $request->image_path->extension();
        $request->image_path->storeAs('public/images/'.$Barang->id, $fileName);
        $Barang->namaBarang = $data['namaBarang'];
        $Barang->stokBarang = $data['stokBarang'];
        $Barang->hargaBarang = $data['hargaBarang'];
        $Barang->status = $data['status'];
        $Barang->image_path = $fileName;
        $Barang->save();
        return Redirect::route('admin.manageProduct')->with('status', 'Product added');
    }

    public function editImgProduct(Request $request,$id)
    {
        $Barang = Barang::find($id);
        $data = $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $fileName = 'img' . '.' . $request->image_path->extension();
        $request->image_path->storeAs('public/images/'.$Barang->id, $fileName);
        $Barang->image_path = $fileName;
        $Barang->save();

        return Redirect::route('admin.manageProduct')->with('status', 'Product updated');
    }

    public function deleteProduct($id)
    {
        $Barang = Barang::find($id);

        if ($Barang) {
            // Delete the image from storage
            Storage::deleteDirectory('public/images/'.$Barang->id);

            $Barang->delete();
            return Redirect::route('admin.manageProduct')->with('status', 'product deleted');
        }

        return Redirect::route('admin.manageProduct')->with('status', 'product not found');
    }

}
