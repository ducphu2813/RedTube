<link rel="stylesheet" href="{{ asset('css/message.css') }}">

<div id="modal__message" class="modal__popup">
    <div class="modal__overlay">
        <div class="modal__content">
            <div class="modal__header">
                <div class="modal__title"></div>
            </div>

            <div class="modal__body">
                <div class="message" id="message"></div>
            </div>

            <div class="modal__footer">
                <div class="modal__option">
                    <button class="msg--option" id="cancel--btn">
                        Hủy
                    </button>

                    <button class="msg--option" id="action--btn">
                        Xác nhận
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#modal__message').ready(function() {
            $('#close--btn').on('click', function(event) {
                $('#modal').empty();
                event.preventDefault();
            });
    
            $('#action--btn').on('click', function(event) {
                $.ajax({
                    url: '{{ $url }}',
                    type: '{{ $type }}',
                });
                event.preventDefault();
            });
        });
    </script>
</div>