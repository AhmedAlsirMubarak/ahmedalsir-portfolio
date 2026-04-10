<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(100),
            Forms\Components\Select::make('category')
                ->options(['frontend'=>'Frontend','backend'=>'Backend','database'=>'Database','other'=>'Other'])
                ->required(),
            Forms\Components\TextInput::make('level')->numeric()->minValue(0)->maxValue(100)->suffix('%')->default(80),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge()
                    ->color(fn(string $s) => match($s){ 'frontend'=>'info','backend'=>'success','database'=>'warning',default=>'gray' }),
                Tables\Columns\TextColumn::make('level')->suffix('%')->sortable(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([Tables\Filters\SelectFilter::make('category')->options(['frontend'=>'Frontend','backend'=>'Backend','database'=>'Database','other'=>'Other'])])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit'   => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
