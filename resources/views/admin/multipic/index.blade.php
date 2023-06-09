<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>Multi Pictures</b>

        </h2>
    </x-slot>

    <div class="py-12">
        <dir class="container">
            <div class="row">
                    <div class="col-md-8">
                        <div class="card-group">
                            @foreach ($images as $multi)
                                <div class="col-md-4 mt-5">
                                    <div class="card">
                                        <img src="{{ asset($multi->image) }}" alt="">
                                    </div>

                                </div>

                            @endforeach


                        </div>

                    </div>
                    {{--  end col-md-8  --}}











                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Multi Image</div>
                            <div class="card-body">

                                <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Multi Image</label>
                                        <input type="file" class="form-control" name="image[]" id="exampleInputEmail1"
                                        aria-describedby="emailHelp"
                                        multiple="">
                                        @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    <button type="submit" class="btn btn-primary">Add Image</button>
                                </form>
                            </div>

                        </div>
                    </div>

            </div>
            {{--  //end row  --}}
        </dir>
    </div>


</x-app-layout>
