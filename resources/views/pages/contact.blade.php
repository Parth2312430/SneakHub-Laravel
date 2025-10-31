@extends('layouts.header')
@section('title','SneakHub | Contact')

@section('content')
<div class="row py-4">
  <div class="col-md-6">
    <h2 class="fw-bold mb-3">Contact Us</h2>
    <p>Got a question about our sneakers, delivery, or sizing? We’d love to hear from you.</p>
    <form id="contactForm" class="mt-3">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" id="contactName" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" id="contactEmail" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Message</label>
        <textarea class="form-control" id="contactMessage" rows="5" required></textarea>
      </div>
      <button type="submit" class="btn btn-dark px-4 rounded-pill">Send Message</button>
    </form>
  </div>

  <div class="col-md-6 mt-5 mt-md-0">
    <h4 class="fw-bold mb-3">Contact Information</h4>
    <p><i class="bi bi-envelope"></i> support@sneakhub.local</p>
    <p><i class="bi bi-telephone"></i> +92 300 0000000</p>
    <p><i class="bi bi-geo-alt"></i> Karachi, Pakistan</p>
  </div>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e){
  e.preventDefault();
  alert('Thank you for contacting SneakHub! Your message has been recorded for demo purposes.');
  this.reset();
});
</script>
@endsection
