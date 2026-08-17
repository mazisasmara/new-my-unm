<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminController extends Controller
{
  public function index()
  {
    $admins = User::where("role", "admin")
      ->with("group.layanans")
      ->get();

    return view("superadmin.admins.index", compact("admins"), [
      "title" => "Super Admin",
    ]);
  }

  public function create()
  {
    $kategoriList = Kategori::all();

    return view("superadmin.admins.create", compact("kategoriList"), [
      "title" => "Super Admin",
    ]);
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      "username" => ["required", "string", "unique:users,username"],
      "email" => ["required", "email", "unique:users,email"],
      "password" => ["required", "string", "min:8"],
      "nama_group" => ["required", "string", "unique:groups,nama_group"],
      "kategori_id" => ["required", "exists:kategoris,id"],
    ]);

    $group = Group::create([
      "nama_group" => $request->nama_group,
      "kategori_id" => $request->kategori_id,
      "slug" => Str::slug($request->nama_group),
      "status" => true,
    ]);

    User::create([
      "username" => $data["username"],
      "email" => $data["email"],
      "password" => $data["password"],
      "role" => "admin", // dikunci — tidak bisa jadi superadmin dari form ini
      "group_id" => $group->id,
      "status" => true,
    ]);

    return redirect()
      ->route("superadmin.admins.index")
      ->with("success", "Akun admin berhasil dibuat.");
  }

  public function destroy(User $user)
  {
    abort_if(
      $user->role !== "admin",
      403,
      "Hanya akun admin yang bisa dihapus dari sini."
    );

    $user->delete();

    return back()->with("success", "Akun admin dihapus.");
  }

  public function groupOrder(Request $request)
  {
    $kategoriId = $request->kategori;

    $kategoris = Kategori::orderBy("urutan")->get();

    $groups = collect();

    if ($kategoriId) {
      $groups = Group::where("kategori_id", $kategoriId)
        ->orderBy("urutan")
        ->get();
    }

    return view("superadmin.groups.order", [
      "title" => "Atur Urutan Group",
      "kategoris" => $kategoris,
      "groups" => $groups,
      "kategoriId" => $kategoriId,
    ]);
  }

  public function reorderGroups(Request $request)
  {
    $data = $request->validate([
      "kategori_id" => ["required", "exists:kategoris,id"],
      "ids" => ["required", "array"],
      "ids.*" => ["integer", "exists:groups,id"],
    ]);

    $groups = Group::where("kategori_id", $data["kategori_id"])
      ->whereIn("id", $data["ids"])
      ->get()
      ->keyBy("id");

    foreach ($data["ids"] as $index => $id) {
      if ($groups->has($id)) {
        $groups[$id]->update([
          "urutan" => $index + 1,
        ]);
      }
    }

    return response()->json([
      "success" => true,
    ]);
  }
}
