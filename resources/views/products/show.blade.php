@extends('layouts.app')

@section('title', 'Show Product')

@section('contents')
    <div class="card shadow rounded-lg">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Detail Products</h1>
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
        <div class="card-body">
            <hr />
            <table class="table table-bordered">
                <tr>
                    <th>Category:</th>
                    <td>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Title:</th>
                    <td>{{ $product->title }}</td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <th>Product Code:</th>
                    <td>{{ $product->product_code }}</td>
                </tr>
                <tr>
                    <th>Image:</th>
                    <td>
                        <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab">
                            <div class="mb-3">
                                <label>Upload Product image:</label>
                                <input type="file" name="image[]" multiple class="form-control" />
                            </div>
                            <div>
                                @if ($product->productImages)
                                    <table>
                                        <tr>
                                            @foreach ($product->productImages as $image)
                                                <td>
                                                    <img src="{{ asset($image->image) }}" alt="Image" class="me-4 border"
                                                        style="max-width: 70px; border-radius: 10px;" />
                                                    <a href="{{ route('images.destroy', $image->id) }}"
                                                        class="d-block">Remove</a>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </table>
                                @else
                                    <h5>No Image Added</h5>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>small_description</th>
                    <td>{{ $product->small_description }}</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th>quantity</th>
                    <td>{{ $product->quantity }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>
                        @if ($product->status == '1')
                            <span class="badge rounded-pill text-success bg-success text-light">1-Active</span>
                        @else
                            <span class="badge rounded-pill text-danger bg-danger text-light">0-Inactive</span>
                        @endif
                    </td>
                </tr>

                {{-- <tr>
                    <th>Image:</th>
                    <td><img src="{{ asset('admin_assets/img/' . $image->image) }}" alt="Image" class="me-4 border" />
                    </td>
                </tr> --}}


                <tr>
                    <th>Created At:</th>
                    <td>{{ $product->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At:</th>
                    <td>{{ $product->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        function validateForm() {
            var statusRadios = document.getElementsByName('status');
            var statusSelected = false;

            for (var i = 0; i < statusRadios.length; i++) {
                if (statusRadios[i].checked) {
                    statusSelected = true;
                    break;
                }
            }

            if (!statusSelected) {
                Swal.fire({
                    title: 'Error',
                    text: 'Please select a status',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                return false;
            }

            return true;
        }

        document.getElementById('yourFormId').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    </script>
@endsection
