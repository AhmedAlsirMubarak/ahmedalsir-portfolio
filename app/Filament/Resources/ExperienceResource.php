<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('role')->required()->columnSpan(2),
                Forms\Components\TextInput::make('company')->required()->columnSpan(2),
                Forms\Components\TextInput::make('location'),
                Forms\Components\TextInput::make('duration')->required()->placeholder('1 year 6 months'),
                Forms\Components\Select::make('type')
                    ->options(['full-time'=>'Full-time','freelance'=>'Freelance','remote'=>'Remote','part-time'=>'Part-time'])
                    ->default('full-time'),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\Textarea::make('description')->rows(2)->columnSpanFull(),
                Forms\Components\Repeater::make('responsibilities')
                    ->simple(Forms\Components\TextInput::make('value')->required())
                    ->label('Key Responsibilities')->columnSpanFull(),
                Forms\Components\TagsInput::make('tech_tags')->placeholder('Add technology...')->columnSpanFull(),
            ])->columns(4),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('role')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('company')->searchable(),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit'   => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
