@extends('frontend.layouts.main')

@section('main-container')
<div class="container mt-5">
  <h2 class="text-white mb-4">Project List</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Project Category</th>
        <th>Project Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Category name</td>
        <td>Project name</td>
        <td>
          <button class="btn btn-success btn-sm">Edit</button>
          <button class="btn btn-danger btn-sm">Delete</button>
        </td>
      </tr>

    </tbody>
  </table>

  <div class="form-group">
    <h3 class="text-white mt-4 mb-4">Add a new project:</h3>
    <label for="newCategory">Enter your project category name</label>
    <input type="text" class="form-control" id="newCategory">
    <label for="newCategory">Enter your project name</label>
    <input type="text" class="form-control" id="newProject">
    <button class="btn btn-warning mt-2 text-white" onclick="addProject()">Add Project</button>
  </div>
</div>

@endsection