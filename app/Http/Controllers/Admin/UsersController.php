<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use App\Models\RoleUser;

class UsersController extends Controller
{

    private $User;

    public function __construct (User $User)
    {

        $this->User = $User;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $profiles = Role::all();

        return view('admin.users.create-edit', ['profiles' => $profiles]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validate = validator($request->all(), $this->User->rulesStore);

        if ($validate->fails()) {
            
            $profiles = Role::all();

            return redirect()
                        ->route('admin.user.create')
                        ->with('profiles', $profiles)
                        ->withErrors($validate)
                        ->withInput();

        }

        $form = $request->all();
        $form['password'] = bcrypt($request->password);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameOriginalPhoto   = explode('.', $request['image']->getClientOriginalName())[0];
            $extension           = $request['image']->extension();
            $namePhoto           = date('d-m-Y H-i-s')."_photo_{$nameOriginalPhoto}.{$extension}";
            $uploadPhoto         = $request->image->storeAs('user', $namePhoto);
                
            if (!$uploadPhoto) {
                 return redirect()
                            ->back()
                            ->with('error','Erro ao salvar a Imagem '.$nameOriginalPhoto.'. Favor tente novamente. Caso o erro persista, entrar em contato com nossa equipe.');   
            }

            $form['image'] = $namePhoto;

        }

        $user = User::create($form);

        if ($user) {

            $roleUser = new RoleUser();
            $roleUser->user_id = $user->id;
            $roleUser->role_id = $form['profile'];
            $roleUser->save();

            return redirect()
                        ->route('admin.user.index')
                        ->with('success','Usuário cadastrado com Sucesso.');

        } else {

            return redirect()
                        ->route('admin.user.create')
                        ->with('error','Erro ao salvar Usuário. Favor tente novamente. Caso o erro persista, favor entrar em contato com o Desenvolvedor')
                        ->withInput();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user = User::find($id);
        $role = Role::all();

        return view('admin.users.create-edit',['user' => $user, 'profiles' => $role]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validate = validator($request->all(), $this->User->rulesUpdate);

        if ($validate->fails()) {
            
            $profiles = Role::all();

            return redirect()
                        ->route('admin.user.create')
                        ->with('profiles', $profiles)
                        ->withErrors($validate)
                        ->withInput();

        }

        $form = $request->all();

        $user = User::find($id);

        if ($form['password'] == '') {

            

            $form['password'] = $user->password;

        } else {

            $form['password'] = bcrypt($form['password']);

        }

        if (isset($form['image'])) {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $nameOriginalPhoto   = explode('.', $request['image']->getClientOriginalName())[0];
                $extension           = $request['image']->extension();
                $namePhoto           = date('d-m-Y H-i-s')."_photo_{$nameOriginalPhoto}.{$extension}";
                $uploadPhoto         = $request->image->storeAs('avatar', $namePhoto);
                    
                if (!$uploadPhoto) {
                     return redirect()
                                ->back()
                                ->with('error','Erro ao salvar o Banner '.$nameOriginalPhoto.' e os banner(s) seguinte(s). Favor tente novamente. Caso o erro persista, entrar em contato com o Desenvolvedor');   
                }

                $form['image'] = $namePhoto;

            }

        } else {

            $form['image'] = $user->image;

        }

        $user->name     = $form['name'];
        $user->email    = $form['email'];
        $user->password = $form['password'];
        $user->image    = $form['image'];
        $user->update();

        $roleUser = RoleUser::where('user_id',$id)->first();
        $roleUser->role_id = $form['profile'];
        $roleUser->update();

        if ($user) {

            return redirect()
                        ->route('admin.user.index')
                        ->with('success','Usuário atualizado com Sucesso.');

        } else {

            return redirect()
                        ->route('admin.user.create')
                        ->with('error','Erro ao atualizar o Usuário. Favor tente novamente. Caso o erro persista, favor entrar em contato com o Desenvolvedor.')
                        ->withInput();

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $id = $request->id;
        
        $roleUser = RoleUser::where('user_id',$id);
        $roleUser->delete();

        $user = User::find($id);
        $user->delete();

        return redirect()
                    ->route('admin.user.index')
                    ->with('success','Usuário deletado com Sucesso.');

    }
}
