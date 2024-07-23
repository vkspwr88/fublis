<?php

namespace App\Services;

use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\ErrorLogController;
use App\Models\AffRegistration;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AffiliateService
{
	public static function register($data)
	{
		$alertData = [
            'success' => true,
            'type' => 'success',
            'message' => 'You have successfully created the branch',
        ];
        try{
            DB::beginTransaction();

			$userRepository = new UserRepository;
			$user = $userRepository->isUserExist([
				'email' => $data['email'],
				'user_type' => UserTypeEnum::JOURNALIST,
			]);

			if(!$user){
				return [
					'success' => false,
					'type' => 'warning',
					'message' => 'Journalist record does not exists.',
				];
			}

			$data['user_id'] = $user->id;

            AffRegistration::create(
				Arr::except($data, ['name', 'email'])
			);

            DB::commit();
        }
        catch(Exception $exp){
            DB::rollBack();
            ErrorLogController::logErrorNew('affiliate registration', $exp);
            $alertData = [
                'success' => false,
                'type' => 'error',
                'message' => $exp->getMessage(),
            ];
        }
        return $alertData;
	}
}
