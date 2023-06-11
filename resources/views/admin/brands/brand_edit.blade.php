<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>Edit Brand</b>

        </h2>
    </x-slot>

    <div class="py-12">
        <dir class="container">
            <div class="row">


                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Edit Brand</div>
                            <div class="card-body">

                                <form action="{{ url('brand/update/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Update Brand Name</label>
                                    <input  type="text" class="form-control"
                                            name="brand_name"
                                            id="brand_name"
                                            aria-describedby="emailHelp"
                                            value="{{ $brands->brand_name }}">

                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Update Brand Image</label>
                                        <input  type="file" class="form-control"
                                                name="brand_image"
                                                id="brand_image"
                                                aria-describedby="emailHelp"
                                                value="{{ $brands->brand_image }}">

                                            @error('brand_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <dir class="form-group">
                                            <img src="{{ asset($brands->brand_image) }}" style="height:200px; width: 200px; ">

                                        </dir>

                                    <button type="submit" class="btn btn-primary">Update Brand</button>
                                </form>
                            </div>

                        </div>
                    </div>

            </div>
            {{--  //end row  --}}


        </dir>
    </div>


</x-app-layout>
