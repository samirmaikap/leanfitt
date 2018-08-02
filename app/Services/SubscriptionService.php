<?php

namespace App\Services;


use App\Repositories\OrganizationRepository;
use Illuminate\Support\Facades\DB;
use Stripe\Plan;
use Stripe\Stripe;
use Stripe\Token;

class SubscriptionService
{
    protected $orgRepo;
    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->orgRepo=$organizationRepository;
    }

    public function privatePlans(){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $plans=Plan::all();
        $filtered_plans=collect($plans['data'])->filter(function($item){
            if($item->nickname == 'private')
                return $item;
        });
        return renderCollection($filtered_plans);
    }

    public function userPlans(){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $plans=Plan::all();
        $filtered_plans=collect($plans['data'])->filter(function($item){
            if($item->nickname != 'private')
                return $item;
        });
        return renderCollection($filtered_plans);
    }

    public function create($data){
        if(empty(arrayValue($data,'organization_id'))){
            throw new \Exception('Organization id field is required');
        }

        $organization=$this->orgRepo->find($data['organization_id']);
        if(!$organization)
            throw new \Exception('Organization not found');

        Stripe::setApiKey(env('STRIPE_KEY'));
        $token=Token::create(array(
            "card" => array(
                "number" => arrayValue($data,'number'),
                "exp_month" => arrayValue($data,'exp_month'),
                "exp_year" => arrayValue($data,'exp_year'),
                "cvc" => arrayValue($data,'cvc')
            )
        ));
        DB::beginTransaction();
        $stripe_token=isset($token->id) ? $token->id : null;
        if(!$stripe_token){
            throw new \Exception('Invalid card information');
        }

        $subscription=$organization->newSubscription( 'main', arrayValue($data,'plan'))
            ->withCoupon(arrayValue($data,'coupon'))
            ->create($stripe_token, [
                'email' => $organization->email,
                'description' => $organization->name
            ]);

        if($subscription){
            $this->orgRepo->fillUpdate($organization,['trial_ends_at'=>null]);
            DB::commit();
            return;
        }
        else{
            DB::rollBack();
            throw new \Exception(config('messages.common_error'));
        }
    }
}