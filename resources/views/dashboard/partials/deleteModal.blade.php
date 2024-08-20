    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (Request::is('dashboard/userlog'))
                        <form id="deleteForm" method="POST">
                            @method('DELETE')
                            @csrf
                            <p>Seluruh data yang sudah direkam akan terhapus, apakah anda yakin ingin menghapus seluruh
                                data histori DoorLock ? jika <strong>'Ya'</strong> silakan ceklis box dibawah</p>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" value="true"
                                    name="confirmation">
                                <label class="form-check-label">
                                    Ya saya ingin menghapus seluruh data histori DoorLock
                                </label>
                            </div>
                        </form>
                    @else
                        <p>Apakah anda yakin ingin menghapus data tersebut?</p>
                        <form id="deleteForm" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteRowButton">Hapus</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var recipient = button.data('whatever')
                var modal = $(this)

                modal.find('.modal-body form').attr('action', '{{ URL::current() }}/' + recipient)
            });

            $(document).ready(function() {
                $("#deleteRowButton").click(function() {
                    $("#deleteForm").submit();
                });
            });
        </script>
    @endpush
