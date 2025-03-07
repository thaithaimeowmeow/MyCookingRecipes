<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-5xl font-bold text-gray-800 mb-6">Tag Manager</h1> 

        <x-mary-button label="Add a new tag" class="btn-primary" link="{{route('admin.tag.create')}}"/>

        {{-- You can use any `$wire.METHOD` on `@row-click` --}}

        <div class="shadow my-4 pb-2">
            <x-mary-table class="bg-white" :headers="$headers" :rows="$tags" with-pagination per-page="perPage" :per-page-values="[10, 25]" 
            link="/admin/tag/{id}/edit"  striped
                >
                <x-slot:empty>
                    <x-mary-icon name="o-trash" label="It is empty." />
                </x-slot:empty>
            </x-mary-table>


        </div>

    </div>
</div>
