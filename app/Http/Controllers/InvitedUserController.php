<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewInvitedUserRequest;
use App\Http\Requests\ShowInvitedUserRequest;
use App\Http\Requests\UpdateInvitedUserRequset;
use App\Http\Resources\InvitedUserResource;
use App\Models\InvitedUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvitedUserController extends ApiController
{
    public function list(ShowInvitedUserRequest $request)
    {
        $data = $request->validated();

        // dd($data);

        $result = InvitedUser::when(isset($data['family']), function ($query) use($data) {

            $query->where('family', 'like', $data['family']);
        })
        ->when(isset($data['national_code']), function ($query) use($data) {

            $query->where('national_code', 'like', $data['national_code']);
        })
        ->when(isset($data['mobile']), function ($query) use($data) {

            $query->where('mobile', 'like', $data['mobile']);
        })
        ->when(isset($data['status']), function ($query) use($data) {

            $query->where('status', 'like', $data['status']);
        })
        ->when(isset($data['register_date']), function ($query) use($data) {

            $query->where('register_date', 'like', $data['register_date']);
        })
            ->latest()->limit($data['count_of_users'])->paginate($data['show_per_page']);

            if($result->isEmpty()){

                return $this->errorResponse("Not Found" , 404);
            }

            return $this->successResponse($result , 200) ;
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
