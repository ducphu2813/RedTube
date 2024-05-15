<link rel="stylesheet" href="{{ asset('css/main/membershipModal.css') }}">

<div id="modal__membership" class="modal__popup">
    <div class="modal__overlay">
        <div class="modal__content">
            <div class="modal__header">
                <div class="modal__title">Hội viên</div>
            </div>

            <div class="modal__body">
                <ul class="membership__list">
                    @foreach ($memberships as $membership)
                        <li class="membership__list-item" membership_id="{{ $membership->membership_id }}">
                            <div class="membership__list-item__name">{{ $membership->name }}</div>
                            <div class="membership__list-item__details">
                                <div class="membership__list-item__price">{{ $membership->price }} &dstrok;</div>
                                <div class="membership__list-item__duration">{{ $membership->duration }}</div>
                                <div class="member__list-item__description" style="display: none">{{ $membership->description }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="membership__info">
                    <div class="membership__info-name">Gold</div>
                    <div class="membership__info-pirce">12000 &dstrok; / 1 tháng</div>
                    <button class="membership__info-join--btn" id="join--btn" membership_id="membership_id">
                        Tham gia
                    </button>
                    <div class="membership__info-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat                        
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat                        
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat                        
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat                        
                    </div>
                </div>
            </div>

            <div class="modal__footer">
                <div class="modal__option">
                    <button id="closeMembership--btn" class="membership--option">
                        Hủy
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#modal__membership').ready(function() {
            $('#closeMembership--btn').on('click', function(event) {
                $('#modal').empty();
                event.preventDefault();
            });
    
            $('#save--btn').on('click', function(event) {

            });
        });

        $('#modal__membership').ready(function() {
            // set values for the right panel when loading the modal
            $('.membership__list .membership__list-item:first').addClass('selected');
            setMembershipInfo($('.membership__list .membership__list-item:first'));

            // on click event for item in the membership__list
            $('.membership__list-item').on('click', function(event) {
                $('.membership__list-item').removeClass('selected');
                $(this).addClass('selected');

                setMembershipInfo($(this));
            });
            
            function setMembershipInfo(item) {
                // Get details from the selected item
                var membership_id = item.attr('membership_id');
                var name = item.find('.membership__list-item__name').text();
                var price = item.find('.membership__list-item__price').text();
                var duration = item.find('.membership__list-item__duration').text();
                var description = item.find('.member__list-item__description').text();

                // Set values to the right panel
                $('.membership__info-name').text(name);
                $('.membership__info-price').text(price + "&dstrok; / " + duration);
                $('.membership__info-description').text(description);
                $('.membership__info-join--btn').attr('membership_id', membership_id);
            }
        });
    </script>
</div>
