<div class="modal fade" id="logoutModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Siap untuk mengakhiri sesi?</h5>
        <button class="close" type="button" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">Klik "Keluar" untuk mengakhiri sesi</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">Keluar</button>
        </form>
      </div>
    </div>
  </div>
</div>
