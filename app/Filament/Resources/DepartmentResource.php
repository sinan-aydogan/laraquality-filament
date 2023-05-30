<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Department;
use App\Models\Employee;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function getModelLabel(): string
    {
        return __('department.department');
    }

    public static function getPluralModelLabel(): string
    {
        return __('department.departments');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /* Department code */
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(10),

                /* Department name */
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                /* Manager */
                Forms\Components\Select::make('manager_id')
                    ->options(
                        Employee::all()->pluck('full_name', 'id')
                    )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label(__('department.code')),

                /* Manager */
                Tables\Columns\TextColumn::make('manager.full_name')
                    ->label(__('department.manager')),

                /* Department Name */
                Tables\Columns\TextColumn::make('name')
                    ->label(__('department.name'))
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
