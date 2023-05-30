<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Employee;
use App\Models\Department;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmployeeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmployeeResource\RelationManagers;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function getModelLabel(): string
    {
        return __('employee.employee');
    }

    public static function getPluralModelLabel(): string
    {
        return __('employee.employees');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make(__('employee.personal_information'))
                        ->columns(12)
                        ->schema([
                            /* Department */
                            Forms\Components\Select::make('department_id')
                                ->label(__('employee.department'))
                                ->columnSpan(6)
                                ->options(
                                    Department::all()->pluck('name', 'id')
                                ),

                            /* Identity Number */
                            Forms\Components\TextInput::make('identity_number')
                                ->label(__('employee.identity_number'))
                                ->required()
                                ->columnSpan(6)
                                ->maxLength(15),

                            /* First Name */
                            Forms\Components\TextInput::make('first_name')
                                ->label(__('employee.first_name'))
                                ->required()
                                ->columnSpan(6)
                                ->maxLength(255),

                            /* Last Name */
                            Forms\Components\TextInput::make('last_name')
                                ->label(__('employee.last_name'))
                                ->required()
                                ->columnSpan(6)
                                ->maxLength(255),

                            /* Birth Date */
                            Forms\Components\DatePicker::make('birth_date')
                                ->label(__('employee.date_of_birth'))
                                ->columnSpan(6)
                                ->required(),

                            /* Hire Date */
                            Forms\Components\DatePicker::make('hire_date')
                                ->label(__('employee.date_of_hire'))
                                ->columnSpan(6)
                                ->required(),

                            /* Email */
                            Forms\Components\TextInput::make('email')
                                ->label(__('employee.email'))
                                ->email()
                                ->columnSpan(6)
                                ->maxLength(255),

                            /* Phone Number */
                            Forms\Components\TextInput::make('phone_number')
                                ->label(__('employee.phone'))
                                ->tel()
                                ->columnSpan(6)
                                ->maxLength(255),

                            /* Blood Type */
                            Forms\Components\Select::make('blood_type')
                                ->label(__('employee.blood_type'))
                                ->columnSpan(6)
                                ->options([
                                    'A+' => 'A+',
                                    'A-' => 'A-',
                                    'B+' => 'B+',
                                    'B-' => 'B-',
                                    'AB+' => 'AB+',
                                    'AB-' => 'AB-',
                                    'O+' => 'O+',
                                    'O-' => 'O-',
                                ]),

                            /* Status */
                            Forms\Components\Toggle::make('status')
                                ->columnSpanFull()
                                ->label(__('employee.status'))
                                ->required(),
                        ]),


                    Wizard\Step::make(__('employee.account_information'))
                        ->schema([

                            /* Is has account */
                            Forms\Components\Radio::make('is_has_account')
                                ->label(__('employee.is_has_account'))
                                ->options([
                                    'not' => 'Hesabı yok',
                                    'create' => 'Hesap oluşturlacak',
                                    'attach' => 'Mevcut hesaba bağlanacak',
                                ])
                                ->reactive(),

                            /* Attach an account */
                            Forms\Components\Select::make('user_id')
                                ->label(__('employee.account'))
                                ->options(
                                    User::all()->pluck('email', 'id')
                                )
                                ->hidden(fn (Closure $get) => $get('is_has_account') !== 'attach'),
                        ]),

                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('department_id'),
                Tables\Columns\TextColumn::make('identity_number'),
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date(),
                Tables\Columns\TextColumn::make('hire_date')
                    ->date(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('blood_type'),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
    
}
