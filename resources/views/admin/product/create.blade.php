<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Product
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[700px]">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div>
                    <x-forms.input label="Name" name="name" id="name" placeholder="Name" required/>
                </div>
                <div>
                    <x-forms.input label="Description" name="description" id="description" placeholder="Description" required/>
                </div>
                <div>
                    <x-forms.input label="Information" name="information" id="information" placeholder="Information" required/>
                </div>
                <div>
                    <x-forms.input label="Price" name="price" id="price" placeholder="Price" required/>
                </div>
                <div>
                    <x-forms.input label="Discount" name="discount" id="discount" placeholder="Discount"/>
                </div>
                <div class="mb-5">
                    <div>
                        <label for="name" class="mb-3 block text-xl font-medium text-[#07074D]">Colors</label>
                        <x-forms.checkbox-list id="color" name="color[]" :items="$colors"/>
                        <div class="mt-2">
                            <a href="{{ route('color.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add color</a>
                        </div>
                    </div>
                </div> 
                <div class="mb-5">
                    <div>
                        <label for="name" class="mb-3 block text-xl font-medium text-[#07074D]">Sizes</label>
                        <x-forms.checkbox-list id="size" name="size[]" :items="$sizes"/>
                        <div class="mt-2">
                            <a href="{{ route('size.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add size</a>
                        </div>
                    </div>
                </div> 
                <div class="mb-5">
                    <div>
                        <label for="name" class="mb-3 block text-xl font-medium text-[#07074D]">Sub Categories</label>
                        <x-forms.checkbox-list id="subcategory" name="subcategory[]" :items="$subCategories"/>
                        <div class="mt-2">
                            <a href="{{ route('subcategory.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add sub category</a>
                        </div>
                    </div>
                </div> 
                <div class="mb-5">
                    <label for="exampleInputEmail1" class="mb-3 block text-xl font-medium text-[#07074D]">Status</label>
                    <select name="status" id="status" 
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <option value="{{ Product::STATUS_ENABLE }}">Enable</option>
                        <option value="{{ Product::STATUS_DISABLE }}">Disable</option>
                    </select>
                </div>
                <div>
                    <a class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none text-left"
                        href="{{ route('product.index') }}" role="button" style="float: left">
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
</x-app-layout>
