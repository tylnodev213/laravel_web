<!-- Delete Warning Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Are you sure ?
                <form action="{{ route('Team.destroy', 'id') }}" method="post" id="myForm">
                    @csrf
                    @method('DELETE')
                    <input id="id_delete" type="hidden" name="id" >
                    <div class="modal-footer row" style="justify-content: space-between;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="submit" class="btn btn-success success">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Modal -->
