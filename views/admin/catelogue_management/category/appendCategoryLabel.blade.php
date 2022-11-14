<div class="form-group">
    <label for="parent_id">Category Type:</label>
    <select name="parent_id" id="parent_id" class="form-control">
        <option value="0" {{ isset($category['parent_id']) && ($category['parent_id'] == 0) ? 'selected' : '' }}>
            Main Category
        </option>
        @if (!empty($getCategories))
            @foreach ($getCategories as $parentCategory)
                <option value="{{ $parentCategory['id'] }}" {{ isset($category['parent_id']) && ($category['parent_id'] == $parentCategory['id']) ? 'selected' : '' }}>
                    &nbsp;&nbsp;{{ $parentCategory['name'] }}
                    @if (!empty($parentCategory['subcategory']))
                        @foreach ($parentCategory['subcategory'] as $subCategory)
                            <option value="{{ $subCategory['id'] }}" {{ isset($category['parent_id']) && ($category['parent_id'] == $subCategory['id']) ? 'selected' : '' }}>
                                &nbsp;&nbsp;&nbsp;&nbsp;-&raquo; {{ $subCategory['name'] }}
                            </option>
                        @endforeach
                    @endif
                </option>
            @endforeach
        @endif
    </select>
    @error('parent_id')
        <div class="text-danger">{{ $message }}*</div>
    @enderror
</div>
{{-- {{ isset($category['id']) && ($parentCategory['parent_id'] == $category['id']) ? 'selected' : '' }} --}}
