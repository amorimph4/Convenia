<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:api'], function (){

	Route::post('/create-user', function (Request $request){
		$validatedData = $request->validate([
	        'name' => 'required|max:255',
	        'phone' => 'required|regex:/(01)[0-9]{9}/' , 
	        'address' => 'required|max:255' , 
	        'cep' => 'required' ,
	        'cnpj' => 'required' ,
	        'email' => 'required|email' ,
	        'password' => 'required|max:255'
	    ]);

		\App\User::create($request->all());
		return response()->json(['sucess' => 'criado com sucesso']);
	});

	Route::post('/create-provider', function (Request $request){
		$validatedData = $request->validate([
	        'name' => 'required|max:255',
	        'payment_monthly' => 'required|max:255',
	        'email' => 'required|email',
	    ]);

		$data = [
			'hash' => md5(microtime().$request->input('password')),
			'active' => false,
			'user_id' => Auth::user()->id
		];

		\App\Providers::create(array_merge( $request->all(), $data));
		$link = $request->root() .'/api/provider-active/'. $data['hash'];

		Mail::to($request->input('email'))
        ->send(new App\Mail\OrderShipped($link));

		return response()->json(['sucess' => 'criado com sucesso']);
	});

	Route::get('/all-providers', function (Request $request) {
	    return App\Http\Resources\ProvidersResource::collection(\App\Providers::where('user_id','=', Auth::user()->id )->get());
	});

	Route::get('/total-cost', function (Request $request) {
	    $providers = \App\Providers::where('user_id','=', Auth::user()->id )->where('active','=', true )->get();
		$cost = 0;
		foreach ($providers as $provider) {
			$cost += $provider->payment_monthly;
		}

		return response()->json(['custo mensal total' => $cost]);
	});

	Route::post('/delete-provider/{provider}', function (\App\Providers $provider, Request $request){	
		$provider->delete();
        return response()->json(['sucess' => 'excluido com sucesso']);
	});

});

Route::get('provider-active/{hash}', function (Request $request, $hash) {
    $Provider = \App\Providers::where('hash','=', $hash)->first();
    if ($Provider) {
    	$Provider->update(['active' => true]);
    	return response()->json(['sucess' => 'Provider active']);
    }else{
    	return response()->json(['error' => 'Not found Provider']);
    }
});

Route::post('/login', function ( Request $request) {
	try {
		$token = \Auth::guard('api')->attempt($request->only(['email', 'password']));
		if (!$token) {
			return response()->json([
				'error' => 'Credential Invalid'
			], 400);
		}
	    return ['token' => $token];
	}catch (\Exception $e){
		return response()->json($e->getMessage());
	}
});
