<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <b> Hi All Category </b>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    All Category
                                </div>

                           
            <table class="table">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">CreatedAt</th>
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
                        </div>
                        <div class="col-md-4">
                            <div class="card">  
                                <div class="card-header">
                                    All Category
                                </div>
                                <div class="card-body">
                                <form action="{{route('store.category')}}" method="POST">
                                    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Category Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="category_name" aria-describedby="emailHelp" placeholder="Enter email">
    @error('category_name')

<span class="text-danger">{{$message}}</span>
    @enderror
  </div>
  
  <button type="submit" class="btn btn-primary">Add Category</button>
</form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
