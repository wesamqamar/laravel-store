    @if ($errors->any())
        <div class="alert alert-danger">
            <h3>Error Occured!</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
    <div class="form-group">
        <x-form.input name="name" label="Category Name" class="form-control" :value="$category->name "/>
        @error('name') is-invalid
        @enderror

    </div>
    <div class="form-group">
        <label for="">Category Parent</label>
        <select name="parent_id"class="form-control form-select">
            <option value="">Primary Category</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}"@selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
            @endforeach
        </select>

    </div>
    <div class="form-group">
        <label for="">Description</label>
        <x-form.textarea name="description"  :value=" $category->description"/>
    </div>
    <div class="form-group">
        <x-form.label id=image> Image</x-form.label>
        <x-form.input type="file" name="image"   accept="image/*"/>
    </div>
    <div class="form-group">
        <label for="">Status</label>

        <x-form.radio name="status" :checked="$category->status" :options="['active'=>'Active','archived'=>'Archived']"/>


    </div>
    @error('status')
    <div class="text-danger">
        {{-- {{ $errors->first('name') }} --}}
        {{ $message }}
    </div>
@enderror


    <div class="form-group">
        <button type="submit" class="btn btn-primary m-3"> {{ $button_lable ?? 'save' }}</button>
    </div>
