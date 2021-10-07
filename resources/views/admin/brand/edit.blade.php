<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <b> Hi Edit Brands </b>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{session('success')}}</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
                        <div class="col-md-8">
                            <div class="card">  
                                <div class="card-header">
                                    Edit Brands
                                </div>
                                <div class="card-body">
                                <form action="{{url('brand/update/'.$brands->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_image" value="{{$brands->brand_image}}" >
  <div class="form-group">
    <label for="exampleInputEmail1">Update Brand Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="brand_name" aria-describedby="emailHelp" placeholder="Enter email" value="{{$brands->brand_name}}">
    @error('brand_name')

<span class="text-danger">{{$message}}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Update Brand Image</label>
    <input type="file" class="form-control" id="exampleInputEmail1" name="brand_image" aria-describedby="emailHelp" placeholder="Enter email" value="{{$brands->brand_image}}">
    @error('brand_image')

<span class="text-danger">{{$message}}</span>
    @enderror
  </div>

  <div class="form-group">
   <img src="{{asset($brands->brand_image)}}" style="width:400px; height:200px;" />
  </div>
  
  <button type="submit" class="btn btn-primary">Update Brand</button>
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
