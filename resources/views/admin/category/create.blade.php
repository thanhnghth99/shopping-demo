<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Category
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[700px]">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div>
                    <x-forms.input label="Name" name="name" id="name" placeholder="Name" required/>
                </div>
                <div>
                    <x-forms.input label="Image" name="image" id="image" type="file" required/>
                    <p class="w-full text-base text-[#6B7280] mt-1 mb-5" id="image">SVG, PNG, JPG or GIF</p>
                    <img id="img-preview" class="w-24">
                </div>
                <div class="mb-5">
                    <label for="exampleInputEmail1" class="mb-3 block text-xl font-medium text-[#07074D]">Status</label>
                    <select name="status" id="status" 
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <option value="{{ Category::STATUS_ENABLE }}">Enable</option>
                        <option value="{{ Category::STATUS_DISABLE }}">Disable</option>
                    </select>
                </div>
                <div>
                    <a class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none text-left"
                        href="{{ route('category.index') }}" role="button" style="float: left">
                        Back
                    </a>
                    <button class="hover:shadow-form rounded-md bg-[red] py-3 px-8 text-base font-semibold text-white outline-none text-right"
                        role="button" style="float: right">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('pages/js/category.js') }}"></script>
    </x-slot>
</x-app-layout>