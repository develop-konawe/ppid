<?php

namespace App\Filament\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Akun';

    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationLabel = 'Ubah Password';
    protected static ?string $title = 'Ubah Password';
    protected static ?int $navigationSort = 99;

    protected static string $view = 'filament.pages.change-password';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('current_password')
                ->label('Password Lama')
                ->password()
                ->required(),

            Forms\Components\TextInput::make('password')
                ->label('Password Baru')
                ->password()
                ->required()
                ->minLength(8),

            Forms\Components\TextInput::make('password_confirmation')
                ->label('Konfirmasi Password Baru')
                ->password()
                ->required(),
        ];
    }

    public function submit()
    {
        $this->validate([
            'data.current_password' => ['required'],
            'data.password' => ['required', 'min:8', 'confirmed'],
        ], [], [
            'data.current_password' => 'password lama',
            'data.password' => 'password baru',
        ]);

        $user = auth()->user();

        if (!Hash::check($this->data['current_password'], $user->password)) {
            Notification::make()
                ->title('Password lama salah')
                ->danger()
                ->send();

            return;
        }

        $user->update([
            'password' => Hash::make($this->data['password']),
        ]);

        Notification::make()
            ->title('Password berhasil diperbarui')
            ->body('Silakan login kembali dengan password baru.')
            ->success()
            ->send();

        auth()->logout();

        $this->form->fill();
    }
}
