<!-- Approved Modal -->
<div class="modal fade" id="approvedModal" tabindex="-1" aria-labelledby="approvedModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ url('appointment.approved') }}">
      @csrf
      <input type="hidden" name="appointment_id" id="approvedappointmentid">
      <input type="hidden" name="email" id="approvedemail">
      
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="approvedModalLabel">Approved appointment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="approvedmessage" class="form-label">Message</label>
            <textarea class="form-control" name="message" id="approvedmessage" style="background-color:white; height:100px;"rows="4" required></textarea>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Send</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  document.querySelectorAll('.open-approved-modal').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');
      const email = button.getAttribute('data-email');
      
      document.getElementById('approvedappointmentid').value = id;
      document.getElementById('approvedemail').value = email;

      const modal = new bootstrap.Modal(document.getElementById('approvedModal'));
      modal.show();
    });
  });
</script>