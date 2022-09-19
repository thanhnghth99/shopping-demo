<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Color
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[700px]">
            <form action="{{ route('color.update', $colors->id) }}" method="POST">
                @method('PUT')
                {{csrf_field()}}
                <div>
                    <x-forms.input label="Name" name="name" id="name" placeholder="Name" value="{{ $colors->name }}" required/>
                </div>
                <div>
                    <x-forms.input label="Color" name="color" id="color" placeholder="Color" value="{{ $colors->color }}" required/>
                </div>
                <div>
                    <a class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none text-left"
                        href="{{ route('color.index') }}" role="button" style="float: left">
                        Back
                    </a>
                    <button class="hover:shadow-form rounded-md bg-[red] py-3 px-8 text-base font-semibold text-white outline-none text-right"
                        role="button" style="float: right">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>