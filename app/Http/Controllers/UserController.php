<?php

namespace App\Http\Controllers;

use App\Http\Libraries\BaseApi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //disini hanya perlu menggunakan BaseApi yg sebelumnya dibuat
		//hanya tinggal menambahkan endpoint yg akan digunakan yaitu '/user'
        $users = (new BaseApi)->index('/user');

        return view('user.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = (new BaseApi)->index('/user/create');

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
				// buat variable baru untuk menset parameter agar sesuai dengan documentasi
				$payload = [
            'firstName' => $request->input('nama_depan'),
            'lastName' => $request->input('nama_belakang'),
            'email' => $request->input('email'),
        ];

        $baseApi = new BaseApi;
        $response = $baseApi->create('/user/create', $payload);

				// handle jika request API nya gagal
        // diblade nanti bisa ditambahkan toast alert
        if ($response->failed()) {
						// $response->json agar response dari API bisa di akses sebagai array
            $errors = $response->json('data');

            $messages = "<ul>";

            foreach ($errors as $key => $msg) {
                $messages .= "<li>$key : $msg</li>";
            }

            $messages .= "</ul>";

            $request->session()->flash(
                'message',
                "Data gagal disimpan
                $messages",
            );

            return redirect('user');
        }

        $request->session()->flash(
            'message',
            'Data berhasil disimpan',
        );

        return redirect('user');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = (new BaseApi)->detail('/user',$id);
        return view('user.edit')->with([
            'user' =>$response->json()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //column yg bisa di update sesuai dengan documentasi dummyapi.io hanyalah
// `fisrtName`, `lastName`
    $payload = [
        'firstName' => $request->input('nama_depan'),
        'lastName' => $request->input('nama_belakang'),
				
	
    ];

    $response = (new BaseApi)->update('/user', $id, $payload);
    if ($response->failed()) {
        $errors = $response->json('data');

        $messages = "<ul>";

        foreach ($errors as $key => $msg) {
            $messages .= "<li>$key : $msg</li>";
        }

        $messages .= "</ul>";

        $request->session()->flash(
            'message',
            "Data gagal diubah
            $messages",
        );

        return redirect('user');
    }

    $request->session()->flash(
        'message',
        'Data berhasil diubah',
    );

    return redirect('user');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $response = (new BaseApi)->delete('/user', $id);

        if ($response->failed()) {
            $request->session()->flash(
                'message',
                'Data gagal dihapus'
            );

            return redirect('/user');
        }

        $request->session()->flash(
            'message',
            'Data berhasil dihapus',
        );

        return redirect('/user');
    }
}
