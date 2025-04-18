<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ url('appointment.cancel') }}">
      @csrf
      <input type="hidden" name="appointment_id" id="cancelappointmentid">
      <input type="hidden" name="email" id="cancelemail">
      
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="cancelModalLabel">Cancel appointment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="cancel_message" class="form-label">Message</label>
            <textarea class="form-control" name="message" id="cancelmessage" style="background-color:white; height:100px;"rows="4" required></textarea>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Send</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  document.querySelectorAll('.open-cancel-modal').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');
      const email = button.getAttribute('data-email');
      
      document.getElementById('cancelappointmentid').value = id;
      document.getElementById('cancelemail').value = email;

      const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
      modal.show();
    });
  });
</script>