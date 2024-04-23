<div class="content__header">
    <div class="content__title">Video details</div>

    <div class="content__option">
        <button class="content__option--btn" id="save">SAVE</button>
    </div>
</div>

<!-- body -->
<div class="content__body">
    <form action="" class="videoDetails-form" method="post" enctype="multipart/form-data">
        <div class="form-left">
            <div class="form-group">
                <label for="title">Title (required)</label>
                <textarea name="title" rows="2"></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" rows="18"></textarea>
            </div>
        </div>

        <div class="form-right">
            <div class="form-group">
                <label for="thumbnail">Upload Thumbnail:</label>
                <input type="file" id="thumbnail" name="thumbnail">

                <div class="review__thumbnail">
                    <img src="" alt="" id="thumbnail--review" class="thumbnail--img">
                </div>
            </div>

            <div class="form-group">
                <label for="playlist">Playlist</label>
                <select id="playlist" name="playlist">
                    <option value="A">Playlist A</option>
                    <option value="B">Playlist B</option>
                </select>
            </div>

            <div class="form-group">
                <label for="privacy">Privacy</label>
                <select id="privacy" name="privacy">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>

            <div class="form-group">
                <label for="categogy">Catelogy</label>
                <select id="categogy" name="categogy">
                    <option value="Tag A">Tag A</option>
                    <option value="Tag B">Tag B</option>
                </select>
            </div>
        </div>
    </form>

    <script>
        const fileInput = document.getElementById("thumbnail");
        const previewImg = document.getElementById("thumbnail--review");
        fileInput.addEventListener("change", () => {
            const file = fileInput.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(file);

            previewImg.style.display = "block"; 
            reader.onload = () => {
                previewImg.src = reader.result;
            };
        });
    </script>

</div>
