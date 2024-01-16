@extends('dashboard.index');
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body shadow bnt btn-dark">
                        <form action="{{ route('item.store') }}" method="post">
                            @csrf
                            <div class="form-body">
                                <h3 class="text-center">Create New Item</h3>
                                <div class="col-md-12">
                                    <label for="name">Name</label>
                                    <input class="form-control" value="{{ old('name') }}" type="text" name="name"
                                        required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="price">Price</label>
                                    <input class="form-control" value="{{ old('price') }}" type="text" name="price"
                                        required>
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="category_id">Choose Category</label>
                                    <select class="form-control" name="category_id">
                                        @foreach ($categories as $category)
                                        {{ $category }}
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="expire_date">Expire Date</label>
                                    <input class="form-control" value="{{ old('expire_date') }}" type="text" name="expire_date"
                                        required>
                                    @error('expire_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-button mt-3">
                                    <a href="{{ route('item.index') }}" class="btn btn-primary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
