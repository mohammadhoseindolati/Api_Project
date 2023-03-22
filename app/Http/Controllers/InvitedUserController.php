<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewInvitedUserRequest;
use App\Http\Requests\UpdateInvitedUserRequset;
use App\Http\Resources\InvitedUserResource;
use App\Models\InvitedUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvitedUserController extends ApiController
{
    public function index($count , $paginate)
    {

        $validBulk = [10, 50, 100];

        $validUsers = [100 , 1000 , 10000];

        if (!in_array($paginate, $validBulk)) {

            return $this->errorResponse("The number of pagination should be 10 , 50 , 100 ", 422);
        }

        if (!in_array($count, $validUsers)) {

            return $this->errorResponse("The number of users should be 100 , 1000 , 10000 ", 422);
        }

        $arrayParams = $this->getSearchParameters();

        if (is_array($arrayParams)){

            foreach ($arrayParams as $key => $value) {

                $result[] =  $users = InvitedUser::where($key, $value)->limit($count)->paginate($paginate);
            }

        }else{

            $result = InvitedUser::limit($count)->paginate($paginate);
        }

        return $this->successResponse($result, 200);
    }

    public function store(CreateNewInvitedUserRequest $request)
    {

        $invitedUser =  InvitedUser::create([
            'marketerUserId' => $request->get('marketerUserId'),
            'name' => $request->get('name'),
            'family' => $request->get('family'),
            'mobile' => $request->get('mobile'),
            'nationalCode' => $request->get('nationalCode'),
            'birthDate' => $request->get('birthDate'),
            'gender' => $request->get('gender'),
            'insuranceID' => $request->get('insuranceID'),
            'registerDate' => Carbon::now(),
            'status' => $request->get('status'),
        ]);

        return $this->successResponse($invitedUser, 200, "User Invited Successfully");
    }

    public function update(UpdateInvitedUserRequset $requset, InvitedUser $user)
    {

        $user->status = $requset->get('status');

        $user->save();

        return $this->successResponse($user, 200);
    }
}
