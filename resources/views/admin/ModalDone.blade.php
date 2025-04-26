<!-- Done Modal -->
<div class="modal fade" id="doneModal" tabindex="-1" aria-labelledby="doneModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ url('send-done-email') }}">
      @csrf
      <input type="hidden" name="appointment_id" id="doneAppointmentId">
      <input type="hidden" name="email" id="doneAppointmentEmail">

      <div class="modal-content">
        <div class="modal-header" style="background-color: #AD1457; color: white;">
          <h5 class="modal-title" id="doneModalLabel">Send Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="doneMessage" class="form-label">Message</label>
            <textarea class="form-control" name="message"style=" height:250px;" id="doneMessage" rows="4" required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Send</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
  <style>
  #doneMessage {
    background-color: white;
    color: black;
    border: 2px solid #AD1457;
  }
</style>
<script>
  document.querySelectorAll('.open-done-modal').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');
      const email = button.getAttribute('data-email');
      const modal = new bootstrap.Modal(document.getElementById('doneModal'));

      document.getElementById('doneAppointmentId').value = id;
      document.getElementById('doneAppointmentEmail').value = email;

      modal.show();
    });
  });
</script>