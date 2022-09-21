<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <!-- component -->
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[1000px]">
            <form action="{{ route('product.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                {{csrf_field()}}
                <div>
                    <x-forms.input label="Name" name="name" id="name" placeholder="Name" value="{{ $products->name }}" required/>
                </div>
                <div>
                    <label for="description" class="mb-3 block text-xl font-medium text-[#07074D]">Description</label>
                    <textarea name="description" id="description" class="ckeditor">{{ $products->description }}</textarea>
                </div>
                <div class="mb-5">
                    <label for="information" class="mt-5 mb-3 block text-xl font-medium text-[#07074D]">Information</label>
                    <textarea name="information" id="information" class="ckeditor">{{ $products->information }}</textarea>
                </div>
                <div>
                    <x-forms.input label="Price" name="price" id="price" placeholder="Price" value="{{ $products->price }}" required/>
                </div>
                <div>
                    <x-forms.input label="Discount" name="discount" id="discount" placeholder="Discount" value="{{ $products->discount }}"/>
                </div>
                <div>
                    <x-forms.input label="Image" name="image[]" id="image" type="file" multiple/>
                    <p class="w-full text-base text-[#6B7280] mt-1 mb-5" id="image">SVG, PNG, JPG or GIF</p>
                    <div class="img-preview grid grid-cols-6 gap-4">
                        @foreach($products->images as $image)
                            <img src="{{ asset('images/'.$image->name) }}" width=100px/>
                        @endforeach
                    </div>
                </div>
                <div class="mb-5">
                    <div>
                        <label for="name" class="mb-3 block text-xl font-medium text-[#07074D]">Colors</label>
                        <x-forms.checkbox-list id="color" name="color[]" :items="$colors" :selected="Arr::pluck($products->colors, 'id')"/>
                        <div class="mt-2">
                            <a href="{{ route('color.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add color</a>
                        </div>
                    </div>
                </div> 
                <div class="mb-5">
                    <div>
                        <label for="name" class="mb-3 block text-xl font-medium text-[#07074D]">Sizes</label>
                        <x-forms.checkbox-list id="size" name="size[]" :items="$sizes" :selected="Arr::pluck($products->sizes, 'id')"/>
                        <div class="mt-2">
                            <a href="{{ route('size.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add size</a>
                        </div>
                    </div>
                </div> 
                <div class="mb-5">
                    <div>
                        <label for="name" class="mb-3 block text-xl font-medium text-[#07074D]">Sub Categories</label>
                        <x-forms.checkbox-list id="subcategory" name="subcategory[]" :items="$subCategories" :selected="Arr::pluck($products->subCategories, 'id')"/>
                        <div class="mt-2">
                            <a href="{{ route('subcategory.create') }}" class="w-full rounded-md border border-[#07074D] bg-white px-1 mb-3 text-xm font-medium text-[#07074D]">+ Add sub category</a>
                        </div>
                    </div>
                </div> 
                <div class="mb-5">
                    <label for="exampleInputEmail1" class="mb-3 block text-xl font-medium text-[#07074D]">Status</label>
                    <select name="status" id="status" value="{{ $products->status }}" 
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                            <option 
                                @if($products->status == Product::STATUS_ENABLE)
                                    selected
                                @endif
                                value="{{ Product::STATUS_ENABLE }}">Enable
                            </option>
                            <option 
                                @if ($products->status == Product::STATUS_DISABLE)
                                    selected
                                @endif
                                value="{{ Product::STATUS_DISABLE }}">Disable
                            </option>
                    </select>
                </div>
                <div>
                    <a class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none text-left"
                        href="{{ route('product.index') }}" role="button" style="float: left">
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
    <x-slot name="scripts">
        <script src="{{ asset('pages/js/product.js') }}"></script>
    </x-slot>
</x-app-layout>
