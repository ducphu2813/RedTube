<div id="modal" class="modal--popup">
    <div class="modal__overlay">
        <div class="modal__content">
            <div class="modal__header">
                <div class="modal__header-title">
                    Upload video
                </div>

                <button id="close--btn" class="modal__header-close--btn">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>

            <div class="modal__form">
                <i class="fa-solid fa-arrow-up-from-bracket"></i>

                <label for="videoInput" class="modal__form-upload--btn">UPLOAD</label>
                <input type="file" id="videoInput" accept="video/*">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#close--btn').on('click', function(event) {
            $('#modal').remove()
        });
    });
</script>

