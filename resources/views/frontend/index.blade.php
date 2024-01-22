@extends('frontend.layouts.main')

@section('main-container')
      
<div class="container mt-4">
    <h2 class="text-white mt-2 mb-4">Update your Info</h2>
    <form>
        <div class="form-group">
            <label for="availability">Update your availability for work</label>
            <textarea class="form-control border-5 border-white" id="availability" name="availability" rows="2"></textarea>
        </div>

        <div class="form-group">
            <label for="myInfo">Update your story</label>
            <textarea class="form-control" id="myInfo" name="myInfo" rows="2"></textarea>
        </div> 

        <button type="submit" class="btn btn-primary">Update your Info</button>
    </form>
</div>

<div class="container mt-4">
<form>
    <h2 class="text-white mt-2 mb-4">Update Additional Information</h2>

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="form-group">
      <label for="birthday">Birthday</label>
      <input type="date" class="form-control" id="birthday" name="birthday">
    </div>

    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="tel" class="form-control" id="phone" name="phone">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="form-group">
      <label for="experience">Years of Experience</label>
      <input type="number" class="form-control" id="experience" name="experience">
    </div>

    <div class="form-group">
      <label for="projects">Number of Projects Finished</label>
      <input type="number" class="form-control" id="projects" name="projects">
    </div>

    <div class="form-group">
      <label for="awards">Number of Awards</label>
      <input type="number" class="form-control" id="awards" name="awards">
    </div>

    <div class="form-group">
      <label for="customers">Number of Customers</label>
      <input type="number" class="form-control" id="customers" name="customers">
    </div>

    <button type="submit" class="btn btn-primary">Update Additional Information</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '/get-update-info',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#availability').val(data.availability);
                $('#myInfo').val(data.my_info);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
        $.ajax({
            url: '/get-additional-info',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#name').val(data.name);
                $('#birthday').val(data.birthday);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#experience').val(data.experience);
                $('#projects').val(data.projects_finished);
                $('#awards').val(data.awards);
                $('#customers').val(data.customers);
            },
            error: function(error) {
                console.error('Error fetching Additional Info data:', error);
            }
        });
    });
</script>

@endsection