<link rel="stylesheet" href="{{ asset('css/studio/studioPremium.css') }}">

<div class="content__title">Premium Manage</div>

<!-- body -->
<div class="content__body">
    <ul class="content__body--list">

        <!-- header -->
        <li class="content__body--item list--header" style="font-weight: 700;">
            <div class="item__col w-10">id</div>
            <div class="item__col w-20">Email</div>
            <div class="item__col w-10">Plan</div>
            <div class="item__col w-20">Subscribed date</div>
            <div class="item__col w-20">Expired date</div>
            <div class="item__col w-20">Details</div>
        </li>

        <!-- items -->
        <li class="content__body--item">
            <div class="item__col w-10">1</div>
            <div class="item__col w-20">minewaku.minewaku.minewaku.minewaku.minewaku@gmail.com</div>
            <div class="item__col w-10">Family</div>
            <div class="item__col w-20">1/1/2023</div>
            <div class="item__col w-20">1/2/2023</div>
            <div class="item__col w-20">
                <button id="details--btn" style="border: none;">
                    <i class="fa-solid fa-circle-info"></i>
                </button>
            </div>
        </li>
    </ul>
</div>

<!-- footer -->
<div class="content__footer">

    <!-- pagination -->
    <div class="pagination">

        <button class="pagi--btn" id="arrow--left">
            <i class="fa-solid fa-angles-left"></i>
        </button>

        <button class="pagi--btn" id="chevron--left">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <button class="pagi--btn page">
            1
        </button>

        <button class="pagi--btn page">
            2
        </button>

        <button class="pagi--btn unselectable">
            ...
        </button>

        <button class="pagi--btn page">
            5
        </button>

        <button class="pagi--btn page">
            6
        </button>

        <button class="pagi--btn" id="chevron--right">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <button class="pagi--btn" id="arrow--right">
            <i class="fa-solid fa-angles-right"></i>
        </button>
    </div>
</div>

<div id="modal" class="modal--popup">
    <div class="modal__overlay">
        <div class="modal__form">
            <div class="modal__title">Details</div>

            <div class="modal__info">
                <div class="col">
                    <div class="form-group w-50">
                        <label for="" class="form-label">Id</label>
                        <input type="text" class="form-input" disabled>
                    </div>

                    <div class="form-group w-50">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-input" disabled>
                    </div>
                </div>
                
                <div class="col">
                    <div class="form-group w-100">
                        <label for="" class="form-label">Plan</label>
                        <input type="text" class="form-input" disabled>
                    </div>
                </div>
 
                <div class="col">
                    <div class="form-group w-50">
                        <label for="" class="form-label">Subscribed date</label>
                        <input type="text" class="form-input" disabled>
                    </div>

                    <div class="form-group w-50">
                        <label for="" class="form-label">Expired date</label>
                        <input type="text" class="form-input" disabled>
                    </div>
                </div>
            </div>

            <div class="modal__shared">
                <div class="modal__shared-title">Shared with users</div>

                <div class="shared__box">
                    <input type="text" class="form-input">
                    <button class="shared--btn" style="margin-left: 4px;">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <ul class="content__body--list">
                    <li class="modal__body--item list--header">
                        <div class="item__col w-50">id</div>
                        <div class="item__col w-50">email</div>
                    </li>

                    <li class="modal__body--item">
                        <div class="item__col w-50">1</div>
                        <div class="item__col w-50">minewaku@gmai.com</div>
                    </li>

                    <li class="modal__body--item">
                        <div class="item__col w-50">2</div>
                        <div class="item__col w-50">minewaku@gmai.com</div>
                    </li>

                    <li class="modal__body--item">
                        <div class="item__col w-50">3</div>
                        <div class="item__col w-50">minewaku@gmai.com</div>
                    </li>

                    <li class="modal__body--item">
                        <div class="item__col w-50">4</div>
                        <div class="item__col w-50">minewaku@gmai.com</div>
                    </li>
                </ul>

            </div>

            <div class="modal__close">
                <button id="close--btn" class="modal__close--btn">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    closeBtn = document.getElementById('close--btn').onclick = function() {
        modal = document.getElementById('modal')
        modal.style.display = "none";
    };

    var detailsBtns = document.querySelectorAll('#details--btn');
    detailsBtns.forEach(function(btn) {
        btn.onclick = function() {
            var modal = document.getElementById('modal');
            modal.style.display = "block";
        };
    });
</script>


