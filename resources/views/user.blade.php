<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
    background-image: url('images/Login.jpg');
    background-size: cover;
    background-repeat: no-repeat;
  }

  .success-message {
      top: 0;
      width: 300px;
      margin: 20px auto;
      text-align: center;
      z-index: 9999;
    }

    .form-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 10px;
      border: 3px solid #ddd;
      border-radius: 5px;
    }

    .form-container label,
    .form-container .form-text {
      color: #333; 
    }

    .form-container .mb-3:nth-child(4),
    .form-container .mb-3:nth-child(5) {
      width: 100%; 
    }
  </style>
</head>
<body>
  @if (session()->has('success'))
    <div class="alert alert-success success-message">
      {{ session('success') }}
    </div>
  @endif
  @if (session()->has('error'))
  <div class="alert alert-success success-message">
    {{ session('error') }}
  </div>
@endif
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="container form-container">
    <center><h1>User Registration</h1></center>
    <form action="{{ route('user.registration') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label @error('name') is-invalid @enderror">Name*</label>
        <input type="text" class="form-control" id="name" name="name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address*</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" required>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="user_type" class="form-label @error('roles') is-invalid @enderror">User Type</label>
        <select class="form-select" id="user_type" name="roles">
          <option value="">Select User Type</option>
          <option value="2">Admin</option>
          <option value="1">Employee</option>
          <option value="3">Jobseeker</option>
         </select>
         @error('roles')
         <div class="invalid-feedback">{{ $message }}</div>
         @enderror
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password*</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password*</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm_password" name="password_confirmation" required>
        @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <center><button type="submit" class="btn btn-primary">Register</button></center>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
