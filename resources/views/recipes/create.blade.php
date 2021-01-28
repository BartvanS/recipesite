<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recept toevoegen') }}
        </h2>
    </x-slot>

    <form method="post" action="{{route('recipes.store')}}">
        @csrf

        <div class="bg-white rounded-lg container mx-auto max-w-md relative mt-12">

            <div class="font-bold text-xl bg-white rounded-full px-3 py-2 absolute ml-5 shadow"
                 style="margin-top: -25px">
                Nieuw recept toevoegen
            </div>

            <div class="flex flex-col p-5 pt-8">

                <x-input
                    type="text"
                    id="title"
                    class="px-3 py-2 rounded-lg border border-gray-300"
                    label="Titel"
                />

                <label for="description" class="mb-1 mt-3">Beschrijving</label>
                <textarea class="autoResizeTextArea px-3 py-2 rounded-lg border border-gray-300"
                          type="text"
                          name="description"
                          id="description">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-red-800 mt-1">
                    {{ $message }}
                </div>
                @enderror

                <label for="ingredients" class="mb-1 mt-3">Ingredienten</label>
                <textarea class="autoResizeTextArea px-3 py-2 rounded-lg border border-gray-300"
                          type="text"
                          name="ingredients"
                          id="ingredients"
                          value="{{old('ingredients')}}"></textarea>
                @error('ingredients')
                <div class="text-red-800 mt-1">
                    {{ $message }}
                </div>
                @enderror

                <div class="flex mt-3">
                    <div class="flex-grow flex-col">
                        <x-input
                            type="number"
                            id="hours"
                            class="px-3 py-2 rounded-lg border border-gray-300"
                            label="Tijd in uren"
                        />
                    </div>

                    <div class="flex-grow flex-col ml-3">
                        <div class="flex-grow flex-col">
                            <x-input
                                type="number"
                                id="minutes"
                                class="px-3 py-2 rounded-lg border border-gray-300"
                                label="Tijd in minuten"
                            />
                        </div>
                    </div>
                </div>

                <input type="submit"
                       class="px-3 py-2 rounded-lg bg-blue-600 text-white font-bold text-xl mt-5 hover:bg-blue-800 transition transition-colors duration-100"
                       value="Toevoegen">
            </div>

        </div>
    </form>
</x-app-layout>
