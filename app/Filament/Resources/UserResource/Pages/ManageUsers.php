<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Enums\Users\UserTypeEnum;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
				->using(function (array $data, string $model): Model {
					$result = $model::create($data);
					if($result->user_type === UserTypeEnum::ADMIN){
						$role = Role::firstOrCreate(['name' => 'Author']);
						$result->assignRole($role);
					}
					return $result;
				}),
        ];
    }
}
