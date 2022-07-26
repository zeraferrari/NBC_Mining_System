<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateValidation;
use App\Http\Requests\UserUpdateValidation;
use App\Models\RhesusCategory;
use App\Models\TransactionDonor;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Manajement Dashboard User';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::with('Rhesus_Connection')->get();
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Users.index', compact('data', 'title', 'latest_inbox', 'latest_notification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_role = Role::all();
        $rhesus = RhesusCategory::all();
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Users.create', compact('data_role', 'rhesus', 'title', 'latest_inbox', 'latest_notification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateValidation $request)
    {
        $data_has_been_validated = $request->validated();
        $data_has_been_validated['Status_Donor'] = 'Belum Mendonor';
        $data_has_been_validated['create_at'] = Carbon::now('Asia/Makassar');
        if($request->hasFile('profile_picture')){
            $date = Carbon::now('Asia/Makassar')->format('dmYHi');
            $HashNameImage = $request->file('profile_picture')->hashName();
            $ImageName = $date."-".$HashNameImage;
            $path_name = $request->file('profile_picture')->storeAs('image-profiles', $ImageName);
            $data_has_been_validated['profile_picture'] = $path_name;
            $data_has_been_validated['password'] = Hash::make($request->input('password'));
            $user_data = User::create($data_has_been_validated);
            $user_data->assignRole($data_has_been_validated['roles']);
            return redirect()->route('Manajement.Users.index')->with('success_created', 'Data user atas nama <b>'.$data_has_been_validated['name'].'</b> telah berhasil dibuat !');
        }else{
            $data_has_been_validated['password'] = Hash::make($request->input('password'));
            $user_data = User::create($data_has_been_validated);
            $user_data->assignRole($data_has_been_validated['roles']);
            return redirect()->route('Manajement.Users.index')->with('success_created', 'Data user atas nama <b>'.$data_has_been_validated['name'].'</b> telah berhasil dibuat !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function get_Transaction_User_Success($NIK){
        $data_transaction = TransactionDonor::with('User_Connection')->get()
                            ->where('Status_Donor', '=', 'Berhasil Mendonor')
                            ->where('User_Connection.NIK', '=', $NIK)
                            ->count();
        return $data_transaction;
    }
    public function get_Transaction_User_Fails($NIK){
        $data_transaction = TransactionDonor::with('User_Connection')->get()
                            ->where('Status_Donor', '=', 'Gagal Donor')
                            ->where('User_Connection.NIK', '=', $NIK)
                            ->count();
        return $data_transaction;
    }

    public function show(User $User)
    {
        $title = $this->title;
        $success_donor = $this->get_Transaction_User_Success($User->NIK);
        $fails_donor = $this->get_Transaction_User_Fails($User->NIK);
        $total_donor = $success_donor + $fails_donor;
        $data_transaction_user = TransactionDonor::with('User_Connection')->latest()->get()
                    ->where('User_Connection.NIK', '=', $User->NIK)
                    ->whereNotIn('Status_Donor', 'Medical Check');
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Users.show', compact('User', 'title', 'success_donor', 'fails_donor', 
                                                                    'total_donor', 'data_transaction_user',
                                                                    'latest_inbox', 'latest_notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user_data = $user;
        $rhesus_data = RhesusCategory::all();
        $roles_data = Role::all();
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Users.edit', compact('user_data', 'rhesus_data', 'roles_data', 'title', 'latest_inbox', 'latest_notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateValidation $request, User $user)
    {
        $data_has_been_validated = $request->validated();
        $data_has_been_validated['update_at'] = Carbon::now('Asia/Makassar');

        if($request->hasFile('profile_picture')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $date = Carbon::now('Asia/Makassar')->format('dmYHi');
            $HashNameImage = $request->file('profile_picture')->hashName();
            $ImageName = $date."-".$HashNameImage;
            $path_name = $request->file('profile_picture')->storeAs('image-profiles', $ImageName);
            $data_has_been_validated['profile_picture'] = $path_name;
        }

        $user = User::find($user->id);
        $user->update($data_has_been_validated);
        DB::table('model_has_roles')->where('model_id', '=', $user->id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('Manajement.Users.index')->with('success_updated','Data user atas nama <b>'.$user->name.'</b> telah berhasil diupdate !');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->profile_picture){
            Storage::delete($user->profile_picture);
        }
        $user->delete();
        return redirect()->route('Manajement.Users.index')->with('success_deleted', 'Data user atas nama <b>'.$user->name.'</b> telah berhasil dihapus !');
    }
}
