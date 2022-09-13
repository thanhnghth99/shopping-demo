<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Sub Category
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[700px]">
            <form action="{{ route('subcategory.update', $subCategory->id) }}" method="POST">
                @method('PUT')
                {{csrf_field()}}
                <div>
                    <x-forms.input label="Name" name="name" id="name" placeholder="Name" value="{{ $subCategory->name }}" required/>
                </div>
                <div class="mb-5">
                    <div>
                        <label for="name" class="mb-3 block text-xl font-medium text-[#07074D]">Categories</label>
                        <x-forms.radio-list id="category" name="category_id" :items="$categories" :selected="$subCategory->category_id"/>
                        <div class="mt-2">
                            <a href="{{ route('category.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add Category</a>
                        </div>
                    </div>
                </div>                
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="mb-3 block text-xl font-medium text-[#07074D]">Status</label>
                    <select name="status" id="cars" value="{{ $subCategory->status }}"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <option 
                            @if($subCategory->status == SubCategory::STATUS_ENABLE)
                                selected
                            @endif
                            value="{{ SubCategory::STATUS_ENABLE }}">Enable
                        </option>
                        <option 
                            @if ($subCategory->status == SubCategory::STATUS_DISABLE)
                                selected
                            @endif
                            value="{{ SubCategory::STATUS_DISABLE }}">Disable
                        </option>
                    </select>
                </div>
                <div>
                    <a class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none text-left"
                        href="{{ route('subcategory.index') }}" role="button" style="float: left">
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
