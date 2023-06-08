<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>All Category</b>

        </h2>
    </x-slot>

    <div class="py-12">
        <dir class="container">
            <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">All Category </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>

                        </div>
                        {{--  end card  --}}
                    </div>
                    {{--  end col-md-8  --}}

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Add Category</div>
                            <div class="card-body">

                                <form action="{{ route('store.category') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" class="form-control" name="category_name" id="category_name" aria-describedby="emailHelp">

                                    </div>
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                </form>
                            </div>

                        </div>
                    </div>

            </div>
            {{--  //end row  --}}


        </dir>
    </div>


</x-app-layout>
