<div class="reply-section">
    <p class="user_name">${response.user_name} - ${response.created_date}</p>
    <p class="content">${response.content}</p><br>
</div>
<div>
    <form action="${response.reply_route}" method="post" class="reply-form">

        <input type="hidden" name="_token" value="${response.csrf_token}">
        <input type="hidden" name="video_id" value="${response.video_id}">
        <input type="hidden" name="reply_id" value="${response.comment_id}">
        <textarea name="content" id="" cols="30" rows="4" placeholder="trả lời"></textarea>
        <button type="submit">Comment</button>
    </form>

    <hr>
</div>
