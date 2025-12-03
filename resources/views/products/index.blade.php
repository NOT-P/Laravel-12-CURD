<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 12 CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="bg-dark text-center text-white py-3">
      <h1 class="h2">Laravel 12 CRUD</h1>
    </div>  
      <div class="container">
        <div class="row">
          <div class="d-flex justify-content-end p-0 mt-3">
            <a href="{{ route('products.create') }}" class="btn btn-dark">create</a>
          </div>
          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          <div>
            @if (Session::has('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          </div>



          <div class="card p-0 mt-3">
            <div class="card-header bg-dark text-white">
              <h4 class="h4">Products</h4>
            </div>
            <div class="card-body shadow-lg">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th width="100">Status</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>

                <thead>
                  <tr>
                    <td>1</td>
                    <td></td>
                    <td>Dummy Product</td>
                    <td>12312</td>
                    <td>$100</td>
                    <td>
                      Active
                    </td>
                    <td class="text-center">
                      <a href="#" class="btn btn-dark btn-sm">Edit</a>
                      <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                </thead>
                
              </table>
            </div>
          </div>
        </div>
      </div>
    














    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>