<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewInvitedUserRequest;
use App\Http\Requests\UpdateInvitedUserRequset;
use App\Http\Resources\InvitedUserResource;
use App\Models\InvitedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvitedUserController extends ApiController
{
    public function index($bulk){

        $validBulk = [10 , 50 , 100] ;

        if (! in_array($bulk , $validBulk)){

            return $this->errorResponse("The number should be 10 , 50 , 100 " , 401) ;
        }

        $users = InvitedUser::limit(100)->paginate($bulk);

        dd($users) ;

        $arrayParams = $this->getSearchParameters();


        foreach ($arrayParams as $key => $value){

          $result[] =  InvitedUser::query()->where($key , $value)->get() ;

        }

        return $this->successResponse(InvitedUserResource::collection($result) , 200 ) ;

    }

    public function store (CreateNewInvitedUserRequest $request){

       $invitedUser =  InvitedUser::create([
            'marketerUserId' => $request->get('marketerUserId') ,
            'name' => $request->get('name') ,
            'family' => $request->get('family') ,
            'mobile' => $request->get('mobile') ,
            'nationalCode' => $request->get('nationalCode') ,
            'birthDate' => $request->get('birthDate') ,
            'gender' => $request->get('gender') ,
            'insuranceID' => $request->get('insuranceID') ,
            'registerDate' => $request->get('registerDate') ,
            'status' => $request->get('status'),
        ]);

       return $this->successResponse($invitedUser , 200 , "User Invited Successfully" );
    }

    public function update(UpdateInvitedUserRequset $requset , InvitedUser $user)
    {

        $user->status = $requset->get('status') ;

        $user->save();

        return $this->successResponse($user , 200) ;
    }
}
