<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as AuthEditProfile;
use Filament\Pages\Page;

class EditProfile extends AuthEditProfile
{
    /* protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-profile'; */

	// protected static ?string $pluralModelLabel = 'Change Password';

	/* public function getTitle(): string
	{
		return 'Change Password';
	} */

	public function form(Form $form): Form
    {
        return $form
            ->schema([
                /* TextInput::make('name')
                    ->required()
                    ->maxLength(255), */
					$this->getNameFormComponent(),
					// $this->getEmailFormComponent(),
					$this->getPasswordFormComponent(),
					$this->getPasswordConfirmationFormComponent(),
            ]);
    }

	protected function getPasswordFormComponent(): Component
	{
		return parent::getPasswordFormComponent()
			->dehydrateStateUsing(fn ($state): string => $state);
	}
}
