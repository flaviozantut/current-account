<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use App\Services\User;
use App\Services\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

$router->get('ping', ['as' => 'health_check', function () {
    return response('pong');
}]);

$router->post('transaction', ['as' => 'wallet.transaction', function (Wallet $wallet, User $user, Request $request) {
    $payer = $user->find($request->input('payer'));
    $payee = $user->find($request->input('payee'));
    $value = $request->input('value');

    $wallet->transaction($payer, $payee, $value);

    return response(null, Response::HTTP_NO_CONTENT);
}]);

$router->get('user', ['as' => 'users.list', function (User $user) {
    return response()->json($user->simplePaginate());
}]);

$router->post('user', ['as' => 'user.create', function (User $user, Request $request) {
    $user->create($request->input());

    return response(null, Response::HTTP_NO_CONTENT);
}]);

$router->get('user/document_id/{documentId}', ['as' => 'user.get', function (string $documentId, User $user) {
    $user = $user->findByDocumentId($documentId);

    return response()->json($user);

    return response(null, Response::HTTP_NO_CONTENT);
}]);

$router->get('user/id/{id}', ['as' => 'user.get', function (int $id, User $user) {
    $user = $user->find($id);

    return response()->json($user);

    return response(null, Response::HTTP_NO_CONTENT);
}]);

$router->post('user/id/{userId}/credit', ['as' => 'user.credit_by_id', function (int $userId, User $user, Wallet $wallet, Request $request) {
    $user = $user->find($userId);
    $value = $request->input('value');
    $wallet->addCredit($user, $value);

    return response(null, Response::HTTP_NO_CONTENT);
}]);

$router->post('user/document_id/{documentId}/credit', ['as' => 'user.credit_by_document_id', function (string $documentId, User $user, Wallet $wallet, Request $request) {
    $user = $user->findByDocumentId($documentId);
    $value = $request->input('value');
    $wallet->addCredit($user, $value);

    return response(null, Response::HTTP_NO_CONTENT);
}]);
