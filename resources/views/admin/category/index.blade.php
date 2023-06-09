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
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  @endif

                                <div class="card-header">All Category </div>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        {{--  @php($i=1)  --}}
                                        @foreach ($categories as  $category)

                                    <tr>
                                        {{--  <th scope="row">{{ $i++ }}</th>  --}}
                                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user_id }}</td>
                                        <td>
                                            @if($category->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                                            {{--  ใช้Query Builder  --}}
                                            @endif
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{ $categories->links() }}

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
