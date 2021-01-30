<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col">

        <div class="flex justify-between items-center mb-5">
            <input wire:model="search"
                   type="text"
                   name="search"
                   aria-label="Zoeken"
                   placeholder="Zoek recepten..."
                   class="px-3 py-2 rounded-lg border border-gray-300 shadow">

            @can('create', \App\Models\Recipe::class)
                <x-button href="{{route('recipes.create')}}">
                    Nieuw recept
                </x-button>
            @endcan
        </div>
        @if($recipes->isEmpty())
            <div class="flex justify-center items-center bg-white p-5 text-lg rounded-lg shadow-lg">
                Geen recepten gevonden
            </div>
        @else
            <table class="table-auto bg-white rounded-lg shadow-lg">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Titel</th>
                    <th class="px-4 py-2 text-left">Beschrijving</th>
                    <th class="px-4 py-2 text-left">Duur</th>
                    <th class="px-4 py-2 text-left">Auteur</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recipes as $recipe)
                    <tr>
                        <td class="border-t px-4 py-2">
                            <a href="{{ route('recipes.show', $recipe) }}"
                               class="text-blue-600 hover:underline">
                                {{ $recipe->title }}
                            </a>
                        </td>
                        <td class="border-t px-4 py-2">{{ Str::limit($recipe->description, 100) }}</td>
                        <td class="border-t px-4 py-2">{{ $recipe->hours }}:{{ $recipe->minutes }}</td>
                        <td class="border-t px-4 py-2">
                            <div class="flex items-center">
                                <a class="flex text-sm border-2 border-transparent rounded-full transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                         src="{{ $recipe->user->profile_photo_url }}"
                                         alt="{{ $recipe->user->name }}"/>
                                </a>
                                <div class="ml-2 truncate">
                                    {{ $recipe->user->name }}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{ $recipes->links() }}
            </div>
        @endif
    </div>
</div>
