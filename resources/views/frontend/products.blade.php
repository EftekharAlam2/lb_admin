@extends('frontend.layouts.main')

@section('main-container')
<div class="container mt-5">
  <h2 class="text-white mb-4">Project List</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Project Category</th>
        <th>Project Name</th>
        <th>Project Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($projects as $project)
        <tr>
          <td>{{ $project->project_category }}</td>
          <td>{{ $project->project_name }}</td>
          <td>
            <img src="data:image/png;base64,{{ $project->project_image }}" alt="Project Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
          </td>
          <td>
            <!-- <button class="btn btn-success btn-sm" onclick="openEditModal({{ $project->id }})">Edit</button> -->
            <button class="btn btn-danger btn-sm" onclick="deleteProject({{ $project->id }})">Delete</button>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>

  <div class="form-group">
    <h3 class="text-white mt-4 mb-4">Add a new project:</h3>
    <form action="{{ url('/add-project') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="project_category">Enter your project category name</label>
        <input type="text" class="form-control" id="project_category" name="project_category">

        <label for="project_name">Enter your project name</label>
        <input type="text" class="form-control" id="project_name" name="project_name">

        <label for="project_image">Upload your project image</label>
        <input type="file" class="form-control-file" id="project_image" name="project_image">

        <button type="submit" class="btn btn-warning mt-4 text-white">Add Project</button>
    </form>
  </div>
</div>

<div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="editProjectForm" class="p-5">
        @csrf
        <div class="form-group">
          <label for="editProjectCategory">Project Category</label>
          <input type="text" class="form-control" id="editProjectCategory" name="editProjectCategory">
        </div>
        <div class="form-group">
          <label for="editProjectName">Project Name</label>
          <input type="text" class="form-control" id="editProjectName" name="editProjectName">
        </div>
        <div class="form-group">
          <label for="editProjectImage">Project Image</label>
          <input type="file" class="form-control-file" id="editProjectImageFile" name="editProjectImage">
        </div>
        <input type="hidden" id="editProjectImage" name="editProjectImage">
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function openEditModal(projectId) {
    $.ajax({
      url: '/get-project-details/' + projectId,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        $('#editProjectCategory').val(response.project_category);
        $('#editProjectName').val(response.project_name);
        $('#editProjectId').val(projectId);
        $('#editProjectModal').modal('show');
      },
      error: function(error) {
        console.error('Error getting project details:', error);
      }
    });
  }

  function saveChanges() {
    // Get the base64-encoded image from the file input
    getBase64Image($('#editProjectImageFile')[0]).then(base64Image => {
        // Create FormData with the entire form
        var formData = new FormData($('#editProjectForm')[0]);

        // Set the values for project category and project name
        formData.set('editProjectCategory', $('#editProjectCategory').val());
        formData.set('editProjectName', $('#editProjectName').val());

        console.log("Values before append: ", formData.get('editProjectCategory'), formData.get('editProjectName'));

        // Append the base64 image to FormData
        formData.append('editProjectImage', base64Image);

        console.log("Values after append: ", formData.get('editProjectCategory'), formData.get('editProjectName'), formData.get('editProjectImage'));

        $.ajax({
            url: '/update-project',
            type: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                $('#editProjectModal').modal('hide');
            },
            error: function (error) {
                console.error('Error updating project:', error);
            }
        });
    });
}



// function saveChanges() {
//     // Get the base64-encoded image from the file input
//     getBase64Image($('#editProjectImageFile')[0]).then(base64Image => {
//         console.log("Base64 Image: ", base64Image);
//     });
// }


  function deleteProject(projectId) {
    if (confirm('Are you sure you want to delete this project?')) {
      $.ajax({
        url: '/delete-project/' + projectId,
        type: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          setTimeout(function() {
          location.reload();
        }, 250);
        },
        error: function(error) {
          console.error('Error deleting project:', error);
        }
      });
    }
  }

  function getBase64Image(fileInput) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      const file = fileInput.files[0];

      if (file) {
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result.split(',')[1]);
        reader.onerror = error => reject(error);
      } else {
        resolve(null);
      }
    });
  }
</script>

@endsection
