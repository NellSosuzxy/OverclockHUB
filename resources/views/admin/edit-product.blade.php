@extends('layouts.app')

@section('content')
    <h2 class="section-title">// <span>Edit</span> Hardware Parameters</h2>

    <div style="max-width: 600px;">
        <div style="background-color: var(--bg-card); border: 1px solid var(--border); padding: 2.5rem;">
            <form method="POST" action="{{ route('admin.products.update', $product) }}">
                @csrf
                @method('PUT')

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required placeholder="e.g. AMD Ryzen 9 9950X">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Price (RM)</label>
                <input type="number" name="price" class="form-control" step="0.01" min="0" value="{{ old('price', $product->price) }}" required placeholder="0.00">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Image Label</label>
                <input type="text" name="image_label" class="form-control" value="{{ old('image_label', $product->image_label) }}" placeholder="e.g. CPU, GPU, RAM (auto-generated if empty)">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Stock Quantity</label>
                <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock', $product->stock) }}" required>

                <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                    <button type="submit" class="btn btn-primary" style="flex:1;">Update Parameters</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline" style="flex:1; text-align: center;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection