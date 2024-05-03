<!-- HTML code -->
<!-- HTML code -->
<div id="myModal" class="modal" onclick="closeModal(event)">
    <span class="close" onclick="event.stopPropagation(); closeModal(event)">&times;</span>
    <div class="modal-content">
        <h4>Lưu video vào</h4>
        <div id="playlist-name">
            <div class="playlist-save">
                <input type="checkbox">
                <span>Tên danh sách 1</span>
            </div>
            <div class="playlist-save">
                <input type="checkbox">
                <span>Tên danh sách 2</span>
            </div>
            <div class="playlist-save">
                <input type="checkbox">
                <span>Tên danh sách 3</span>
            </div>
        </div>
        <div id="new-playlist">
            <i class="fa-solid fa-plus"></i>
            <span>Tạo danh sách phát mới</span>
        </div>

    </div>
</div>


<script>
    // JavaScript code
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal(event) {
        var modal = document.getElementById("myModal");
        var modalContent = document.querySelector(".modal-content");

        // Kiểm tra xem sự kiện click có xảy ra trên phần tử modal-content không
        if (!modalContent.contains(event.target)) {
            modal.style.display = "none";
        }
    }
</script>
